<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mikita
 * Date: 6/28/13
 * Time: 11:23 AM
 * To change this template use File | Settings | File Templates.
 */

class ClientScript extends CClientScript
{
    const RELEASE_ID_KEY = 'Yii.ClientScript.releaseidkey';
    const POS_AMD = 1000;

    // настройки AMD
    public $amd = array();
    public $amdFile = false;
    public $useAMD = false;

    // настройки оптимизации отдачи статики
    public $jsCombineEnabled;
    public $cssDomain;
    public $jsDomain;
    public $imagesDomain;

    public function render(&$output)
    {
        if($this->amdFile && $this->useAMD)
            $this->renderAMDConfig();

        if(!$this->hasScripts)
            return;

        $this->renderCoreScripts();

        if(!empty($this->scriptMap))
            $this->remapScripts();

        $this->unifyScripts();

        $this->processCssFiles();
        $this->processJsFiles();
        $this->processImages($output);

        $this->renderHead($output);
        if($this->enableJavaScript)
        {
            $this->renderBodyBegin($output);
            $this->renderBodyEnd($output);
        }
    }
    
    public static function log($data)
    {
        echo CHtml::tag('pre', array(), var_export($data, true));
    }

    public function renderAMDConfig()
    {
        // Соберём конфиги
        $this->amd['urlArgs'] = 'r=' . rand(0,1000);//$this->releaseId;
        $this->addPackagesToAMDConfig();
        $conf = $this->amd;
        $eval = $conf['eval'];
        unset($conf['eval']);
        
        // Добавим наши скрипты в самое начало
        $this->hasScripts = true;
        if (!isset($this->scriptFiles[self::POS_HEAD]))
            $this->scriptFiles[self::POS_HEAD] = array();
        $this->scriptFiles[self::POS_HEAD] = array(
            $this->amdFile => $this->amdFile,
            ) + $this->scriptFiles[self::POS_HEAD];
        if (!isset($this->scripts[self::POS_HEAD]))
            $this->scripts[self::POS_HEAD] = array();
        $this->scripts[self::POS_HEAD] = array(
            'amd' => 'require.config(' . CJSON::encode($conf) . ");\n" . $eval . "console.log(" . CJSON::encode($this->amd) . ")",
            ) + $this->scripts[self::POS_HEAD];
    }
    
    public function addPackagesToAMDConfig()
    {
        $shim = array();
        $paths = array();
        $fake = array();

        // переберём все пакеты, в которых есть js и
        // составим конфиг shim для requirejs
        foreach ($this->packages as $name => $config)
            if (isset($config['amd']) && $config['amd'] && isset($config['js']) && !empty($config['js']))
            {
                $i = 0;
                $baseUrl = $this->getPackageBaseUrl($name);
                // Если один файл в пакете
                if (count($config['js']) == 1)
                {
                    $shim[$name] = array('deps' => array());
                    $url = $this->remapAMDScript($baseUrl, $config['js'][0]);
                    if (!isset($paths[$url]))
                        $paths[$url] = $name;
                    // Допишем зависимости от других модулей
                    if (isset($config['depends']))
                        $shim[$name]['deps'] = CMap::mergeArray ($config['depends'], $shim[$name]['deps']);
                }
                else
                // не один файл в пакете
                {
                    $fakeName = 'package-' . $name;
                    // Добавим фейковый модуль с группой зависимостей
                    $fake[$name] = array();
                    $pre = false;
                    foreach ($config['js'] as $script)
                    {
                        $url = $this->remapAMDScript($baseUrl, $script);
                        if (!isset($paths[$url]))
                            $paths[$url] = $fakeName . '(' . $i++ . ')';
                        $shim[$paths[$url]] = array('deps' => array());
                        $fake[$name][] = $paths[$url];
                        // Добавим зависимости от родительского модуля
                        if (isset($config['depends']))
                            $shim[$paths[$url]]['deps'] = $config['depends'];
                        // Добавим предыдущий модуль в зависимости (необходимо для загрузки цепочкой)
                        if($pre)
                            $shim[$paths[$url]]['deps'][] = $pre;
                        // Запомним предыдущий модуль
                        $pre = $paths[$url];
                    }
                    // Допишем зависимости от других модулей
                    if(isset($config['depends']))
                        $fake[$name] = CMap::mergeArray ($config['depends'], $fake[$name]);
                }
                // добавим опцию для пакетов в clientScript,
                // соответствующую опции exports в shim
                if (isset($config['exports']))
                    $shim[$name]['exports'] = $config['exports'];
                // если не было зависимостей, то удалим пустой массив
                if (empty($shim[$name]['deps']))
                    unset($shim[$name]['deps']);
            }

        // Запишем собранное в конфиг
        $paths = array_flip($paths);
        $this->amd = CMap::mergeArray(array(
                'paths' => $paths,
                'shim' => $shim,
        ), $this->amd);
        // Для фейковых модулей нужно выполнить их иницмализацию
        if (!isset($this->amd['eval']))
            $this->amd['eval'] = '';
        foreach ($fake as $name => $deps)
            $this->amd['eval'].= "define(\"" . $name . "\", " . CJSON::encode($deps) . ", function() { return null; });\n";
    }
    
    public function remapAMDScript($baseUrl, $script)
    {
        $name = basename($script);
        if (isset($this->scriptMap[$name]) && $this->scriptMap[$name] !== false)
            $script = $this->scriptMap[$name];
        else
            $script = $baseUrl . '/' . $script;
        return str_replace('.js' , '', $script);
    }

    public function registerAMD($id, $depends, $script = '')
    {
        if (!is_array($depends))
            $depends = array($depends);
        $modules = array_values($depends);
        $params = array();
        if (!isset($depends[0]))
        {
            $params = array_keys($depends);
        }
        return $this->registerScript($id, "$(document).ready(function() { require(" . CJSON::encode($modules) . ", function( " . implode(', ', $params) . " ) {\n" . $script . "\n}); });", self::POS_AMD);
    }

    public function registerAMDFile($depends, $file)
    {
        return $this->registerScript($file, '$(document).ready(function() { require(' . CJSON::encode($depends) . ', function() { require(["' . $file . '"]); }); });', self::POS_AMD);
    }

    public function getHasNoindex()
    {
        $robotsTxt = array(
            'albums',
            'signup',
            'search',
            'messaging',
        );

        foreach ($robotsTxt as $segment)
            if (strpos(Yii::app()->request->requestUri, '/' . $segment) === 0)
                return true;


        foreach ($this->metaTags as $tag)
            if (isset($tag['name']) && isset($tag['content']) && $tag['name'] == 'robots' && $tag['content'] == 'noindex')
                return true;

        return false;
    }
    
    protected function exception()
    {
        throw new Exception ('Необходимо использовать метод ClientScript::registerAMD для работы в режиме AMD');
    }

    public function registerScript($id, $script, $position = null, array $htmlOptions = array())
    {
        if ($this->useAMD && $position != self::POS_AMD)
            $this->exception();
        else
            return parent::registerScript($id, $script, $position == self::POS_AMD ? self::POS_HEAD : $position, $htmlOptions);
    }

    public function registerCoreScript($name)
    {
        if ($this->useAMD)
            $this->exception();
        else
            return parent::registerCoreScript($name);
    }

    public function registerPackage($name)
    {
        if ($this->useAMD)
            $this->exception();
        else
            return parent::registerPackage($name);
    }

    public function registerScriptFile($url,$position=null,array $htmlOptions=array())
    {
        if($this->useAMD)
            $this->exception();
        else
            return parent::registerScriptFile($url, $position, $htmlOptions);
    }

    /**
     * Добавляет id релиза к URL
     * @param $url
     * @return string
     */
    protected function addReleaseId($url)
    {
        $r = $this->getReleaseId();
        $url .= (strpos($url, '?') === false) ? '?r=' . $r : '&r=' . $r;
        return $url;
    }

    /**
     * Генерирует новый id после каждого релиза
     * @return bool|mixed|string
     */
    protected function getReleaseId()
    {
        $id = Yii::app()->getGlobalState(self::RELEASE_ID_KEY);
        if ($id === null) {
            $id = Yii::app()->securityManager->generateRandomString(32, false);
            Yii::app()->setGlobalState(self::RELEASE_ID_KEY, $id);
        }
        return $id;
    }

    /**
     * Объединяет все файлы, перечисленные в packages в несколько файлов, по количеству равное позициям вставки
     * клиент-скрипта. Исходные файлы удаляет из scriptFiles, полученные добавляет
     */
    public function renderCoreScripts()
    {
        if ($this->jsCombineEnabled !== true) {
            parent::renderCoreScripts();
            return;
        }

        if (Yii::app()->request->isAjaxRequest)
            return;

        $scriptFilesTemp = $this->scriptFiles;
        $this->scriptFiles = array();
        foreach ($this->packages as $package => $settings)
            $this->registerPackage($package);
        parent::renderCoreScripts();

        $releaseId = $this->getReleaseId();
        $combinedScripts = array();
        foreach ($this->scriptFiles as $position => $scriptFiles) {
            $hash = md5($releaseId . $position);
            $dir = substr($hash, 0, 2);
            $file = substr($hash, 2);
            $dirPath = Yii::getPathOfAlias('application.www-submodule.jsd') . DIRECTORY_SEPARATOR . $dir;
            $path = $dirPath . DIRECTORY_SEPARATOR . $file . '.js';
            if (! file_exists($path)) {
                $js = '';
                foreach ($scriptFiles as $scriptFile => $scriptFileValue) {
                    if (strpos($scriptFile, '/') === 0)
                        $scriptFile = Yii::getPathOfAlias('webroot') . $scriptFile;
                    $fileSrc = file_get_contents($scriptFile);
                    $js .= $fileSrc . ';';
                }

                if (! is_dir($dirPath))
                    mkdir($dirPath);
                file_put_contents($path, $js);
            }

            $url = '/jsd/' . $dir . '/' . $file . '.js';
            if ($this->getJsStaticDomain())
                $url = $this->getJsStaticDomain() . $url;
            $combinedScripts[$position] = $url;
        }

        $this->scriptFiles = array();
        foreach ($combinedScripts as $position => $val)
            $this->scriptFiles[$position][$url] = $url;
        foreach ($scriptFilesTemp as $position => $scriptFiles)
            foreach ($scriptFiles as $scriptFile => $scriptFileValue)
                $this->scriptFiles[$position][$scriptFile] = $scriptFileValue;
    }

    /**
     * Трансформирует относительные ссылки в абсолютные, подставляя домен
     */
    protected function processCssFiles()
    {
        foreach ($this->cssFiles as $url => $media) {
            unset($this->cssFiles[$url]);
            if ($this->getCssStaticDomain() !== null && strpos($url, '/') === 0)
                $url = $this->getCssStaticDomain() . $url;
            $url = $this->addReleaseId($url);
            $this->cssFiles[$url] = $media;
        }
    }

    /**
     * Трансформирует относительные ссылки в абсолютные, подставляя домен
     */
    protected function processJsFiles()
    {
        foreach ($this->scriptFiles as $position => $scriptFiles) {
            foreach ($scriptFiles as $scriptFile => $scriptFileValue) {
                unset($this->scriptFiles[$position][$scriptFile]);
                if ($this->getJsStaticDomain() !== null && strpos($scriptFile, '/') === 0)
                    $scriptFile = $this->getJsStaticDomain() . $scriptFile;
                $scriptFile = $this->addReleaseId($scriptFile);
                $this->scriptFiles[$position][$scriptFile] = $scriptFileValue;
            }
        }
    }

    /**
     * Трансформирует относительные ссылки изображений верстки в абсолютные, подставляя домен
     *
     * Необходимо учитывать, что изображения, вставленные с помощью CCaptchaWidget - тоже изображения, но
     * их этот метод обрабатывать не должен, иначе они не будут отображаться
     *
     * @todo Сейчас регулярка неуниверсальна, работает только если атрибут src первым в img
     * @param $content
     */
    protected function processImages(&$content)
    {
        if ($this->getImagesStaticDomain() !== null) {
            $content = preg_replace('#img src="(\/[^"]*)"#', 'img src="' . $this->getImagesStaticDomain() . "$1\"", $content);
        }
    }

    /**
     * Возвращает домен для css
     *
     * Вынесено в отдельный метод, потому что в будущем может появиться необходимость ротации доменов в зависимости
     * от имени файла
     *
     * @return mixed
     */
    protected function getCssStaticDomain()
    {
        return $this->cssDomain;
    }

    /**
     * Возвращает домен для скриптов
     *
     * Вынесено в отдельный метод, потому что в будущем может появиться необходимость ротации доменов в зависимости
     * от имени файла
     *
     * @return mixed
     */
    protected function getJsStaticDomain()
    {
        return $this->jsDomain;
    }

    /**
     * Возвращает домен для изображения
     *
     * Вынесено в отдельный метод, потому что в будущем может появиться необходимость ротации доменов в зависимости
     * от имени файла
     *
     * @return mixed
     */
    protected function getImagesStaticDomain()
    {
        return $this->imagesDomain;
    }
}