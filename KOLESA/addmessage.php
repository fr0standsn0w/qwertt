<?php
try{
	$conn = new PDO( dsn:"mysql:host=localhost;dbname=testDB", username: 'root', passwd: ''); 
	$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
	$user = 'root';
	$password = '';
	if (empty($_POST['name'])) exit("Поле не заполнено");
	if (empty($_POST['content'])) exit("Поле не заполнено");
	
	$query = "INSERT INTO message VALUES (NULL . :name. NOW())";
	$msg = $conn->prepare($query);
	$msg->execute(['name' => $_POST['name']]);
	
	$msg_id = $conn->lastInsertId();
	
	$query = "INSERT INTO message_content VALUES (NULL . :content. :message_id)";
	$msg = $conn->prepare($query);
	$msg->execute(['content' => $_POST['content'], 'message_id' => $msg_id]);
	

}
catch (PDOException $e)
{
	echo "Error";
}		
?>