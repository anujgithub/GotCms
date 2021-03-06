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

namespace Gc\Media;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class InfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Info
     *
     * @return void
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @covers Gc\Media\Info::init
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Info;
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
     * @covers Gc\Media\Info::fromFile
     *
     * @return void
     */
    public function testFromFile()
    {
        $filePath = __DIR__ . '/_files/information.info';
        $this->assertTrue($this->object->fromFile($filePath));
        $this->assertTrue($this->object->fromFile($filePath));
    }

    /**
     * Test
     *
     * @covers Gc\Media\Info::fromFile
     *
     * @return void
     */
    public function testFromFileWithWrongFilePath()
    {
        $this->assertFalse($this->object->fromFile('wrong-path-file.info'));
    }

    /**
     * Test
     *
     * @covers Gc\Media\Info::render
     *
     * @return void
     */
    public function testRender()
    {
        $filePath = __DIR__ . '/_files/information.info';
        $this->object->fromFile($filePath);
        $assertString = '<dl><dt>Author</dt><dd>Pierre Rambaud</dd><dt>Date</dt>' .
            '<dd>2012</dd><dt>Version</dt><dd>0.1</dd><dt>Description</dt>' .
            '<dd>Information test</dd><dt>Database compatibility</dt><dd>pgsql</dd>' .
            '<dt>Website url</dt><dd><a href="http://pierrerambaud.com">website</a></dd></dl>';
        $this->assertEquals($assertString, $this->object->render());
    }

    /**
     * Test
     *
     * @covers Gc\Media\Info::render
     *
     * @return void
     */
    public function testRenderWithWrongFilePath()
    {
        $this->object->fromFile('wrong-path-file.info');
        $this->assertFalse($this->object->render());
    }
}
