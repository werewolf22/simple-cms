<?php require_once("includes/functions.php");?>
<html>
 <head>
     <title>css layout</title>
     <link href="stylesheets/main.css" rel="stylesheet"/>
 </head>
     <body>
		 <div class ="container">
			<header>
				<nav>
					<h1><a href="./">ASCol</a></h1>
					<ul>
						<?php
						if (!isset($login_page)) {
							$login_page=false;
						}
						?>
						<?php
						$nav_menu=get_navigation($db);
						while ($nav=$nav_menu->fetch()) {
							echo "<li" ;
							if ((!$login_page)) {
						if (($nav["id"]==$select_menu["id"])){echo " calss=\"selected\" style=\"font-weight: bold;\"";
							}}echo "><a href=\"index.php?editnav=".urlencode($nav["id"])."\">{$nav["menu_name"]} </a></li>";						 		
						}
						?>
						<?php 
						if (!$login_page) {
					echo" <a href=\"login.php\" style=\"text-align:right; padding: 0px 15px\">Log in</a>";
						}
						?>
					</ul>
				</nav>
			</header>
			 