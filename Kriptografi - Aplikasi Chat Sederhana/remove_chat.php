<?php

include("./database.php");
include("./functions.php");

if (isset($_POST['chat_message_id'])) {
    $query = "UPDATE chat_message SET status_message = '2', updated_at = now() WHERE chat_message_id = '" . $_POST['chat_message_id'] . "'";

    $statement = $connect->prepare($query);
    $statement->execute();
}
