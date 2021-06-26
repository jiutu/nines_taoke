<?php
/*
 * @Description: 
 * @Autor: BuWenGuiQi_
 * @Date: 2020-08-08 21:19:22
 * @LastEditTime: 2020-10-02 16:38:01
 */

class NinesTaoKeAutoloader
{

    /**
     * @description: 类库自动加载，写死路径，确保不加载其他文件。   
     * @author: BuWenGuiQi_
     * @param {type} 
     * @return {type} 
     */
    public static function autoload($class)
    {
        $name = $class;
        if (false !== strpos($name, '\\')) {
            $name = strstr($class, '\\', true);
        }
        $filename = NINES_TAOKE_PATH . "/includes/top/" . $name . ".php";
        if (is_file($filename)) {
            include $filename;
            return;
        }
        $filename = NINES_TAOKE_PATH . "/includes/top/request/" . $name . ".php";
        if (is_file($filename)) {
            include $filename;
            return;
        }
        $filename = NINES_TAOKE_PATH . "/includes/" . $name . ".php";
        if (is_file($filename)) {
            include $filename;
            return;
        }
    }
}
spl_autoload_register('NinesTaoKeAutoloader::autoload');
