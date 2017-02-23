<?php

use TenQuality\Traits\CastJavascriptTrait;

class TestC
{
    use CastJavascriptTrait;

    protected $id;

    protected $name;

    protected $flag;

    protected $aliases = [
        'id',
    ];

    protected $castingProperties = 'aliases';

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            $this->{$property} = $value;
    }
}