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

namespace Datatypes\jQueryFileUpload;

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
        $property = $this->getMock(
            'Gc\Property\Model',
            array(
                'getName',
                'getId',
                'getValue',
                'getConfig',
            )
        );
        $property->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('name'));
        $property->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));
        $property->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(
                serialize(
                    array(
                        array(
                            'value' => __DIR__ . '/_files/test.jpg',
                        )
                    )
                )
            ));

        $datatype = $this->getMock(
            'Datatypes\jQueryFileUpload\Datatype',
            array(
                'getName',
                'getProperty',
                'getConfig',
                'getDocument',
                'getUploadUrl',
            )
        );
        $datatype->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('name'));
        $datatype->expects($this->any())
            ->method('getProperty')
            ->will($this->returnValue($property));
        $datatype->expects($this->any())
            ->method('getUploadUrl')
            ->will($this->returnValue(''));
        $datatype->expects($this->any())
            ->method('getConfig')
            ->will($this->returnValue(
                array(
                    'is_multiple' => true,
                    'mime_list' => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                    )
                )
            ));

        $document = $this->getMock('Gc\Document\Model', array('getId'));
        $document->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));
        $datatype->expects($this->any())
            ->method('getDocument')
            ->will($this->returnValue($document));


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
        $_FILES = array();
        $_POST  = array();
        unset($this->object);
    }

    /**
     * Test
     *
     * @covers Datatypes\jQueryFileUpload\Editor::save
     *
     * @return void
     */
    public function testSave()
    {
        copy(__DIR__ . '/_files/test-source.bmp', __DIR__ . '/_files/test.bmp');
        $this->object->getRequest()->getPost()->set(
            $this->object->getName(),
            array(
                array(
                    'name' => '',
                ),
                array(
                    'name' => '../tests/library/Datatypes/jQueryFileUpload/_files/test.jpg',
                ),
                array(
                    'name' => '../tests/library/Datatypes/jQueryFileUpload/_files/test.bmp',
                ),
            )
        );

        $this->object->save();
        $result = $this->object->getValue();

        $this->assertInternalType('string', $this->object->getValue());
    }

    /**
     * Test
     *
     * @covers Datatypes\jQueryFileUpload\Editor::load
     * @covers Datatypes\jQueryFileUpload\Editor::initScript
     *
     * @return void
     */
    public function testLoad()
    {
        $this->object->setValue(
            serialize(
                array(
                    array(
                        'value' => __DIR__ . '/_files/test.jpg',
                    )
                )
            )
        );
        $this->assertInternalType('string', $this->object->load());
    }
}
