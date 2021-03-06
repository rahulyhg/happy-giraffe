<?php

return array(
    'class' => 'site\frontend\modules\ads\AdsModule',
//    'lines' => array(
//        'bigPost' => array(
//            'lineId' => 231258382,
//            'size' => array(
//                'width' => 615,
//                'height' => 450,
//            ),
//        ),
//        'smallPost' => array(
//            'lineId' => 231258622,
//            'size' => array(
//                'width' => 300,
//                'height' => 315,
//            ),
//        ),
//        'photoPost' => array(
//            'lineId' => 231258862,
//            'size' => array(
//                'width' => 300,
//                'height' => 450,
//            ),
//        ),
//    ),
    'lines' => array(
        'bigPost' => array(
            'lineId' => 225619569,
            'size' => array(
                'width' => 615,
                'height' => 450,
            ),
        ),
        'smallPost' => array(
            'lineId' => 225619929,
            'size' => array(
                'width' => 300,
                'height' => 315,
            ),
        ),
        'photoPost' => array(
            'lineId' => 225620289,
            'size' => array(
                'width' => 300,
                'height' => 450,
            ),
        ),
        'smallPostTest' => array(
            'lineId' => 348227529,
            'size' => array(
                'width' => 300,
                'height' => 315,
            ),
        ),
    ),
    'components' => array(
        'dfp' => array(
            'class' => 'site\frontend\modules\ads\components\DfpHelper',
            'advertiserId' => 52506489,
            'version' => 'v201611',
            'enableLogs' => false,
        ),
        'manager' => array(
            'class' => 'site\frontend\modules\ads\components\AdsManager'
        ),
        'creativesFactory' => array(
            'class' => 'site\frontend\modules\ads\components\creatives\CreativesFactory',
            'presets' => array(
                'bigPost' => array(
                    'class' => 'site\frontend\modules\ads\components\creatives\PostCreative',
                    'template' => 'post',
                    'size' => 'big',
                ),
                'smallPost' => array(
                    'class' => 'site\frontend\modules\ads\components\creatives\PostCreative',
                    'template' => 'post',
                    'size' => 'small',
                ),
                'smallPostTest' => array(
                    'class' => 'site\frontend\modules\ads\components\creatives\PostCreative',
                    'template' => 'post',
                    'size' => 'small',
                ),
                'photoPost' => array(
                    'class' => 'site\frontend\modules\ads\components\creatives\PhotoPostCreative',
                    'template' => 'photoPost',
                ),
            ),
        ),
    ),
);
