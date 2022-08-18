<?php 
function retrieveEntries($db, $id=NULL)
{
	if(isset($id)){
		$sql = "SELECT title, entry
		FROM entries
		WHERE id=?
		LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($_GET['id']));
		$e = $stmt->fetch();
		$fulldisp = 1;
		if (!$e) {
			return null;
		}
	}else{
		$sql = "SELECT id, title
		FROM entries
		ORDER BY created DESC";
		$e = [];
		foreach($db->query($sql) as $row) {
			$e[] = array('id' => $row['id'],'title' => $row['title']);
		}
		$fulldisp =NULL;
		
	}
	array_push($e, $fulldisp);
	return $e;
}

function sanitizeData($data){
	if(!is_array($data)){
	return strip_tags($data, "<a>");
	}
	else{
	return array_map('sanitizeData', $data);
	}
}
?>