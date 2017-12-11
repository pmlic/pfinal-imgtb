<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2017/12/11
 * Time: 15:53
 */

namespace pf\img\code;
error_reporting(0);

trait HandlingFile
{
    protected $filePath = "";
    protected $imgSize = [];
    protected $allow = ['jpg', 'png'];
    protected $ImageInfo;

    public function file($file_path)
    {
        if (!file_exists($file_path)) return false;
        $this->filePath = $file_path;
        $img_format = end(explode('.', $this->filePath));
        if (!in_array($img_format, $this->allow)) {

        } else {
            if ($img_format == 'png') {
                $this->ImageInfo = imagecreatefrompng($this->filePath);
            } else {
                $this->ImageInfo = imagecreatefromjpeg($this->filePath);
            }
        }
        $this->imgSize = $this->get_size($this->filePath);
        return $this;
    }

    private function get_size()
    {
        list($width, $height) = getimagesize($this->filePath);
        return ['width' => $width, 'height' => $height];
    }

    /**
     * 获取像素点的数据
     * @return array
     */
    public function get_data()
    {
        $rgbArray = [];
        for ($i = 0; $i < $this->imgSize['width']; ++$i) {
            for ($j = 0; $j < $this->imgSize['height']; ++$j) {
                $rgb = imagecolorat($this->ImageInfo, $j, $i);
                $rgbArray[$i][$j] = imagecolorsforindex($this->ImageInfo, $rgb);
            }
        }
        return $rgbArray;
    }

    /**
     * 灰度化
     */
    public function get_gray()
    {
        $grayArray = [];
        $rgbarray = $this->get_data();
        for ($i = 0; $i < $this->imgSize['width']; ++$i) {
            for ($j = 0; $j < $this->imgSize['height']; ++$j) {
                $grayArray[$i][$j] = (299 * $rgbarray[$i][$j]['red'] + 587 * $rgbarray[$i][$j]['green'] + 144 * $rgbarray[$i][$j]['blue']) / 1000;
            }
        }
        return $grayArray;
    }

    /**
     * 去到二值数组
     * @return array
     */
    public function get_erzhi()
    {
        $erzhiArray = [];
        $grayArray = $this->get_gray();
        for ($i = 0; $i < $this->imgSize['width']; ++$i) {
            for ($j = 0; $j < $this->imgSize['height']; ++$j) {
                if ($grayArray[$i][$j] < 90) {
                    $erzhiArray[$i][$j] = 1;
                } else {
                    $erzhiArray[$i][$j] = 0;
                }
            }
        }
        return $erzhiArray;
    }
}