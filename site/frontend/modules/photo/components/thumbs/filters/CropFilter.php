<?php
/**
 * Created by PhpStorm.
 * User: mikita
 * Date: 26/09/14
 * Time: 02:57 PM
 */

namespace site\frontend\modules\photo\components\thumbs\filters;


use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;

class CropFilter implements CustomFilterInterface
{
    public $cropData;
    public $height;
    public $width;

    public function __construct($cropData, $height, $width)
    {
        $this->x = $cropData['x'];
        $this->y = $cropData['y'];
        $this->w = $cropData['w'];
        $this->h = $cropData['h'];
        $this->height = $height;
        $this->width = $width;
    }

    public function getWidth($imageWidth, $imageHeight)
    {
        return $this->w;
    }

    public function getHeight($imageWidth, $imageHeight)
    {
        return $this->h;
    }

    public function apply(ImageInterface $image)
    {
        $image->crop(new Point($this->x, $this->y), new Box($this->w, $this->h));
        $image->resize(new Box($this->width, $this->height));
    }
} 