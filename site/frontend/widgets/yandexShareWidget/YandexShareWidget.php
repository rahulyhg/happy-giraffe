<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mikita
 * Date: 26/04/14
 * Time: 11:19
 * To change this template use File | Settings | File Templates.
 */

class YandexShareWidget extends CWidget
{
    /**
     * @var HActiveRecord|IPreview
     */
    public $model;

    public $description;
    public $imageUrl;
    private $_id;

    public function init()
    {
        if ($this->description === null) {
            $this->description = $this->model->getPreviewText();
        }

        if ($this->imageUrl === null) {
            $this->imageUrl = $this->getImageUrl();
        }
    }

    public function run()
    {
        $this->registerScript();
        $this->registerMeta();
        $json = CJSON::encode(array(
            'element' => $this->getElementId(),
            'theme' => 'counter',
            'elementStyle' => array(
                'type' => 'small',
                'quickServices' => array(
                    'vkontakte',
                    'odnoklassniki',
                    'facebook',
                    'twitter',
                    'moimir',
                    'gplus',
                ),
            ),
            'description' => $this->description,
            'image' => $this->imageUrl,
        ));
        $this->render('view', compact('json'));
    }

    public function getElementId()
    {
        if ($this->_id === null) {
            $this->_id = 'ya_share_' . md5(get_class($this->model) . $this->model->primaryKey);
        }
        return $this->_id;
    }

    protected function registerScript()
    {
        /** @var ClientScript $cs */
        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile('//yandex.st/share/share.js', null, array(
            'charset' => 'utf-8',
        ));
    }

    protected function registerMeta()
    {
        /** @var ClientScript $cs */
        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag($this->imageUrl, null, null, array('property' => 'og:image'));
        $cs->registerMetaTag($this->description, null, null, array('property' => 'og:description'));
    }

    protected function getDefaultImage()
    {
        return Yii::app()->request->hostInfo . '/new/images/base/logo.png';
    }

    protected function getImageUrl()
    {
        $photo = $this->model->getPreviewPhoto();
        return ($photo === null) ? $this->getDefaultImage() : $photo->getPreviewUrl(800, null, Image::WIDTH);
    }
}