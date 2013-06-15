<?php
use PHPUnit_Framework_MockObject_Generator as Mock;

$any = new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount;

$mockPdoStatement = Mock::getMock('PDOStatement');

$mockResult = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Result');
$mockResult->expects($any)->method('getResource')->will(new PHPUnit_Framework_MockObject_Stub_Return($mockResult));

$mockStatement = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Statement');
$mockStatement->expects($any)->method('execute')->will(new PHPUnit_Framework_MockObject_Stub_Return($mockResult));

$mockConnection = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Connection');
$mockConnection->expects($any)->method('getConnectionParameters')->will(new PHPUnit_Framework_MockObject_Stub_Return(array('db' => array('driver' => 'pdo_pgsql'))));

$mockDriver = Mock::getMock('Zend\Db\Adapter\Driver\Pdo\Pdo', array(), array($mockConnection));
$mockDriver->expects($any)->method('createStatement')->will(new PHPUnit_Framework_MockObject_Stub_Return($mockStatement));
$mockDriver->expects($any)->method('getConnection')->will(new PHPUnit_Framework_MockObject_Stub_Return($mockConnection));

// setup mock adapter
$mockDbAdapter = Mock::getMock('Zend\Db\Adapter\Adapter', null, array($mockDriver));

\Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($mockDbAdapter);
