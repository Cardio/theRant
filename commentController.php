<?php

include ('db_connect.php');

$name = $_POST['name'];
$month = $_POST['month'];
$day = $_POST['day'];
$yr = $_POST['year'];
$date = $yr . '-' . $month . '-' . $day;
$postId= $_POST['postId'];
$post = mysqli_real_escape_string($db, trim($_POST['post']));

$query="INSERT INTO comment (post, author, date_posted) VALUES ( '$post', '$name', '$date')";
$result = mysqli_query($db, $query) or die("Error Querying Database");
$query="SELECT * FROM comment WHERE post='$post' AND author='$name'";
$result = mysqli_query($db, $query) or die("Error Querying Database");
$row = mysqli_fetch_array($result);
$commentId=$row['id'];
$query="INSERT INTO postTOcomment (postid, commentid) VALUES ('$postId', '$commentId')";
$result = mysqli_query($db, $query) or die("Error Querying Database");
 
   
mysqli_close($db);
header('Location: blog.php');   
exit;   


?>