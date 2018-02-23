<html>
    <head>
	<title>SimpleForum</title>
    </head>
    <body>
	<div>
	    <form method="post" action="src/postSubmit.php" enctype="multipart/form-data">
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

	    $DBWorker = new DBFunctionsClass();
	    
	    if($DBWorker->openConnection())
	    {
		$OPs = $DBWorker->getAllOP();
		$DBWorker->closeConnection();
		foreach ($OPs as $OP)
		{
		    echo(PostClass::createPostDivHTML($OP));
		}
	    }
	    else
	    {
		echo("<br><br>MySQL Connection Error");
	    }
	    ?>
	</div>
    </body>
</html>
