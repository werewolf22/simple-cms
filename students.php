<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php include("includes/header.php");?>
     <table id="structure">
			<tr>
				<td id="navigation">
					&nbsp;
				</td>
				<td id="pages">
					<h2>Edit section</h2>
					<p>Welcome, <?php echo ucfirst($_SESSION['user_name']);?>!</p>
					<ul>
						<li><a href="content.php">Edit pages</a></li>
						<li><a href="blog_list.php">Edit blogs</a></li>						
						<li><a href="new_user.php">Add Friends</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</td>
			</tr>
		</table>
<?php include("includes/footer.php");?>