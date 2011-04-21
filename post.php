<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>theRant!</title>
    <meta name="description" content="" />
    <link href="css/960.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>   
<body>
<div id="wrapper" class="container_12">

    <header id="header" class="grid_12">
		<h1><a href="blog.php">theRant!</a></h1>
    </header> <!-- end header -->
    
    <div id="content">
    <!--
        <nav>
            <ul id="menu" class="clearfix"> 
                <li><a href="index.html">Home</a></li> 
                <li class="current"><a href="blog.php">Blog</a></li>
			</ul>
		<br class="clear" />
        </nav>-->
    
    <div id="main" class="grid_8 alpha">
    <article class="post">		

<!-- CONTENT -->

<?php
$title = $_GET['name'];
$m = new Mongo();
$mongo = $m->rant;
$collection = $mongo->posts;
echo $id;
$cursor = $collection->find(array( "title" => "$title" ));

foreach ($cursor as $obj) {

    $id = $obj['_id'];
    $title = $obj['title'];
    $post = $obj['post'];
    $author = $obj['name'];
    $date = $obj['date'];
    $pic = $obj['pic'];

    if($pic == ""){
    	$pic = "<img src='images/rant.jpg' alt='' class='thumbnail alignleft' width='200px' height='200px'/>";
    }
    else {
    $pic = "<img src='" . $obj['pic'] . "' alt='' class='thumbnail alignleft' width='200px' height='200px'/>";
    }
    $comments = $obj['comments'];
    echo "<h3><a name=\"" . $id . "\" href=\"post.php?name=" . $title . "\">" . $title . "</a></h3>";
    echo $pic;
    echo "<table>";
	echo "<tr><td width=\"35%\">Name:"  . $author  . "</td><td></td><tr>";
	echo "<tr><td width=\"65%\">Date: " . $date . "</td><td></td></tr>";
	echo "<tr><td>Post:</td></tr><tr><td>";
	echo wordwrap($post . "</td></tr>",50,"<br />\n",TRUE);
	echo "</table>";
	echo"<br /><br /><hr/>";
	$collectionComments = $mongo->comments;
	$query = array( "postId" => "$id" );
	$cursorComments = $collectionComments->find($query);
	foreach ($cursorComments as $obj){
		$post = $obj['post'];
		$author = $obj['name'];
		$date = $obj['date'];
		echo"<table>";
   	 	echo "<tr><td width=\"35%\">Name: "  . $author  . "</td></tr>";
		echo "<td width=\"65%\">Date: " . $date . "</td></tr>";
		echo "<tr><td>Post: ";
		echo wordwrap($post . "</td></tr>",50,"<br />\n",TRUE);
		echo "</table>";
		echo"<hr/>";
	}
	echo "<a href='post.php?name=" . $title . "&comment=" . $id . "' class='more-link alignright'>Comment</a>";
	echo "<br />";
	$comment=$_GET['comment'];
	if($comment == $id){
?>
	<form method="post" action="commentController.php">
	<table>
		<tr><td>Date:</td><td><input type="number" name="month" min="1" max="12" step="1" value="<?php echo date("m", time()); ?>" size="3"/>
			<input type="number" name="day" min="1" max="31" step="1" value="<?php echo date("d", time()); ?>" size="3"/>
			<input type="number" name="year" min="1900" max="2014" step="1" value="<?php echo date("Y", time()); ?>" size="4"/></td></tr>	
		<tr><td>Name:</td><td><input type="text" name="name" size="50" value="Insert Your Name Here."/></td></tr>			
		<tr><td>Post:</td><td><input type="text" name="post" size="50" value="Insert Your Post Here."/></td></tr>
		<tr><td><input type="hidden" name=postId value="<?php echo $id ?>"><input type="submit" value="Submit" /> </td></tr>
	</table>
	</form>
	<hr/>
<?php
	} 
}//end forEach
?>
	
	<div class="clear"></div>  
            <footer class="postmeta">
				
            </footer> <!-- end post meta -->
        </article> <!-- end post -->
	

	
<h3>Make a New Blog Entry!</h3>
					
	<form enctype="multipart/form-data" method="post" action="blogController.php">
	<table>
		<tr><td>Date:</td><td><input type="number" name="month" min="1" max="12" step="1" value="<?php echo date("m", time()); ?>" size="3"/>
					<input type="number" name="day" min="1" max="31" step="1" value="<?php echo date("d", time()); ?>" size="3"/>
					<input type="number" name="year" min="1900" max="2014" step="1" value="<?php echo date("Y", time()); ?>" size="4"/></td></tr>	
		<tr><td>Name:</td><td><input type="text" name="name" size="50" value="Insert Your Name Here."/></td></tr>			
		<tr><td>Title:</td><td><input type="text" name="title" size="50" value="Insert Title Here."/></td></tr>
		<tr><td>Enter Picture URL: </td><td><input type="text" name="pic" size="50" value=""/></td></tr>
		<tr><td>Post:</td><td><input type="text" name="post" size="50" value="Insert Your Post Here."/></td></tr>
		<td><input type="submit" value="Submit" /> </td></tr>
	</table>
	</form>
					
					
					<!-- END CONTENT -->
					
					
</div> <!-- end main -->
    
<div id="sidebar" class="grid_4 omega">
		<aside class="widget">
		<img src="images/rant.gif" height="200" width="200" />
		</aside>
		
        <aside class="widget">
            <h3>Rant Topics</h3>
            
			<?php
			$cursor = $collection->find();

			foreach ($cursor as $obj) {
				echo "<li><a href='blog.php#" . $obj['_id'] . "'>" . $obj['title'] . "</a></li>";
            }
			?>
            </ul>
        </aside> <!-- end widget -->
         <!-- 
        <aside class="widget">
           Non working search 
            <form action="">
                <input type="search" results="10" placeholder="Search..." />
                <input type="submit" value="Search..." />
            </form>
        </aside> end widget 
		-->
    
    </div> <!-- end sidebar -->
    
    </div> <!-- end content -->
    
    <footer id="footer" class="grid_12">
        <p>This site is the product of PURE AWESOMENESS!</p>
    </footer>
    <div class="clear"></div>

</div> <!-- end wrapper -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
				
</body>
</html>