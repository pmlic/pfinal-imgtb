<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2017/12/11
 * Time: 15:48
 */
namespace pf\img;
use pf\img\code\Common;

class PFImg {
    protected $pf_array_link;
    protected function driver()
    {
        $this->pf_array_link = new Common();
        return $this;
    }

    public function __call($method, $params)
    {
        if (is_null($this->pf_array_link)) {
            $this->driver();
        }
        if (method_exists($this->pf_array_link, $method)) {
            return call_user_func_array([$this->pf_array_link, $method], $params);
        }
    }

    public static function single()
    {
        static $pf_array_link;
        if (is_null($pf_array_link)) {
            $pf_array_link = new static();
        }
        return $pf_array_link;
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::single(), $name], $arguments);
    }
}