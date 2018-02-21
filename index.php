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
	    
	    $servername = "localhost";
	    $username = "phpuser";
	    $password = "phpuserpass";
	    $dbname = "sfdb";
	    $tablename = "posts";

	    try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM $tablename WHERE is_op=1 ORDER BY updated DESC");
		$stmt->execute();

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row) {
		   echo(PostClass::createPostDivHTML($row));
		}
	    }
	    catch(PDOException $e)
	    {
		echo "Connection failed: " . $e->getMessage();
	    }
	    ?>
	</div>
    </body>
</html>
