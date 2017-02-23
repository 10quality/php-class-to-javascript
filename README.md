# Class to Javascropt (PHP trait)

[![Latest Stable Version](https://poser.pugx.org//10quality/php-class-to-javascript/v/stable)](https://packagist.org/packages//10quality/php-class-to-javascript)
[![Total Downloads](https://poser.pugx.org//10quality/php-class-to-javascript/downloads)](https://packagist.org/packages//10quality/php-class-to-javascript)
[![License](https://poser.pugx.org//10quality/php-class-to-javascript/license)](https://packagist.org/packages//10quality/php-class-to-javascript)

PHP trait that casts (transforms, converts) classes into javascript objects (string version).

## Installation

With composer, make the dependecy required in your project:
```bash
composer require /10quality/php-class-to-javascript
```

## Usage

Add trait to the wanted class:
```php
use TenQuality\Traits\CastJavascriptTrait;

class MyClass
{
    use CastJavascriptTrait;
}
```

The user the casting methods:
```php
$class = new MyClass;
$class->toJS();
$class->to_js(); // Alias
```

### Hide properties

To hide properties on casting, add the `hidden` property to the class:
```php
class MyClass
{
    use CastJavascriptTrait;

    protected $hidden = [
        'propertyA',
        'property_2',
    ];
}
```

### Properties selection

To select a specific selection of properties to cast, add the `castingProperties` property to the class:
```php
class MyClass
{
    use CastJavascriptTrait;

    // (1) As array
    protected $castingProperties = [
        'propertyA',
        'property_2',
    ];
}
```

```php
class MyClass
{
    use CastJavascriptTrait;

    protected $attributes = [
        'id',
        'name',
    ];

    // (1) As property mapping
    protected $castingProperties = 'attributes';
}
```

## Coding guidelines

PSR-4.

## LICENSE

The MIT License (MIT)

Copyright (c) 2017 [10Quality](http://www.10quality.com).
