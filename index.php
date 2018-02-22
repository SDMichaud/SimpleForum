<html>
    <head>
	<title>SimpleForum</title>
    </head>
    <body>
	<div>
	    <form method="post" action="src/post.php" enctype="multipart/form-data">
		Name: <input type="text" name="author"><br>
		Subject: <input type="text" name="subject"><br>
		Comment: <textarea name="content" rows="5" cols="40"></textarea><br>
		Photo: <input type="file" name="photo" id="photo"><br>
		<input type="submit" value="Submit" name="submit">
	    </form>
	</div>
	<div>
	    <?php
	    require_once('src/classes/PostClass.php');
	    require_once('src/classes/DBFunctionsClass.php');

	    $DBIniFilePath = (__DIR__ . '/src/');
	    $DBIniFile = ($DBIniFilePath . 'DBSettings.ini');
	    $DBWorker = new DBFunctionsClass($DBIniFile);
	    
	    if($DBWorker->openConnection())
	    {
		$OPs = $DBWorker->getAllOP();
		$DBWorker->closeConnection();
		foreach ($OPs as $OP)
		{
		    echo(PostClass::createPostDivHTML($OP));
		}
	    }
	    ?>
	</div>
    </body>
</html>
