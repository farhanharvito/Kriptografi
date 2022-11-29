<?php

require_once './database.php';
require_once './functions.php';

echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
