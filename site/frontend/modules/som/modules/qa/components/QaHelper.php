<?php
/**
 * @author Никита
 * @date 18/11/15
 */

namespace site\frontend\modules\som\modules\qa\components;


class QaHelper
{
    public static function getRatingClass($position)
    {
        switch ($position) {
            case 1:
                return 'yellow-crown';
            case 2:
                return 'blue-crown';
            case 3:
                return 'orange-crown';
        }
        return 'nocrown';
    }
}