<?php
/**
 * @author Никита
 * @date 18/11/15
 */

namespace site\frontend\modules\som\modules\qa\widgets\categories;


use site\frontend\modules\som\modules\qa\models\QaCategory;
use site\frontend\modules\som\modules\qa\models\QaQuestion;

class MainCategoriesMenu extends CategoriesMenu
{
    protected function getFirstItem()
    {
        $count = QaQuestion::model()->notConsultation()->count();
        return $this->getItem('Все вопросы', $count, $this->augmentUrl(array('/som/qa/default/index/')));
    }

    protected function getCountByCategory(QaCategory $category)
    {
        return $category->questionsCount;
    }

    protected function getUrlByCategory(QaCategory $category)
    {
        return $this->augmentUrl(array(
            '/som/qa/default/index/',
            'categoryId' => $category->id,
        ));
    }

    protected function getCategories()
    {
        return QaCategory::model()->with('questionsCount')->findAll();
    }

    protected function augmentUrl($url)
    {
        if (isset(\Yii::app()->controller->actionParams['tab']) && \Yii::app()->controller->actionParams['tab'] != 'new') {
            $url['tab'] = \Yii::app()->controller->actionParams['tab'];
        }
        return $url;
    }
}