<?php
use PHPUnit_Framework_MockObject_Generator as Mock;

$any = new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount;
$mockResult = Mock::getMock('Zend\Db\Adapter\Driver\ResultInterface');

$mockStatement = Mock::getMock('Zend\Db\Adapter\Driver\StatementInterface');
$mockStatement->expects($any)->method('execute')->will(new PHPUnit_Framework_MockObject_Stub_Return($mockResult));

$mockConnection = Mock::getMock('Zend\Db\Adapter\Driver\ConnectionInterface');

$mockDriver = Mock::getMock('Zend\Db\Adapter\Driver\DriverInterface');
$mockDriver->expects($any)->method('createStatement')->will(new PHPUnit_Framework_MockObject_Stub_Return($mockStatement));
$mockDriver->expects($any)->method('getConnection')->will(new PHPUnit_Framework_MockObject_Stub_Return($mockConnection));

// setup mock adapter
$mockDbAdapter = Mock::getMock('Zend\Db\Adapter\Adapter', null, array($mockDriver));

\Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($mockDbAdapter);
