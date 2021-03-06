<?php
/**
 * @author Никита
 * @date 01/03/17
 */

namespace site\frontend\modules\geo2\components\fias\update;


use site\frontend\modules\geo2\components\combined\modifier\FiasModifier;
use site\frontend\modules\geo2\components\fias\ArchiveGetter;
use site\frontend\modules\geo2\components\fias\DataParser;
use site\frontend\modules\geo2\components\fias\FileNameHelper;
use site\frontend\modules\geo2\components\fias\models\FiasAddrobj;
use site\frontend\modules\geo2\components\fias\update\DeltaGetter;
use site\frontend\modules\geo2\components\fias\update\VersionManager;
use site\frontend\modules\geo2\Geo2Module;

class UpdateManager
{
    public static $activeTables = [
        'ADDROBJ'
    ];
    
    public $created = 0;
    public $updated = 0;
    public $deleted = 0;

    public $versionManager;
    
    public function __construct()
    {
        $this->versionManager = new VersionManager();
    }

    public function update($version = null)
    {
        if (! $this->versionManager->isUpdateRequired()) {
            return;
        }

        if ($version == null) {
            $version = $this->versionManager->getActualVersion();
        }

        $deltaDestination = (new ArchiveGetter($this->getUrlByVersion($version)))->get();
        foreach (new \DirectoryIterator($deltaDestination) as $file) {
            if ($file->isDot()) {
                continue;
            }

            $this->processFile($file);
        }
        
        $this->versionManager->setCurrentVersion($version);
    }

    protected function getUrlByVersion($version)
    {
        list($d, $m, $y) = explode('.', $version);
        return "http://fias.nalog.ru/Public/Downloads/$y$m$d/fias_delta_xml.rar";
    }
    
    protected function processFile(\DirectoryIterator $file)
    {
        $tableName = FileNameHelper::filenameToTable($file->getFilename());
        if (! in_array($tableName, self::$activeTables)) {
            return;
        }
        
        $prefixedTableName = Geo2Module::$fias['prefix'] . $tableName;
        $pkName = Geo2Module::$fias['pks'][$tableName];
        
        $transaction = \Yii::app()->db->beginTransaction();
        try {
            $dataParser = new DataParser($file->getPathname());
            foreach ($dataParser->parse() as $row) {
                $row = array_intersect_key($row, array_flip(\Yii::app()->db->schema->getTable($prefixedTableName)->getColumnNames()));

                $exists = \Yii::app()->db->createCommand()
                        ->select('*')
                        ->limit(1)
                        ->from($prefixedTableName)
                        ->where($pkName . ' = :pk', [':pk' => $row[$pkName]])
                        ->queryRow() !== false;

                if ($exists) {
                    $pk = $row[$pkName];
                    FiasModifier::instance()->update($prefixedTableName, $row, $pk);
                    $this->updated++;
                } else {
                    FiasModifier::instance()->insert($prefixedTableName, $row);
                    $this->created++;
                }
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }
}