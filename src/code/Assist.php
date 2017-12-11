<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2017/12/11
 * Time: 16:24
 */

namespace pf\img\code;


trait Assist
{
    public function dd($arr)
    {
        echo '<pre>';
            print_r($arr);
        echo '</pre>';
    }

    /*根据灰度信息打印图片*/
    public function print_gray()
    {
        $grayArray = $this->get_gray();
        for ($k = 0; $k < 25; $k++) {
            echo $k . "\n";
            for ($i = 0; $i < $this->imgSize['width']; ++$i) {
                for ($j = 0; $j < $this->imgSize['height']; ++$j) {
                    if ($grayArray[$i][$j] < $k * 10) {
                        echo '■';
                    } else {
                        echo '□';
                    }
                }
                echo "|\n";
            }
            echo "---------------------------------------------------------------------------------------------------------------\n";
        }
    }
    /**
     * 二维码降噪
     */

    public function reduceZao($erzhiArray){
        $data = $erzhiArray;
        $gao = count($erzhiArray);
        $chang = count($erzhiArray['0']);
        $jiangzaoErzhiArray = array();

        for($i=0;$i<$gao;$i++){
            for($j=0;$j<$chang;$j++){
                $num = 0;
                if($data[$i][$j] == 1)
                {
                    // 上
                    if(isset($data[$i-1][$j])){
                        $num = $num + $data[$i-1][$j];
                    }
                    // 下
                    if(isset($data[$i+1][$j])){
                        $num = $num + $data[$i+1][$j];
                    }
                    // 左
                    if(isset($data[$i][$j-1])){
                        $num = $num + $data[$i][$j-1];
                    }
                    // 右
                    if(isset($data[$i][$j+1])){
                        $num = $num + $data[$i][$j+1];
                    }
                    // 上左
                    if(isset($data[$i-1][$j-1])){
                        $num = $num + $data[$i-1][$j-1];
                    }
                    // 上右
                    if(isset($data[$i-1][$j+1])){
                        $num = $num + $data[$i-1][$j+1];
                    }
                    // 下左
                    if(isset($data[$i+1][$j-1])){
                        $num = $num + $data[$i+1][$j-1];
                    }
                    // 下右
                    if(isset($data[$i+1][$j+1])){
                        $num = $num + $data[$i+1][$j+1];
                    }
                }

                if($num < 1){
                    $jiangzaoErzhiArray[$i][$j] = 0;
                }else{
                    $jiangzaoErzhiArray[$i][$j] = 1;
                }
            }
        }
        return $jiangzaoErzhiArray;
    }
}
