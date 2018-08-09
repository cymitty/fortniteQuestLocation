<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 8/9/2018
 * Time: 1:48 PM
 */

namespace MyFortniteBundle;


class Registry
{
    private static $instance;
    private $data = array();

    private function __construct() { }

    public static function instance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getData($key)
    {
        if ( isset($this->data[$key]) ) {
            return $this->data[$key];
        }
    }
}