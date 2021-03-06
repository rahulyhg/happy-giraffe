<?php
/**
 * @author Никита
 * @date 12/10/15
 */

namespace site\frontend\modules\posts\modules\buzz\widgets;

use site\common\helpers\HStr;
use site\frontend\modules\posts\components\ReverseParser;
use site\frontend\modules\posts\models\Content;
use site\frontend\modules\posts\models\Label;

\Yii::import('site.frontend.components.video.*');

class SidebarWidget extends \CWidget
{
    const LAST_DAYS = 2;
    const LIMIT = 5;
    const CACHE_PREFIX = 'HappyGiraffe.Buzz.v.';

    /**
     * @var \CommunityClub
     */
    public $club;

    public $cacheId = 'dbCache';

    public function run()
    {
        $labels = array(Label::LABEL_BUZZ);
        if ($this->club) {
            $labels[] = $this->club->toLabel();
        }
        $posts = Content::model()->byLabels($labels)->publishedAtLast(3600 * 24 * self::LAST_DAYS)->findAll(array(
            'limit' => self::LIMIT,
            'order' => 'RAND()', // @todo убрать медленный RAND()
        ));
        $this->render('main', compact('posts'));
    }

    public function getHtml($post, $renew = false)
    {
        $cacheId = $this->getCacheKey($post->id);
        $value = $this->getCache()->get($cacheId);
        if ($value === false || $renew) {
            $value = $this->getContentHtml($post);
            $dependency = new \CDbCacheDependency("SELECT dtimeUpdate FROM " . Content::model()->tableName() . " WHERE id = :id");
            $dependency->params = array(
                ':id' => $post->id,
            );
            $this->getCache()->set($cacheId, $value, 0, $dependency);
        }
        return $value;
    }

    protected function getContentHtml($post)
    {
        $parser = new ReverseParser($post->html);
        $previewParser = new ReverseParser($post->preview);
        if (count($parser->gifs) > 0) {
            return $this->render('_gif', $parser->gifs[0], true);
        }
        if (count($parser->videos) > 0) {
            $videoData = $parser->videos[0];
            $id = $videoData['id'];
            $url = 'http://www.youtube.com/watch?v=' . $id;
            try {
                $video = \Video::factory($url);
            } catch (\CException $e) {
                return \CHtml::tag('p', array(), 'Видео недоступно.');
            }
            return $this->render('_video', compact('video'), true);
        }
        $images = array_merge($previewParser->images, $parser->images);
        if (count($images) > 0) {
            return $this->render('_img', $images[0], true);
        }
        return \CHtml::tag('p', array(), HStr::truncate($post->text));
    }

    protected function getCacheKey($postId)
    {
        return self::CACHE_PREFIX . $postId;
    }

    /**
     *
     * @return \CCache
     */
    protected function getCache()
    {
        return \Yii::app()->getComponent($this->cacheId);
    }
}