<?php
/**
 * @author Никита
 * @date 23/01/17
 */

namespace site\frontend\modules\geo\helpers;

class GeoHelper
{
    public static function chooseCityByRegion($cities, $region, $threshold = 50)
    {
        $maxSimilarity = 0;
        $city = null;
        foreach ($cities as $_city) {
            similar_text($_city->region->name, $region, $similarity);
            if ($_city->type == 'г') {
                $similarity++;
            }
            if ($similarity > $threshold && $similarity > $maxSimilarity) {
                $maxSimilarity = $similarity;
                $city = $_city;
            }
        }
        return $city;
    }
}