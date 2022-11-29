<?php

include("./database.php");

$is_type = filter_input(INPUT_POST, 'is_type');

$query = "UPDATE login_details SET is_type = '" . $is_type . "' WHERE login_details_id = '" . $_SESSION['login_details_id'] . "'";

$statement = $connect->prepare($query);
$statement->execute();
