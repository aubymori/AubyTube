<?php
/**
 * Declare and install the module autoloader.
 * 
 * @author Taniko Yamamoto <kirasicecreamm@gmail.com>
 * @author The Rehike Maintainers
 */
if (!function_exists("autoloader")) {
    function autoloader($class) {
        // Replace "\" in the filename with "/" to prevent
        // crashes on non-Windows operating systems.
        $filename = str_replace("\\", "/", $class);
        $root = $_SERVER["DOCUMENT_ROOT"];

        // Scan the file system for the requested module.
        if (file_exists("modules/{$filename}.php")) {
            require $root . "/modules/{$filename}.php";
        } else if ("AubyTube/Model/" == substr($filename, 0, 15)) {
            $file = substr($filename, 14);

            require $root . "/models/${file}.php";
        } else if ("AubyTube/Controller/" == substr($filename, 0, 20)) {
            $file = substr($filename, 19);

            require $root . "/controllers/${file}.php";
        }

        // Implement the fake magic method __initStatic
        // for automatically initialising static classses.
        if (method_exists($class, "__initStatic")) {
            $class::__initStatic();
        }
    }
}

spl_autoload_register("autoloader");