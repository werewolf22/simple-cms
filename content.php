<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php selected_page($db); ?>
<?php include("includes/header_content.php");?>
     <table id="structure">
			<tr>
				<td id="navigation">
					<?php navigation($select_page,$db); ?>
					<ul class="pages">
					<li><a href="students.php">Return to menu</a></li>
					</ul>
				</td>
				<td id="pages">
				    <?php if (!is_null($select_page)) { ?>
					     	<h2><?php echo $select_page["name"]; ?></h2>
					     	<div>
					     		<?php echo "{$select_page['detail']}<br/><a href=\"edit_menu_page.php?editpage=".urlencode($select_page['id'])."\">Edit page</a>"; ?>

					     	</div>
					     <h2><?php }else{
					     	echo "Select a navigation or page to edit.";
					     	
					     	} ?>
					</h2>
					<br/>
				</td>
			</tr>
		</table>
<?php require("includes/footerr_i.php");?>  