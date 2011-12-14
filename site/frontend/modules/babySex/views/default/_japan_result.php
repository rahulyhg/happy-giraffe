<?php
/* @var $model BloodRefreshForm
 * @var $form CActiveForm
 */
?>
<div class="mother_calendar">
    <div class="choice_month">
        <a href="#" class="l_arr_mth_active" id="japan-prev-month">&larr;</a>
        <a href="#" class="r_arr_mth_active" id="japan-next-month">&rarr;</a>
        <span><?php echo  HDate::ruMonth($month) ?></span>
    </div>
    <!-- .choice_month -->
    <table class="calendar_body">
        <tr>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th>Сб</th>
            <th>Вс</th>
        </tr>
        <tr>
            <?php
            $i = 0;
            foreach ($data as $cell) {
                if ($i % 7 == 0 && $i != 0 && count($data) != $i)
                    echo "</tr><tr>";
                $i++;?>
                <td>
                    <?php if ($cell['other_month']): ?>

                    <?php if ($cell['sex'] == BloodRefreshForm::IS_BOY)
                        $class = 'boy_cl';
                    elseif ($cell['sex'] == BloodRefreshForm::IS_GIRL)
                        $class = 'girl_cl';
                    else
                        $class = '';?>
                    <div class="cal_item_default">
                        <div
                            class="cal_item <?php echo $class ?>" <?php echo 'style="opacity:' . $cell['opacity'] . '"' ?>>
                            <ins><?php echo $cell['day'] ?></ins>
                        </div>

                        <?php if ($cell['probability'] > 0): ?>
                        <div class="hint" style="display: none;">
                            <?php echo $cell['probability'] ?> %
                        </div>
                        <?php endif ?>
                    </div>

                    <?php else: ?>

                    <?php
                    $baby = '';
                    if ($cell['sex'] == BloodRefreshForm::IS_BOY)
                        $baby = '<div class="boy_lvl5" style="opacity:' . $cell['opacity'] . '"></div>';
                    elseif ($cell['sex'] == BloodRefreshForm::IS_GIRL)
                        $baby = '<div class="girl_lvl5" style="opacity:' . $cell['opacity'] . '"></div>';
                    ?>
                    <div class="cal_item<?php if ($cell['day'] == $model->baby_d
                        && !$cell['other_month'] && $month == $model->baby_m
                    ) echo ' active_item' ?>">
                        <?php echo $baby ?>
                        <ins><?php echo $cell['day'] ?></ins>
                        <?php if ($cell['probability'] > 0): ?>
                        <div class="hint" style="display: none;">
                            <?php echo $cell['probability'] ?> %
                        </div>
                        <?php endif ?>
                    </div>

                    <?php endif ?>
                </td>
                <?php } ?>
        </tr>
    </table>
</div><!-- .mother_calendar -->
<?php if ($gender == BloodRefreshForm::IS_GIRL): ?>
<div class="wh_wait wh_daughter">
    <span class="title_wh_wait">Поздравляем! У вас будет девочка!</span>

    <p>Японский метод, основанный на датах рождения отца, матери и месяце зачатия говорит именно об этом. Точность
        метода 55% и он не гарантирует рождения девочки, зато так приятно помечтать об этом.</p>
</div><!-- .wh_wait -->
<?php endif ?>
<?php if ($gender == BloodRefreshForm::IS_BOY): ?>
<div class="wh_wait wh_son">
    <span class="title_wh_wait">Поздравляем! У вас будет мальчик! </span>

    <p>Так получается, исходя из дат рождения отца и матери, а также месяца зачатия. Этот известный японский метод точен
        на 55%, поэтому не гарантирует рождения мальчика, зато позволяет помечтать об этом.</p>
</div><!-- .wh_wait -->
<?php endif ?>
<?php if ($gender == BloodRefreshForm::IS_UNKNOWN): ?>
<div class="wh_wait">
    <p><b>Мальчик или девочка?</b> В вашем случае однозначного ответа японский метод не даёт. Попробуйте воспользоваться
        другими способами определения пола будущего ребёнка.</p>
</div><!-- .wh_wait -->
<?php endif ?>
