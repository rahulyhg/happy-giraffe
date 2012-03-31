<?php
/* @var $this Controller
 * @var $user User
 */
$js = '
    Family.userId='.$user->id.';
    Family.partner_id='.$user->partner->id.';
    Family.partnerOf = '.CJavaScript::encode($user->getPartnerTitlesOf()).';
    Family.baby_count = '.$user->babyCount().';
';
Yii::app()->clientScript->registerScript('family-edit',$js);
?>
<div class="user-cols clearfix">

    <div class="col-1">
        <?php $this->widget('application.widgets.user.FamilyWidget', array('user' => $user)); ?>
    </div>

    <div class="col-23 clearfix">

        <div class="family">

            <div class="content-title">Моя семья</div>

            <div class="family-radiogroup">
                <div class="title">Семейное положение</div>
                <div class="radiogroup">
                    <?php foreach ($user->getRelashionshipList() as $status_key => $status_text): ?>
                        <div class="radio-label<?php if ($user->relationship_status == $status_key) echo ' checked' ?>" onclick="Family.setStatusRadio(this, <?=$status_key ?>);"><span><?=$status_text ?></span><input type="radio" name="radio-<?=$status_key ?>"></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ($user->hasPartner()):?>
                <div class="family-member" id="user-partner">

                    <div class="data clearfix">

                        <div class="d-text">Имя <span><?=$user->getPartnerTitleOf() ?></span>:</div>

                        <div class="name">
                            <div class="text"<?php if (empty($user->partner->name)) echo ' style="display:none;"' ?>><?=$user->partner->name ?></div>
                            <div class="input"<?php if (!empty($user->partner->name)) echo ' style="display:none;"' ?>>
                                <input type="text">
                                <button class="btn btn-green-small" onclick="Family.savePartnerName(this);"><span><span>Ok</span></span></button>
                            </div>
                            <a href="javascript:void(0);" onclick="Family.editPartnerName(this)" class="edit"<?php if (empty($user->partner->name)) echo ' style="display:none;"' ?>><span class="tip">Редактировать имя</span></a>
                        </div>

                        <div<?php if (empty($user->partner->name)) echo ' style="display:none;"' ?>>
                            <div class="age"<?php if (empty($user->partner->birthday)) echo ' style="display:none;"' ?>>
                                <?=$user->partner->getAge() ?>
                            </div>
                            <div class="date">
                                <a href="javascript:void(0);" onclick="Family.editDate(this);" class="date"><span class="tip">Укажите дату рождения</span></a>
                                <div class="datepicker" style="display:none;">
                                    <div class="tale"></div>
                                    <?php echo CHtml::dropDownList('partner_d', $user->partner->getBDatePart('j'), array(''=>' ')+HDate::Days(), array(
                                        'class'=>'chzn w-50 date',
                                        'data-placeholder'=>' '
                                    )) ?>
                                    &nbsp;
                                    <?php echo CHtml::dropDownList('partner_m', $user->partner->getBDatePart('n'), array(''=>' ')+HDate::ruMonths(), array(
                                        'class'=>'chzn w-100 month',
                                        'data-placeholder'=>' '
                                    )) ?>
                                    &nbsp;
                                    <?php echo CHtml::dropDownList('partner_y', $user->partner->getBDatePart('Y'), array(''=>' ')+HDate::Range(date('Y')-16, date('Y') - 100), array(
                                        'class'=>'chzn w-50 year',
                                        'data-placeholder'=>' '
                                    )) ?>
                                    &nbsp;
                                    <button class="btn btn-green-small" onclick="Family.saveDate(this)"><span><span>Ok</span></span></button>
                                </div>
                            </div>
                            <a href="javascript:void(0);" onclick="Family.editPartnerNotice(this)" class="comment"><span class="tip">Расскажите о <?= ($user->gender == 1)?'ней':'нем' ?></span></a>
                            <a href="javascript:void(0);" class="photo"><span class="tip">Добавить 4 фото</span></a>
                        </div>
                    </div>

                    <div class="comment"<?php if (empty($user->partner->notice)) echo ' style="display:none;"' ?>>
                        <div class="input" style="display:none;">
                            <div class="tale"></div>
                            <textarea><?=$user->partner->notice ?></textarea>
                            <button class="btn btn-green-small" onclick="Family.savePartnerNotice(this)"><span><span>Ok</span></span></button>
                        </div>
                        <div class="text"><span class="text"><?=$user->partner->notice ?></span> <a href="javascript:void(0);" onclick="Family.editPartnerNotice(this)" class="edit"><span class="tip">Редактировать комментарий</span></a></div>
                    </div>

                </div>
            <?php endif ?>

            <br>

            <div class="family-radiogroup">
                <div class="title">Мои дети</div>
                <div class="radiogroup">
                    <div class="radio-label<?php if($user->hasBaby(Baby::TYPE_PLANNING) == 1) echo ' checked'?>" onclick="Family.setFutureBaby(this, <?=Baby::TYPE_PLANNING ?>);"><span>Планируем</span><input type="radio" name="radio-2"></div>
                    <div class="radio-label<?php if($user->hasBaby(Baby::TYPE_WAIT) == 1) echo ' checked'?>" onclick="Family.setFutureBaby(this, <?=Baby::TYPE_WAIT ?>);"><span>Ждем</span><input type="radio" name="radio-2"></div>
                </div>
                &nbsp;
                <div class="radiogroup">
                    <div class="radio-label<?php if($user->babyCount() == 1) echo ' checked'?>" onclick="Family.setBaby(this, 1);"><span>1 ребенок</span><input type="radio" name="radio-3"></div>
                    <div class="radio-label<?php if($user->babyCount() == 2) echo ' checked'?>" onclick="Family.setBaby(this, 2);"><span>2 ребенка</span><input type="radio" name="radio-3"></div>
                    <div class="radio-label<?php if($user->babyCount() == 3) echo ' checked'?>" onclick="Family.setBaby(this, 3);"><span>3 ребенка</span><input type="radio" name="radio-3"></div>
                </div>
            </div>

            <?php $i=1; foreach ($user->babies as $baby): ?>
                <div class="family-member" id="baby-<?=$i ?>">
                    <input type="hidden" value="<?=$baby->id ?>" class="baby-id">
                    <div class="data clearfix">
                        <div class="d-text">Имя <?=$i ?>-го ребенка:</div>

                        <div class="name">
                            <div class="text"<?php if (empty($baby->name)) echo ' style="display:none;"' ?>><?=$baby->name ?></div>
                            <div class="input"<?php if (!empty($baby->name)) echo ' style="display:none;"' ?>>
                                <input type="text">
                                <button class="btn btn-green-small" onclick="Family.saveBabyName(this);"><span><span>Ok</span></span></button>
                            </div>
                            <a href="javascript:void(0);" onclick="Family.editBabyName(this)" class="edit"<?php if (empty($baby->name)) echo ' style="display:none;"' ?>><span class="tip">Редактировать имя</span></a>
                        </div>

                        <div<?php if (empty($baby->name)) echo ' style="display:none;"' ?> class="hide-on-start">
                            <a href="javascript:void(0);" class="gender male<?php if ($baby->sex == 1) echo ' active'?>" onclick="Family.saveBabyGender(this, 1)"><span class="tip">Мальчик</span></a>
                            <a href="javascript:void(0);" class="gender female<?php if ($baby->sex == 0) echo ' active'?>" onclick="Family.saveBabyGender(this, 0)"><span class="tip">Девочка</span></a>

                            <div<?php if ($baby->sex === null) echo ' style="display:none;"' ?> class="hide-on-start">
                                <div class="age">
                                    <?= $baby->getTextAge() ?>
                                </div>
                                <div class="date">
                                    <a href="javascript:void(0);" onclick="Family.editDate(this);" class="date"><span class="tip">Укажите дату рождения</span></a>
                                    <div class="datepicker" style="display:none;">
                                        <div class="tale"></div>
                                        <?php echo CHtml::dropDownList('baby_d_'.$i, $baby->getBDatePart('j'), array(''=>' ')+HDate::Days(), array(
                                        'class'=>'chzn w-50 date',
                                        'data-placeholder'=>' '
                                    )) ?>
                                        &nbsp;
                                        <?php echo CHtml::dropDownList('baby_m_'.$i, $baby->getBDatePart('n'), array(''=>' ')+HDate::ruMonths(), array(
                                        'class'=>'chzn w-100 month',
                                        'data-placeholder'=>' '
                                    )) ?>
                                        &nbsp;
                                        <?php echo CHtml::dropDownList('baby_y_'.$i, $baby->getBDatePart('Y'), array(''=>' ')+HDate::Range(date('Y'), date('Y') - 50), array(
                                        'class'=>'chzn w-50 year',
                                        'data-placeholder'=>' '
                                    )) ?>
                                        &nbsp;
                                        <button class="btn btn-green-small" onclick="Family.saveBabyDate(this)"><span><span>Ok</span></span></button>
                                    </div>
                                </div>

                                <a href="javascript:void(0);" onclick="Family.editBabyNotice(this)" class="comment"><span class="tip">Расскажите о нем</span></a>
                                <a href="javascript:void(0);" class="photo"><span class="tip">Добавить 4 фото</span></a>

                            </div>
                        </div>
                    </div>

                    <div class="comment"<?php if (empty($baby->notice)) echo ' style="display:none;"' ?>>
                        <div class="input" style="display:none;">
                            <div class="tale"></div>
                            <textarea><?=$baby->notice ?></textarea>
                            <button class="btn btn-green-small" onclick="Family.saveBabyNotice(this)"><span><span>Ok</span></span></button>
                        </div>
                        <div class="text"><span class="text"><?=$baby->notice ?></span> <a href="javascript:void(0);" onclick="Family.editBabyNotice(this)" class="edit"><span class="tip">Редактировать комментарий</span></a></div>
                    </div>

                    <div class="photos" style="display:none;">
                        <ul>
                            <li>
                                <img src="/images/example/ex3.jpg">
                                <a href="" class="remove"></a>
                            </li>
                            <li>
                                <img src="/images/example/ex4.jpg">
                                <a href="" class="remove"></a>
                            </li>
                            <li class="add">
                                <a href="">
                                    <i class="icon"></i>
                                    <span>Загрузить еще<br> 2 фотографии</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            <?php $i++; ?>
            <?php endforeach; ?>

            <?php while($i <= 3){ ?>
            <div class="family-member" style="display:none;" id="baby-<?=$i ?>">
                <?php $this->renderPartial('_empty_child',array('i'=>$i)); ?>
            </div>
            <?php $i++; ?>
            <?php } ?>
        </div>

    </div>

</div>