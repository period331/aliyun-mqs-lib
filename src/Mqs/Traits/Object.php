<?php
/**
 * Created by PhpStorm.
 * User: baocaixiong
 * Date: 15/2/8
 * Time: 下午2:36
 */

namespace Mqs\Traits;


trait Object
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @param array $attributes
     */
    protected function setterConstruct(array $attributes)
    {
        $this->attributes = $attributes;

        foreach ($attributes as $key => $value) {
            $setter = 'set'.studly_case($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            } elseif (property_exists($this, $pro = camel_case($key))) {
                $this->$pro = $value;
            }
        }
    }
}