 <?php require_once("includes/connection.php");?>
  <?php include_once 'includes/functions.inc.php';?>
 <?php require_once("includes/functions.php");?>
 <?php selected_page($db,true); ?>
 <!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type"
content="text/html;charset=utf-8" />
<title> Simple Blog </title>
<link href="stylesheets/blog.css" rel="stylesheet"/>
<link href="stylesheets/main.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
<section>
          <center>
               <a href="students.php">Return to menu</a>
               <h2><strong>The available blogs are given below:</strong></h2>
			             <ul class="pages">
                <?php                   // Loop through each entry
                        foreach($e as $entry) { ?>
                        <a href="blog.php?id=<?php echo $entry['id']; ?>">
                        <?php echo "<li>&nbsp;".$entry['title']."</li>";} ?>
                        </a>
</center>
                       <p class="backlink">
                       <a href="blog.php">&nbsp;Post a New Entry</a>
                       </p>
                       </ul>
</section>
</div>
</body>
</html>