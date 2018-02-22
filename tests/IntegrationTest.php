<?php
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../src/classes/PostClass.php');
require_once(__DIR__ . '/../src/classes/DBFunctionsClass.php');

class IntegrationTest extends TestCase
{
    public function testInsertIntegrationTestsHere()
    {
	$this->assertTrue(true);
    }

    public function testDBIniFileExistsAndIsReadable()
    {
	$DBIniFilePath = (__DIR__ . "/../src/");
	$DBIniFile = ($DBIniFilePath . "DBSettings.ini");
	$this->assertFileExists($DBIniFile);
	$this->assertFileIsReadable($DBIniFile);
	return $DBIniFile;
    }
    /**
    * @depends testDBIniFileExistsAndIsReadable
    */
    public function testCanCreateDBFunctionClassInstance($DBIniFile)
    {
	$DBWorker = new DBFunctionsClass($DBIniFile);
	$this->assertInstanceOf(DBFunctionsClass::class, $DBWorker);
	return $DBWorker;
    }
    /**
    * @depends testCanCreateDBFunctionClassInstance
    */
    public function testCanConnectToDatabase($DBWorker)
    {
	$this->assertTrue($DBWorker->openConnection());
    }
}
?>
