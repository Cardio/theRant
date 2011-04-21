<?php
$m = new Mongo();
$mongo = $m->rant;
$collection = $mongo->comments;

$name = $_POST['name'];
$month = $_POST['month'];
$day = $_POST['day'];
$yr = $_POST['year'];
$date = $yr . '-' . $month . '-' . $day;
$postId= $_POST['postId'];
$post = $_POST['post'];

$collection->insert(array("name" => $name, "postId" => $postId, "date" => $date, "post" => $post ));

header('Location: blog.php');    
?>