<?php

namespace TenQuality\Traits;

/**
 * Trait used to cast classes into javascript objects. (string version)
 *
 * @link https://github.com/10quality/php-class-to-javascript
 * @author Alejandro Mostajo <info@10quality.com>
 * @copyright 10 Quality <http://www.10quality.com>
 * @license MIT
 * @package TenQuality\Traits (php-class-to-javascript)
 * @version 1.0.0
 */
trait CastJavascriptTrait
{
    /**
     * Cast to JS.
     * @since 1.0.0
     *
     * @return string
     */
    public function toJS()
    {
        $pieces = [];
        if (isset($this->castingProperties)) {
            // Use set in property
            $properties = is_string($this->castingProperties)
                ? $this->{$this->castingProperties}
                : $this->castingProperties;
            foreach ($properties as $property) {
                if (!isset($this->hidden)
                    || (isset($this->hidden)
                        && !in_array($property, $this->hidden)
                    )
                )
                    $pieces[] = $this->_dataToJs($property, $this->{$property});
            }
        } else {
            foreach ($this as $property => $value) {
                if (!in_array($property, ['castingProperties','hidden'])
                    && (!isset($this->hidden)
                        || (isset($this->hidden)
                            && !in_array($property, $this->hidden)
                        )
                    )
                )
                    $pieces[] = $this->_dataToJs($property, $value);
            }
        }
        return '{'.implode(',', $pieces).'}';
    }

    /**
     * Method alias for toJS()
     * @since 1.0.0
     *
     * @return string
     */
    public function to_js()
    {
        return $this->toJS();
    }

    /**
     * Returns field and values as JS string.
     * @since 1.0.0
     *
     * @param string $field Field name.
     * @param mixed  $value Field value.
     *
     * @return string
     */
    private function _dataToJs($field, $value)
    {
        return $field.':'.$this->_valueToJs($value);
    }

    /**
     * Returns value as JS string.
     * @since 1.0.0
     *
     * @param mixed $value Field value.
     *
     * @return string
     */
    private function _valueToJs($value)
    {
        if (is_numeric($value))
            return $value;
        if (is_string($value))
            return '\''.$value.'\'';
        if (is_object($value)) {
            $pieces = [];
            foreach ($value as $property => $value) {
                $pieces[] = $this->_dataToJs($property, $value);
            }
            return '{'.implode(',', $pieces).'}';
        }
        if (is_array($value)) {
            $pieces = [];
            foreach ($value as $key => $value) {
                if (is_string($key)) {
                    $pieces[] = '{'.$this->_dataToJs($key, $value).'}';
                } else {
                    $pieces[] = $this->_valueToJs($value);
                }
            }
            return '['.implode(',', $pieces).']';
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        return 'undefined';
    }
}