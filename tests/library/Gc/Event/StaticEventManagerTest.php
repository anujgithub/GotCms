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

namespace Gc\Event;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class StaticEventManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StaticEventManager
     *
     * @return void
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @covers Gc\Event\StaticEventManager::setInstance
     * @covers Gc\Event\StaticEventManager::__construct
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = StaticEventManager::getInstance();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->object->resetInstance();
        unset($this->object);
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::getInstance
     *
     * @return void
     */
    public function testGetInstance()
    {
        $this->tearDown();
        $this->setUp();
        $this->assertInstanceOf('Gc\Event\StaticEventManager', StaticEventManager::getInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::setInstance
     *
     * @return void
     */
    public function testSetInstance()
    {
        StaticEventManager::setInstance($this->object);
        $this->assertInstanceOf('Gc\Event\StaticEventManager', StaticEventManager::getInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::hasInstance
     *
     * @return void
     */
    public function testHasInstance()
    {
        $this->assertTrue(StaticEventManager::hasInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::resetInstance
     *
     * @return void
     */
    public function testResetInstance()
    {
        $this->object->resetInstance();
        $this->assertFalse($this->object->hasInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::getEvent
     *
     * @return void
     */
    public function testGetEventWithoutRegisteredEvent()
    {
        $this->assertFalse($this->object->getEvent('null'));
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::getEvent
     *
     * @return void
     */
    public function testGetEvent()
    {
        $this->object->attach(
            'Event',
            'do',
            function ($e) {
                //Fake declare to create Event
            }
        );


        $this->assertInstanceOf('Zend\EventManager\EventManager', $this->object->getEvent('Event'));
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::trigger
     *
     * @return void
     */
    public function testTrigger()
    {
        $this->object->attach(
            'Event',
            'do',
            function ($e) {
                return $e->getName();
            }
        );

        $this->assertInstanceOf('Zend\EventManager\ResponseCollection', $this->object->trigger('Event', 'do'));
    }

    /**
     * Test
     *
     * @covers Gc\Event\StaticEventManager::trigger
     *
     * @return void
     */
    public function testTriggerWithoutRegisteredEvent()
    {
        $this->assertFalse($this->object->trigger('Event', 'do'));
    }
}
