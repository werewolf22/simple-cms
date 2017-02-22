<html>
 <head>
     <title>css layout</title>
     <link href="stylesheets/main.css" rel="stylesheet"/>
 </head>
     <body>
		 <div class ="container">
			 <header>
				 <nav>
					 <h1 STYLE="float:left; padding: 0px 55px;">ASCol</h1>
					 <ul STYLE="float:left; padding: 5px 20px">
						 
						 <?php
						 if (!isset($add_page)) {
						 	$add_page=false;
						 }
						 	$nav_menu=get_navigation($db,false);
						 	while ($nav=$nav_menu->fetch()) {
						 		echo "<li" ;
					 		if ($nav["id"]==$select_menu["id"]){echo " calss=\"selected\" style=\"font-weight: bold;\"";
						 		}echo "><a href=\"edit_page.php?editnav=".urlencode($nav["id"])."\">{$nav["menu_name"]} </a></li>";
						 	}
						 	?>
						 <?php 
						 if (!$add_page) {
						  	echo	"<a href=\"add_page.php\" style=\"padding:0 15px;\">+ add new navigation</a>";
						  }
						  ?> 
					 </ul>
				 </nav>
			 </header>