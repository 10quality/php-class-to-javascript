<?php

/**
 * Unit test.
 *
 * @author Alejandro Mostajo <info@10quality.com>
 * @copyright 10 Quality <http://www.10quality.com>
 * @license MIT
 * @package TenQuality\Traits (php-class-to-javascript)
 * @version 1.0.0
 */
class TraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * Casts class with public properties.
     */
    public function testPropertyClass()
    {
        // Prepare
        $class = new TestA;
        $class->id = 5;
        $class->name = 'test_a';
        // Assert
        $this->assertEquals(
            '{id:5,name:\'test_a\',data:undefined}',
            $class->toJS()
        );
    }
    /**
     * Test array value casting.
     */
    public function testArrayCast()
    {
        // Prepare
        $class = new TestA;
        $class->id = 1;
        $class->name = 'a';
        $class->data = [1,'test',3];
        // Assert
        $this->assertEquals(
            '{id:1,name:\'a\',data:[1,\'test\',3]}',
            $class->toJS()
        );
    }
    /**
     * Test object value casting.
     */
    public function testObjectCast()
    {
        // Prepare
        $object = new stdClass;
        $object->title = 't1';
        $object->flag = true;
        $class = new TestA;
        $class->id = 1;
        $class->name = 'a';
        $class->data = $object;
        // Assert
        $this->assertEquals(
            '{id:1,name:\'a\',data:{title:\'t1\',flag:true}}',
            $class->toJS()
        );
    }
    /**
     * Test hierarchy value casting.
     */
    public function testHierarchyCast()
    {
        // Prepare
        $object = new stdClass;
        $object->title = 't1';
        $object->flag = true;
        $class = new TestA;
        $class->id = 1;
        $class->name = 'a';
        $class->data = [
            577,
            'success' => false,
            $object
        ];
        // Assert
        $this->assertEquals(
            '{id:1,name:\'a\',data:[577,{success:false},{title:\'t1\',flag:true}]}',
            $class->toJS()
        );
    }
    /**
     * Test hidden and protected properties.
     */
    public function testHidden()
    {
        // Prepare
        $class = new TestB;
        $class->id = 1;
        $class->name = 'a';
        $class->data = true;
        // Assert
        $this->assertEquals(
            '{data:true}',
            $class->toJS()
        );
    }
    /**
     * Test hidden and protected properties.
     */
    public function testAlias()
    {
        // Prepare
        $class = new TestB;
        $class->data = true;
        // Assert
        $this->assertEquals(
            '{data:true}',
            $class->to_js()
        );
    }
    /**
     * Test casting using casting properties on single property target.
     */
    public function testCastingPropertiesSingle()
    {
        // Prepare
        $class = new TestC;
        $class->id = 44;
        $class->name = 'john';
        $class->flag = true;
        // Assert
        $this->assertEquals(
            '{id:44}',
            $class->toJS()
        );
    }
    /**
     * Test casting using casting properties on multiple property target.
     */
    public function testCastingPropertiesMultiple()
    {
        // Prepare
        $class = new TestD;
        $class->id = 44;
        $class->name = 'john';
        $class->flag = true;
        // Assert
        $this->assertEquals(
            '{id:44,flag:true}',
            $class->toJS()
        );
    }
}