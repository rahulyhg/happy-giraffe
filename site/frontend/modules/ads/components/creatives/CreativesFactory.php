<?php
/**
 * @author Никита
 * @date 10/02/15
 */

namespace site\frontend\modules\ads\components\creatives;


class CreativesFactory extends \CApplicationComponent
{
    public $presets;

    public function create($presetName, $modelId, $properties = array())
    {
        if (! isset($this->presets[$presetName])) {
            throw new \CException('Пресет не определен');
        }
        $config = $this->presets[$presetName];
        if (! isset($config['class'])) {
            throw new \CException('В конфигурации пресета должен быть определен параметр class');
        }
        $class = $config['class'];
        unset($config['class']);
        $renderer = new $class();
        $renderer->model = \CActiveRecord::model($renderer->modelClass)->findByPk($modelId);
        $properties = \CMap::mergeArray($config, $properties);
        foreach ($properties as $name => $value) {
            $renderer->$name = $value;
        }
        $renderer->init();
        return $renderer;
    }
}