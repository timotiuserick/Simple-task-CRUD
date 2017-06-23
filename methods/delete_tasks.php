<?php

$link = mysql_connect('localhost','root','');
$db = mysql_select_db('simple_tasks');

$id = $_POST['id'];

$query = mysql_query("delete from tasks where id = '" . $id . "'");

header('Content-type: application/json');
echo json_encode(true);

?>