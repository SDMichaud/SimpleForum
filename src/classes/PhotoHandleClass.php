<?php
class PhotoHandleClass
{

    private $errMessage;
    private $imageFileType;
    private $storedFileName;
    
    // Determine if the file uploaded is a valid photo
    // $file is expected to be the file array
    // Returns an array with the index 0 being true/false and index 1 being an error message
    public function isValid($file, $skipUploadChecks = false)
    {
	// Check if file has been uploaded
	if( !$skipUploadChecks )
	{
	    if( !file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name']) )
	    {
		$this->errMessage = "ERROR: No file uploaded";
		return false;
	    }
	}
	// Check if file is of supported type
	$imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	$supportedFileTypes = [
	    'jpg',
	    'jpeg',
	    'png',
	    'gif'
	];
	if( !in_array($imageFileType, $supportedFileTypes) )
	{
	    $errMessage = "ERROR: Unsupported file type. Supported file types are: ";
	    foreach($supportedFileTypes as $type)
	    {
		$errMessage = $errMessage . $type . " ";
	    }
	    $this->errMessage = $errMessage;
	    return false;
	}

	// Check file size is below limit
	$fileSizeLimit = 5000000; // 5MB
	if( $file['size'] > $fileSizeLimit )
	{
	    $this->errMessage = "ERROR: File too large. Size limit of 5MB";
	    return false;
	}
	$this->imageFileType = $imageFileType;
	return true;
    }

    public function getImageFileType()
    {
	return $this->imageFileType;
    }

    public function getErrorMessage()
    {
	return $this->errMessage;
    }
    // Store the photo under a new name and return that name
    // Note this function depends on $this->isValid() being run first!
    public function storePhoto($photo)
    {
	$targetDir = (__DIR__ . '/../../uploads/');
	$newFileName = round(microtime(true)) . '.' . $this->imageFileType;
	$this->storedFileName = $newFileName;
	return( move_uploaded_file($photo['tmp_name'], $targetDir . $newFileName) );
    }

    public function getStoredFileName()
    {
	return $this->storedFileName;
    }
}
?>
