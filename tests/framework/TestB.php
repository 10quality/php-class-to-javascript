<?php

use TenQuality\Traits\CastJavascriptTrait;

class TestB
{
    use CastJavascriptTrait;

    protected $id;

    protected $name;

    protected $data;

    protected $hidden = [
        'id',
        'name'
    ];

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            $this->{$property} = $value;
    }
}