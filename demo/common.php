<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2020/7/11
 * Time: 13:24
 */

$vendorFile = dirname(__DIR__)  .  '/vendor/autoload.php';
if(file_exists($vendorFile)) {
    require $vendorFile;
} else {
    require_once dirname(__DIR__) . '/src/helper.php';
    spl_autoload_register(function ($class) {
        $ns = 'CjsNacos';
        $base_dir = dirname(__DIR__) . '/src';
        $prefix_len = strlen($ns);
        if (substr($class, 0, $prefix_len) !== $ns) {
            return;
        }
        $class = substr($class, $prefix_len);
        $file = $base_dir .str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (is_readable($file)) {
            require $file;
        }

    });

}
