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
	    function createPostDiv($post_data){
		echo("<div style='border: 2px solid black; margin: 10px 0px;'>" .
		     "<img src=/uploads/" . $post_data['photo'] . " width='128px'>" .
		     "#" . $post_data['id'] . "<br>" .
		     $post_data['author'] . " " . $post_data['subject'] . " Posted: " . $post_data['updated'] . "<br>" .
		     $post_data['content'] . "<br>" .
		     "<a href='/reply/" . $post_data['id'] . "'>Reply</a>" .
		     "</div>");
	    }
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
		    createPostDiv($row);
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
