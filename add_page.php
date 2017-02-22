<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php selected_page($db); ?>
<?php $add_page=true; ?>
<?php include("includes/header_content.php");?>
     <table id="structure">
			<tr>
				<td id="navigation">
					<?php navigation($select_page,$db); ?>
						 	
				</td>
				<td id="pages">
					<h2>Add navigation</h2>
					<form action="create_subject.php" method="post">
					<p>Name: <input type="text" name="menu_name" value="" id="menu_name"/></p>
						<p>Position: <select name="position">
						<?php 
						$count_menu=get_navigation($db);
						$sount=$count_menu->rowCount();
						//Adding a subject
						for ($i=1; $i <=$sount+1 ; $i++) { 
						echo "<option vlaue=\"$i\">$i</option>";
						} 
						?>
						
						</select> </p>
						<p>Visible: 
						<input type="radio" name="visible" checked value="1"/>Yes
						&nbsp;
						<input type="radio" name="visible" value="0"/>No
						</p>
						 <input type="submit" value="Add navigation" />
					</form>
					<a href="content.php">Cancel</a>
					<br/>
				</td>
			</tr>
		</table>
<?php require("includes/footerr_i.php");?>  