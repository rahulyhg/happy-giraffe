<?php
/**
 * insert Description
 *
 * @author Alex Kireev <alexk984@gmail.com>
 */

class MonthStats
{
    public $date1;
    public $date2;

    public function start()
    {
        Yii::import('site.frontend.modules.messaging.models.*');
        Yii::import('site.frontend.modules.friends.models.*');
        echo "clubs\n";
        for ($i = 6; $i > 0; $i--) {
            $this->dates($i);
            $criteria = $this->getCriteria();
            $criteria->with = array('rubric');
            $criteria->addCondition('rubric.user_id IS NULL');
            $count = CommunityContent::model()->count($criteria);
            echo $count . "\n";
        }
//
//        echo "comments\n";
//        for ($i = 9; $i > 0; $i--) {
//            $this->dates($i);
//            $criteria = $this->getCriteria();
//            $count = Comment::model()->count($criteria);
//            echo $count . "\n";
//        }
//
//        echo "likes\n";
//        for ($i = 9; $i > 0; $i--) {
//            $this->dates($i);
//            $count = HGLike::model()->DateLikes($this->date1, $this->date2);
//            echo $count . "\n";
//        }
//
//        echo "messages\n";
//        for ($i = 9; $i > 0; $i--) {
//            $this->dates($i);
//            $criteria = $this->getCriteria();
//            $count = MessagingMessage::model()->count($criteria);
//            echo $count . "\n";
//        }
//
//        echo "friends\n";
//        for ($i = 9; $i > 0; $i--) {
//            $this->dates($i);
//            $criteria = $this->getCriteria();
//            $count = Friend::model()->count($criteria);
//            echo $count . "\n";
//        }

//        for ($i = 9; $i > 0; $i--) {
//            $count = 0;
//            $this->dates($i);
//            $criteria = $this->getCriteria();
//            $criteria->with = array('rubric');
//            $criteria->addCondition('rubric.user_id IS NOT NULL');
//            $posts = CommunityContent::model()->findAll($criteria);
//            foreach($posts as $post){
//                $criteria = new CDbCriteria;
//                $criteria->with = array('rubric');
//                $criteria->condition = 't.id < :id AND t.author_id = :author_id AND rubric.user_id IS NOT NULL';
//                $criteria->params = array(
//                    ':id' => $post->id,
//                    ':author_id' => $post->author_id,
//                );
//                $before = CommunityContent::model()->count($criteria);
//                if ($before == 0)
//                    $count++;
//            }
//            echo $count."\n";
//        }
    }

    private function dates($i)
    {
        $date = strtotime(' - ' . $i . ' month');
        $this->date1 = date("Y-m", $date) . '-01 00:00:00';
        $this->date2 = date("Y-m", $date) . '-31 59:59:59';
    }

    private function getCriteria()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'created >= :date1 AND created <= :date2';
        $criteria->params = array(
            ':date1' => $this->date1,
            ':date2' => $this->date2,
        );

        return $criteria;
    }

    public function AllStats()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('author', 'rubric');
        $criteria->condition = 'author.`group` != 0 and type_id < 3 and rubric.user_id IS NULL';
        $count = CommunityContent::model()->count($criteria);
        echo $count."\n";
        $criteria->condition = 'author.`group` = 0 and type_id < 3 and rubric.user_id IS NULL';
        $count = CommunityContent::model()->count($criteria);
        echo $count."\n";

        $criteria = new CDbCriteria;
        $criteria->with = array('author', 'rubric');
        $criteria->condition = 'author.`group` != 0 and type_id < 3 and rubric.user_id IS NOT NULL';
        $count = CommunityContent::model()->count($criteria);
        echo $count."\n";
        $criteria->condition = 'author.`group` = 0 and type_id < 3 and rubric.user_id IS NOT NULL';
        $count = CommunityContent::model()->count($criteria);
        echo $count."\n";

        $criteria = new CDbCriteria;
        $criteria->condition = 'by_happy_giraffe = 1';
        $count = CommunityContent::model()->count($criteria);
        echo $count."\n";

        $criteria = new CDbCriteria;
        $criteria->with = array('author');
        $criteria->condition = 'author.`group` != 0 and type_id = 2';
        $count = CommunityContent::model()->count($criteria);
        echo $count."\n";
        $criteria->condition = 'author.`group` = 0 and type_id = 2';
        $count = CommunityContent::model()->count($criteria);
        echo $count."\n";

        echo CommunityContentGallery::model()->count()."\n";
    }

    public function photo()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('album', 'author');
        $criteria->condition = 'author.`group` != 0 and album.type < 2';
        $count = AlbumPhoto::model()->count($criteria);
        echo $count."\n";
        $criteria->with = array('album', 'author');
        $criteria->condition = 'author.`group` = 0 and album.type < 2';
        $count = AlbumPhoto::model()->count($criteria);
        echo $count."\n";

        $criteria = new CDbCriteria;
        $criteria->with = array('author');
        $criteria->condition = 'author.`group` != 0';
        $count = Comment::model()->count($criteria);
        echo $count."\n";
        $criteria->with = array('author');
        $criteria->condition = 'author.`group` = 0';
        $count = Comment::model()->count($criteria);
        echo $count."\n";
    }
}