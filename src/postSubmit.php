<!DOCTYPE html>
<html>
    <head>
	<title>SimpleForum - Upload</title>
    </head>
    <body>
	     <script type="text/javascript">
	     window.setTimeout(function(){
	     window.location.href = "/";
	     }, 3000);
	     </script>
	<?php
	require_once('./classes/PhotoHandleClass.php');
	require_once('./classes/DBFunctionsClass.php');

	// Validate file as an acceptable photo, store it on the server, and return the filename
	// File name returned as null if error is generated
	function handle_photo()
	{
	    if( isset($_FILES['photo']) )
	    {
		$photoHandler = new PhotoHandleClass();
		if( $photoHandler->isValid($_FILES['photo']) )
		{
		    if( $photoHandler->storePhoto($_FILES['photo']) )
		    {
			return $photoHandler->getStoredFileName();
		    }
		    else
		    {
			echo( $photoHandler->getErrorMessage() );
			return null;
		    }
		}
		else
		{
		    echo( $photoHandler->getErrorMessage() );
		    return null;
		}
	    }
	    else
	    {
		echo("ERROR: No file uploaded");
		return null;
	    }
	}

	if( !empty($_POST['content']) )
	{
	    $photo = handle_photo();
	    if( !is_null($photo) )
	    {
		echo("File {$_FILES['photo']['name']} successfully uploaded!");
		// Do the database insertion
                if(empty($_POST['author'])){
		    $author = 'Anonymous';
		}else{
		    $author = $_POST['author'];
		}
		if(empty($_POST['subject'])){
		    $subject = null;
		}else{
		    $subject = $_POST['subject'];
		}
		$content = $_POST['content'];
		
		$DBWorker = new DBFunctionsClass();
		if( $DBWorker->openConnection() )
		{
		    $DBWorker->insertOP($author, $subject, $content, $photo);
		    $DBWorker->closeConnection();
		}
		else
		{
		    echo("<br><br>Post not successful - MySQL Connection Error");
		}
	    }
	}
	else
	{
	    echo("ERROR: A comment is required");
	}
	?>
	<div>
	   You should be redirected automatically. If not <a href="/">click here</a>
	</div>
    </body>
</html>
