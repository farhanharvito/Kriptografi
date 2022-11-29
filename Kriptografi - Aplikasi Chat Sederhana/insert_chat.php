<?php

require_once './database.php';
require_once './functions.php';

$message=$_POST['chat_message'];
$message=str_rot13(base64_encode($message));

$data = array(
    ':to_user_id'       => $_POST['to_user_id'],
    ':from_user_id'     => $_SESSION['user_id'],
    //':chat_message'     => encrypt($sBox, $_SESSION['username'], $_POST['chat_message']),
    ':chat_message'     => $message,
    ':status_message'   => '1'
);

$query = "INSERT INTO chat_message(to_user_id, from_user_id, chat_message, status_message) VALUES(:to_user_id, :from_user_id, :chat_message, :status_message)";

$statement = $connect->prepare($query);

$connect->exec("set names utf8mb4");

if ($statement->execute($data)) {
    if ($statement->rowCount() > 0) {
        echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
    }
} else {
    var_dump($connect->errorCode());
}
