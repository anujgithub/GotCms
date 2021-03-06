<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Library
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Gc;

use RuntimeException;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class RegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Registry
     *
     * @return void
     */
    protected $object;

    /**
     * @var Registry
     *
     * @return void
     */
    protected $oldinstance;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @covers Gc\Registry::__construct
     *
     * @return void
     */
    protected function setUp()
    {
        $this->oldInstance = Registry::getInstance();
        $this->object      = new Registry;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->object->unsetInstance();
        Registry::setInstance($this->oldInstance);
    }

    /**
     * Test
     *
     * @covers Gc\Registry::getInstance
     * @covers Gc\Registry::init
     * @covers Gc\Registry::unsetInstance
     *
     * @return void
     */
    public function testGetInstance()
    {
        $this->object->unsetInstance();
        $this->assertInstanceOf('Gc\Registry', Registry::getInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Registry::setInstance
     *
     * @return void
     */
    public function testSetInstance()
    {
        $this->object->unsetInstance();
        $this->object->setInstance(new Registry);
        $this->assertInstanceOf('Gc\Registry', Registry::getInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Registry::setInstance
     *
     * @return void
     */
    public function testSetInstanceWithRegistryAlreadyInitialized()
    {
        $this->setExpectedException('RuntimeException');
        $this->object->setInstance(new Registry);
    }

    /**
     * Test
     *
     * @covers Gc\Registry::get
     *
     * @return void
     */
    public function testGet()
    {
        $this->object->set('key', 'value');
        $this->assertEquals('value', $this->object->get('key'));
    }

    /**
     * Test
     *
     * @covers Gc\Registry::get
     *
     * @return void
     */
    public function testGetFakeData()
    {
        $this->setExpectedException('RuntimeException');
        $this->object->get('foo');
    }

    /**
     * Test
     *
     * @covers Gc\Registry::set
     *
     * @return void
     */
    public function testSet()
    {
        $this->object->set('key', 'value');
        $this->assertEquals('value', $this->object->get('key'));
    }

    /**
     * Test
     *
     * @covers Gc\Registry::isRegistered
     *
     * @return void
     */
    public function testIsRegisteredWithData()
    {
        $this->object->set('key', 'value');
        $this->assertTrue($this->object->isRegistered('key'));
    }

    /**
     * Test
     *
     * @covers Gc\Registry::isRegistered
     *
     * @return void
     */
    public function testIsRegisteredWithoutData()
    {
        $this->object->unsetInstance();
        $this->assertFalse($this->object->isRegistered('key'));
    }

    /**
     * Test
     *
     * @covers Gc\Registry::offsetExists
     *
     * @return void
     */
    public function testOffsetExists()
    {
        $this->object->set('key', 'value');
        $this->assertTrue($this->object->isRegistered('key'));
    }
}
