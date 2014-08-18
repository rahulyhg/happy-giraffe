<?php
/**
 * Created by PhpStorm.
 * User: mikita
 * Date: 05/08/14
 * Time: 17:03
 */

class LiteController extends HController
{
    public $layout = '//layouts/lite/main';

    public function init()
    {
        header('Vary: User-Agent');
        $this->dnsPrefetch();
        parent::init();
    }

    protected function beforeRender($view)
    {
        if (parent::beforeRender($view)) {

            $cs = Yii::app()->clientScript;
            if (! empty($this->meta_description)) {
                $cs->registerMetaTag(Str::truncate(strip_tags(trim($this->meta_description)), 250), 'description');
            }

            if ($this->meta_keywords !== null) {
                $cs->registerMetaTag(trim($this->meta_keywords), 'keywords');
            }

            if ($this->meta_title !== null) {
                $this->pageTitle = Str::truncate(trim($this->meta_title), 70);
            }

            return true;
        }
    }

    protected function dnsPrefetch()
    {
        /**
         * @var ClientScript $cs
         */
        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag('on', null, 'x-dns-prefetch-control');
        $cs->registerLinkTag('dns-prefetch', null, '//plexor.www.happy-giraffe.ru');
        $cs->registerLinkTag('dns-prefetch', null, '//img.happy-giraffe.ru');
    }
} 