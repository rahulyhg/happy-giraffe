<?php
/**
 * @var site\frontend\modules\som\modules\qa\controllers\DefaultController $this
 */

use site\frontend\modules\som\modules\qa\models\QaQuestion;
use site\frontend\modules\som\modules\qa\models\QaCategory;
use site\frontend\modules\som\modules\qa\models\qaTag\Enum;
use site\frontend\modules\som\modules\qa\models\QaTag;

$question = QaQuestion::model()->category(QaCategory::PEDIATRICIAN_ID);
$tags = QaTag::model()->byCategory(QaCategory::PEDIATRICIAN_ID)->findAll();
$tagEnum = new Enum();
$currentTagId = \Yii::app()->request->getParam('tagId');
?>

 <div class="b-text--left b-margin--bottom_40">
    <div class="b-filter-year">
        <ul class="b-filter-year__list">
        	<li class="b-filter-year__li <?=is_null($currentTagId) ? 'b-filter-year__li--active' : ''?>">
        		<a href="<?=$this->createUrl('/som/qa/default/pediatrician')?>" class="b-filter-year__link">
        			Все
        			<span><?=$question->count()?></span>
        		</a>
			</li>
        	<?php foreach ($tags as $tag) {?>
            	<li class="b-filter-year__li <?=$currentTagId == $tag->id ? 'b-filter-year__li--active' : ''?>">
            		<a href="<?=UrlCreator::create(UrlCreator::create(null)->getPath(), ['filter' => ['tag' => $tag->id]])?>" class="b-filter-year__link">
            			<?=$tagEnum->getTitleForWebMenu($tag->name)?>
            			<span><?=$question->byTag($tag->id)->count()?></span>
        			</a>
    			</li>
            <?php }?>
        </ul>
    </div>
</div>
