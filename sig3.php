<html>

<head>
<title>WOW</title>
</head>

<body>


<form enctype="multipart/form-data" action="sig3.php" method="post">
text here:<br> <input type="text"name="text"/>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000000" />
choose a file to upload: <input name="uploaded_file" type="file" /><br>
<input type="submit" />
</form>
<?php
ini_set('display_errors', 'On');

$file = 'posts.txt';
if(!empty($_POST["text"])){
	// The new entry to the file
	$insert = $_POST["text"];

	//check if there was an uploaded file
	$target_path = "uploads/";

	/* Add the original filename to our target path.
	Result is "uploads/filename.extension" */
	$target_path = $target_path . basename($_FILES['uploaded_file']['name']);

	if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['uploaded_file']['name']).
		" has been uploaded<br><br>";
		if(preg_match("/mp3$/", $target_path)){
			$insert .= '<br><audio controls><source src="uploads/' . basename($_FILES['uploaded_file']['name']) . '" type="audio/mpeg"></audio>';
		}else{
			echo "Posts.txt Entries<br>";
			$insert .= " <br><img src=\"uploads/" . basename($_FILES['uploaded_file']['name']) . "\"/> \n";
		}
		file_put_contents($file, $insert, FILE_APPEND | LOCK_EX);
	}
	else{
		echo "There was an error uploading the file, please try again!<br>";
	}
}
echo nl2br(file_get_contents($file));
?>
</body>
