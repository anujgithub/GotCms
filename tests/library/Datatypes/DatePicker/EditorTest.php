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
 * @package  Datatypes
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Datatypes\DatePicker;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:42:12.
 *
 * @group Datatypes
 * @category Gc_Tests
 * @package  Datatypes
 */
class EditorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Editor
     *
     * @return void
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $property = $this->getMock('Gc\Property\Model', array('getName', 'getId', 'getValue'));
        $property->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('name'));
        $property->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));
        $property->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('1'));

        $datatype = $this->getMock('Datatypes\DatePicker\Datatype', array('getName', 'getProperty', 'getHelper'));
        $datatype->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('name'));
        $datatype->expects($this->any())
            ->method('getProperty')
            ->will($this->returnValue($property));

        $helperManager = $this->getMock('Zend\View\HelperManager', array('appendFile'));
        $helperManager->expects($this->any())
            ->method('appendFile')
            ->will($this->returnValue('string'));

        $datatype->expects($this->any())
            ->method('getHelper')
            ->will($this->returnValue($helperManager));

        $this->object = new Editor($datatype);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * Test
     *
     * @covers Datatypes\DatePicker\Editor::save
     *
     * @return void
     */
    public function testSave()
    {
        $this->object->getRequest()->getPost()->set('name1', '1');
        $this->object->save();
        $this->assertEquals('1', $this->object->getValue());
    }

    /**
     * Test
     *
     * @covers Datatypes\DatePicker\Editor::load
     *
     * @return void
     */
    public function testLoad()
    {
        $this->assertInternalType('array', $this->object->load());
    }
}
