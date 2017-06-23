<?php

$link = mysql_connect('localhost','root','');
$db = mysql_select_db('simple_tasks');

$query = mysql_query("select * from tasks;");
$resps = array();
while($data = mysql_fetch_array($query)) {
	$resp['id'] = $data['id'];
	$resp['name'] = $data['name'];
	$resp['description'] = $data['description'];
	$resp['dateCreated'] = $data['dateCreated'];
	$resp['dateUpdated'] = $data['dateUpdated'];
	$resps[] = $resp;
}

header('Content-type: application/json');
echo json_encode($resps);

?>