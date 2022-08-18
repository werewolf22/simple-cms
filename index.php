<?php require_once("includes/connection.php");?>
<?php include_once 'includes/functions.inc.php';?>
<?php require_once("includes/functions.php");?>
<?php selected_page($db,true); ?>
<?php include("includes/header_i.php");?>        		
<section>
	<table id="structure">
		<tr>
			<td id="navigation">
				<?php public_navigation($select_menu,$select_page,$db); ?>
			</td>
			<td id="pages">
				<br/><?php
				if ($select_page) {
				echo "<h2>".htmlentities($select_page["name"])."</h2>";
				echo "<br/><div>".nl2br(strip_tags($select_page["detail"],"<b><strong><br><p><a><i><em>"))."</div>";
				} elseif($fulldisp==1){
					echo "<h2>".$e['title']."</h2>";  
					echo "<p>".$e['entry']."</p>"; 
					echo '<p>
				<a href="./">Back to Latest Entries</a>
				</p>';
				}else{
					echo "Welcome to ASCol...";
					if(!$e)
					{
						echo '<h2>No Entries Yet </h2><p><a href="blog.php">Post an entry!</a></p>';
					}
				}
				?>
			</td>
		</tr>
	</table>
</section>
<aside>
	<h2>&nbsp;&nbsp;  Blogs</h2>
	<article>
		<ul class="pages">
		<?php 
		if ($fulldisp==NULL) { 
		// Loop through each entry
			foreach($e as $entry) { ?>
				<a href="index.php?id=<?php echo $entry['id']; ?>">
				<?php echo "<li>&nbsp;".$entry['title']."</li>"; ?>
				</a>
			<?php }
		} ?>
	</ul>
	</article>				 		 
</aside>
<?php require("includes/footerr_i.php");?>