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
include ('db_connect.php');
$query = "SELECT * FROM posts";  
$result = mysqli_query($db, $query)or die("Error Querying Database1");
while($row = mysqli_fetch_array($result)){

echo "<h3><a href=\"#\">" . $row['title'] . "</a></h3><img src=\"images/thumbnail.jpg\" alt=\"\" class=\"thumbnail alignleft\" />";

/*
if  (isset($row['pic'])){ ?>
		<img src='<?php echo $row['pic'] ?>' alt=\"\" class=\"thumbnail alignleft\" />";
	<?php
	}
	else{ ?>
		<img src=\"images/thumbnail.jpg\" alt=\"\" class=\"thumbnail alignleft\" />";
	<?php }
*/
	
echo "<table>";
echo "<tr><td width=\"35%\">Name:"  . $row['author']  . "</td><td></td><tr>";
echo "<tr><td width=\"65%\">Date: " . $row['date_posted'] . "</td><td></td></tr>";
echo "<tr><td>Post:</td></tr><tr><td>";
echo wordwrap($row['post'] . "</td></tr>",50,"<br />\n",TRUE);
echo "</table>";
 
$postid=$row['id'];
 
$query = "SELECT * FROM postTocomment WHERE postId='$postid'";  
$result1 = mysqli_query($db, $query)or die("Error Querying Database1");
echo"<br/><hr/>";

while($row2 = mysqli_fetch_array($result1)){
$query1 = "SELECT * FROM comment WHERE id='$row2[commentId]'";  
$result2 = mysqli_query($db, $query1)or die("Error Querying Database2");
while($row1 = mysqli_fetch_array($result2)){

	
	echo"<table>";
    echo "<tr><td width=\"35%\">Name: "  . $row1['author']  . "</td></tr>";
	echo "<td width=\"65%\">Date:" . $row1['date_posted'] . "</td></tr>";
	echo "<tr><td>Post:";
	echo wordwrap($row1['post'] . "</td></tr>",50,"<br />\n",TRUE);
	echo "</table>";
	echo"<hr/>";
    }
	}
	?>
	<div class="clear"></div>  
            <footer class="postmeta">
                <a href="blog.php?comment=y" class="more-link alignright">Comment</a>
				<?php 
				$comment=$_GET['comment'];
				if($comment=='y'){
				?>
				<form method="post" action="commentController.php">
				<table>
				<tr><td>Date:</td><td><input type="number" name="month" min="1" max="12" step="1" value="<?php echo date("m", time()); ?>" size="3"/>
				<input type="number" name="day" min="1" max="31" step="1" value="<?php echo date("d", time()); ?>" size="3"/>
				<input type="number" name="year" min="1900" max="2014" step="1" value="<?php echo date("Y", time()); ?>" size="4"/></td></tr>	
				<tr><td>Name:</td><td><input type="text" name="name" size="50" value="Insert Your Name Here."/></td></tr>			
				<tr><td>Post:</td><td><input type="text" name="post" size="50" value="Insert Your Post Here."/></td></tr>
				<td><input type="hidden" name=postId value="<?php echo $postid ?>"><input type="submit" value="Submit" /> </td></tr>
				</table>
				</form>
				<hr/>
				<?php } ?>
            </footer> <!-- end post meta -->
        </article> <!-- end post -->
	
<?php
}
?>
	
					<h3>Make a New Blog Entry!</h3>
					
					<form enctype="multipart/form-data" method="post" action="blogController.php">
					<table>
					<tr><td>Date:</td><td><input type="number" name="month" min="1" max="12" step="1" value="<?php echo date("m", time()); ?>" size="3"/>
					<input type="number" name="day" min="1" max="31" step="1" value="<?php echo date("d", time()); ?>" size="3"/>
					<input type="number" name="year" min="1900" max="2014" step="1" value="<?php echo date("Y", time()); ?>" size="4"/></td></tr>	
					<tr><td>Name:</td><td><input type="text" name="name" size="50" value="Insert Your Name Here."/></td></tr>			
					<tr><td>Title:</td><td><input type="text" name="title" size="50" value="Insert Title Here."/></td></tr>
					<tr><td>Select a picture to upload: </td><td><input name="image" type="file"/></td></tr>
					<tr><td>Post:</td><td><input type="text" name="post" size="50" value="Insert Your Post Here."/></td></tr>
					<td><input type="submit" value="Submit" /> </td></tr>
					</table>
					</form>
					<!-- END CONTENT -->
					
					
</div> <!-- end main -->
    
<div id="sidebar" class="grid_4 omega">
		<aside class="widget">
		<img src="images/rant.jpg" height="200" width="200" />
		</aside>
		
        <aside class="widget">
            <h3>Rant Topics</h3>
            
			<?php
			$query = "SELECT * FROM posts";  
			$result = mysqli_query($db, $query)or die("Error Querying Database1");
			while($row = mysqli_fetch_array($result)){
				echo "<li><a href=\"#\">" . $row['title'] . "</a></li>";
            }
			mysqli_close($db);
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