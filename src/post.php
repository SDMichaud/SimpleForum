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
	function handle_photo(){
	    $target_dir = "../uploads/";
	    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
	    $uploadOK = 1;
	    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	    if( !is_uploaded_file($_FILES["photo"]["tmp_name"])){
		die("No file selected.");
	    }
	    if(file_exists($target_file)){
		die("Duplicate file.");
	    }
	    if($_FILES["photo"]["size"] > 3000000){
		die("File over 3MB.");
	    }
	    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif"){
		die("Only JPG, JPEG, PNG, and GIF files supported.");
	    }
	    $newfilename = round(microtime(true)) . '.' . $imageFileType;
	    if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $newfilename)){
		echo("The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.");
	    }else{
		die("Error actually uploading file.");
	    }
	    return $newfilename;
	}
	if(empty($_POST["content"])){
	    die("ERROR: A comment is required!");
	}
	$photo = handle_photo();
	
	$servername = "localhost";
	$username = "phpuser";
	$password = "phpuserpass";
	$dbname = "sfdb";
	$tablename = "posts";
	
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

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $stmt = $conn->prepare("INSERT INTO posts (author, subject, content, photo, is_op) VALUES (:author, :subject, :content, :photo, :is_op)");
	    $stmt->execute( array(':author'=>$author,':subject'=>$subject, ':content'=>$content, ':photo'=>$photo, ':is_op'=>1 ) );
	} catch(PDOException $e){
	    echo("Connection failed: " . $e->getMessage());
	}
	
	$conn = null;	
	?>
    </body>
</html>
