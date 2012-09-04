<?php
/**
 * Author: alexk984
 * Date: 30.08.12
 */
class CoWorkersPostCommentator extends PostForCommentator
{
    protected $entities = array(
        'CommunityContent' => array(15),
        'CookRecipe' => array(2, 3),
    );
    protected $nextGroup = 'TrafficPostForCommentator';

    public function getPost()
    {
        $this->way [] = get_class($this);

        $criteria = $this->getCriteria(false);
        $posts = $this->getPosts($criteria);

        if (count($posts) == 0) {

            if ($this->isCategoryEmpty(false))
                return $this->nextGroup();
            else
                return $this->getPost();
        } else {
            return array(get_class($posts[0]), $posts[0]->id);
        }
    }
}
