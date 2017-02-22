<?php	
   function get_navigation($db,$public=true){
     $nav_qry="SELECT * FROM navigation";
     if ($public) {
     	$nav_qry .=" WHERE visible=1";
     }
     $nav_qry .=" ORDER by POSITION ASC";
	 $nav_menu=$db->query($nav_qry);
	 return($nav_menu);
   }
   function get_edit_page($nav_id,$db,$public=true){
   	 $pageedit_qry="SELECT * FROM edit where nav_id={$nav_id}";
     if ($public) {
     	$pageedit_qry .=" AND visible=1";
     }
     $pageedit_qry.=" ORDER by position ASC";
	 $pageedit_name= $db->query($pageedit_qry);
	 return($pageedit_name);
   }
   function get_navmenu_byid($sel_nav,$db){
		 $qry="SELECT * FROM navigation WHERE id={$sel_nav} LIMIT 1";
		 $selected_set= $db->query($qry);
		 if ($selected= $selected_set->fetch()) {
		 	return $selected;
		 }else{
		 	return null;
		 }
	}
	function get_page_byid($sel_page,$db){
		 $qry="SELECT * FROM edit WHERE id={$sel_page} LIMIT 1";
		 $selected_set= $db->query($qry);
		 if ($selected= $selected_set->fetch()) {
		 	return $selected;
		 }else{
		 	return null;
		 }
	}
	function get_default_page($nav_id,$db){
		$selected_set=get_edit_page($nav_id,$db,true);
		if ($selected= $selected_set->fetch()) {
		 	return $selected;
		 }else{
		 	return null;
		 }
	}
	function selected_page($db,$blog=false){
		global $select_menu;
		global $select_page;
		global $id;
		global $fulldisp,$e;
     if (isset($_GET["editnav"])) {
    	$select_menu=get_navmenu_byid($_GET["editnav"],$db);
    	$select_page=get_default_page($select_menu["id"],$db);
    	if ($blog) {
    	$id = NULL;
    	$e = retrieveEntries($db, $id);
        $fulldisp = array_pop($e);
        $e = sanitizeData($e);
    	}        
    }elseif (isset($_GET["editpage"])) {
    	$select_page=get_page_byid($_GET["editpage"],$db);
    	$select_menu=get_navmenu_byid($select_page["nav_id"],$db);
    	if ($blog) {
    	$id = NULL;
    	$e = retrieveEntries($db, $id);
        $fulldisp = array_pop($e);
        $e = sanitizeData($e);
    }
    }elseif(isset($_GET['id'])){
    	$id =(int) $_GET['id'];
    	$e = retrieveEntries($db, $id);
        $fulldisp = array_pop($e);
        $e = sanitizeData($e);
    }else{
    	$select_menu= NULL;
    	$select_page= NULL;
    	if ($blog) { 
    	$id = NULL;
    	$e = retrieveEntries($db, $id);
        $fulldisp = array_pop($e);
        $e = sanitizeData($e);
    }
    }
	}
	function navigation($select_page,$db,$public=false){
					$nav_menu=get_navigation($db,$public);
						 while ($nav=$nav_menu->fetch()) {
						 	$pageedit_name=get_edit_page($nav["id"],$db,$public);	
						 	while ($page=$pageedit_name->fetch()) {
						 		echo "<ul class=\"pages\"><li" ;
					 		if ($page["id"]==$select_page["id"]){
					 			echo " calss=\"selected\" style=\"font-weight: bold;\"";
						 		}echo "><a href=\"content.php?editpage=".urlencode($page["id"])."\">{$page["name"]} </a></li></ul>";
						 	}
						 	}
	} 
	function public_navigation($select_menu,$select_page,$db,$public=true){
					$nav_menu=get_navigation($db,$public);
						 while ($nav=$nav_menu->fetch()) {
						 	if (($nav["id"]==$select_menu["id"])&&($select_page)) {
						 	$pageedit_name=get_edit_page($nav["id"],$db,$public);	
						 	while ($page=$pageedit_name->fetch()) {
						 		echo "<ul class=\"pages\"><li" ;
					 		if ($page["id"]==$select_page["id"]){
					 			echo " calss=\"selected\" style=\"font-weight: bold;\"";
						 		}echo "><a href=\"index.php?editpage=".urlencode($page["id"])."\">{$page["name"]} </a></li></ul>";
						 		}
						 	}
						 	}
	}
	?>