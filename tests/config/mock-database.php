<?php
require_once('config/Mock/PDOMock.php');

use \Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use PHPUnit_Framework_MockObject_Generator as Mock;
use PHPUnit_Framework_MockObject_Stub_Return as StubReturn;

$any = new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount;

$mockPdoStatement = Mock::getMock('PDOStatement');
$mockPdo          = Mock::getMock('PDOMock');
$mockPdo->expects($any)->method('prepare')->will(new StubReturn($mockPdoStatement));

$mockResult = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Result', array('current'));
$mockResult->expects($any)->method('getResource')->will(new StubReturn($mockResult));
$mockResult->expects($any)->method('current')->will(new StubReturn('value'));

$mockStatement = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Statement');
$mockStatement->expects($any)->method('execute')->will(new StubReturn($mockResult));
$mockStatement->setResource($mockPdoStatement);

$mockConnection = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Connection', array('getConnectionParameters', 'connect'), array('db' => array('driver' => 'pdo_pgsql')));
$mockConnection->expects($any)->method('connect')->will(new StubReturn($mockConnection));
$mockConnection->setResource($mockPdo);

$mockDriver = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Pdo', null, array($mockConnection));
$mockDriver->expects($any)->method('createStatement')->will(new StubReturn($mockStatement));
$mockDriver->expects($any)->method('prepareStatement')->will(new StubReturn($mockStatement));
$mockDriver->expects($any)->method('getConnection')->will(new StubReturn($mockConnection));

// setup mock adapter
$methods = array('beginTransaction', 'commit', 'rollback', 'exec');
$mockDbAdapter = Mock::getMock('Zend\Db\Adapter\Adapter', $methods, array($mockDriver));
$mockDbAdapter->expects($any)->method('beginTransaction')->will(new StubReturn($mockDbAdapter));
$mockDbAdapter->expects($any)->method('commit')->will(new StubReturn($mockDbAdapter));
$mockDbAdapter->expects($any)->method('rollback')->will(new StubReturn($mockDbAdapter));
$mockDbAdapter->expects($any)->method('exec')->will(new StubReturn($mockDbAdapter));

GlobalAdapterFeature::setStaticAdapter($mockDbAdapter);
