<?php

if (! function_exists('studly_case')) {

    /**
     * @param string $value
     * @return string
     */
    function studly_case ($value) {
        static $studlyCache = [];

        if (isset($studlyCache[$value]))
        {
            return $studlyCache[$value];
        }

        $value = ucwords(str_replace(array('-', '_'), ' ', $value));

        return $studlyCache[$value] = str_replace(' ', '', $value);
    }
}

if (! function_exists('camel_case')) {

    function camel_case($value)
    {
        if (isset($camelCache[$value]))
        {
            return $camelCache[$value];
        }

        return $camelCache[$value] = lcfirst(studly_case($value));
    }
}

if (! function_exists('class_basename')) {
    /**
     * @param string $class
     * @return string
     */
    function class_basename($class)
    {
        return basename(str_replace('\\', '/', $class));
    }
}

if (! function_exists('setter_construct')) {

    /**
     * @param $object
     * @return callable
     */
    function setter_construct($object)
    {
        $construct = function (array $attributes) {
            $this->attributes = $attributes;

            foreach ($attributes as $key => $value) {
                $setter = 'set'.studly_case($key);

                if (method_exists($this, $setter)) {
                    $this->$setter($value);
                } elseif (property_exists($this, $pro = camel_case($key))) {
                    $this->$pro = $value;
                }
            }
        };

        $construct->bindTo($object);

        return $construct;
    }
}
