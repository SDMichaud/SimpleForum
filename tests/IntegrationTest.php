<?php
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../src/classes/PostClass.php');
require_once(__DIR__ . '/../src/classes/DBFunctionsClass.php');
require_once(__DIR__ . '/../src/classes/PhotoHandleClass.php');

class IntegrationTest extends TestCase
{

    public function testDBIniFileExistsAndIsReadable()
    {
	$DBIniFilePath = (__DIR__ . "/../src/");
	$DBIniFile = ($DBIniFilePath . "DBSettings.ini");
	$this->assertFileExists($DBIniFile);
	$this->assertFileIsReadable($DBIniFile);
    }
    /**
    * @depends testDBIniFileExistsAndIsReadable
    */
    public function testCanCreateDBFunctionClassInstance()
    {
	$DBWorker = new DBFunctionsClass();
	$this->assertInstanceOf(DBFunctionsClass::class, $DBWorker);
	return $DBWorker;
    }
    /**
    * @depends testCanCreateDBFunctionClassInstance
    */
    public function testCanConnectToDatabase($DBWorker)
    {
	$this->assertTrue($DBWorker->openConnection());
	return $DBWorker;
    }

    /**
     * @depends testCanConnectToDatabase
     */
    public function testCanGetOPs($DBWorker)
    {
	$this->assertNotEmpty($DBWorker->getAllOP());
    }
    /**
    * @depends testCanConnectToDatabase
     */
    public function testGetOPsAsArray($DBWorker)
    {
	$this->assertInternalType('array', $DBWorker->getAllOP());
    }
    /**
    * @depends testCanConnectToDatabase
    * @depends testCanGetOPs
     */
    public function testCanInsertOP($DBWorker)
    {
	$originalOPCount = count($DBWorker->getAllOP());
	$DBWorker->insertOP("Anonymous", null, "Test post created by PHPUnit", "test.png");
	$newOPCount = count($DBWorker->getAllOP());
	$this->assertTrue($newOPCount > $originalOPCount);
    }

    public function testUploadFolderExists()
    {
	$this->assertDirectoryExists(__DIR__ . '/../uploads');
    }
    /**
    * @ depends testUploadFolderExists
     */
    public function testUploadFolderIsReadWrite()
    {
	$this->assertDirectoryIsReadable(__DIR__ . '/../uploads');
	$this->assertDirectoryIsWritable(__DIR__ . '/../uploads');
    }

    public function testPhotoHandleClass_ErrOnUnsupportedType()
    {
	$PhotoHandler = new PhotoHandleClass();
	$this->assertFalse($PhotoHandler->isValid( array('name' => 'unsupported.exe'), true ));
	$this->assertNotEmpty($PhotoHandler->getErrorMessage(), 'No error message set');
    }

    public function testPhotoHandleClass_ErrOnFileTooLarge()
    {
	$PhotoHandler = new PhotoHandleClass();
	$testSizeLimit = 5000001;
	$this->assertFalse($PhotoHandler->isValid( array('name' => 'supported.jpg', 'size' => $testSizeLimit), true ), 'Test file size: ' . $testSizeLimit);
	$this->assertNotEmpty($PhotoHandler->getErrorMessage(), 'No error message set');
    }

    public function testPhotoHandleClass_imageFileTypeSetByCallingIsValid()
    {
	$PhotoHandler = new PhotoHandleClass();
	$PhotoHandler->isValid( array('name' => 'supported.jpg', 'size' => 1), true);
	$this->assertNotEmpty($PhotoHandler->getImageFileType());
	return $PhotoHandler;
    }

    /**
    * @depends testPhotoHandleClass_imageFileTypeSetByCallingIsValid
    */
    public function testPhotoHandleClass_StorePhotoSetsFileName($PhotoHandler)
    {
	$PhotoHandler->storePhoto( array('tmp_name' => 'notARealFile'));
	$this->assertNotEmpty($PhotoHandler->getStoredFileName());
    }
}
?>
