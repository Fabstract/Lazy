<?php

namespace Fabs\Component\Lazy;

use Fabs\Component\Assert\Assert;

class Lazy
{
    private static $instance_class_lookup = [];

    public static function load($class_name, $singleton = true)
    {
        Assert::isClassExists($class_name, 'class_name');
        Assert::isBoolean($singleton, 'singleton');

        if ($singleton === true) {
            if (array_key_exists($class_name, self::$instance_class_lookup) === true) {
                return self::$instance_class_lookup[$class_name];
            }
        }

        $instance = new $class_name();
        if ($singleton === true) {
            self::$instance_class_lookup[$class_name] = $instance;
        }
        return $instance;
    }
}
