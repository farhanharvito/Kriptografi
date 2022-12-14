<?php

require_once './database.php';
require_once './functions.php';

$query = "SELECT * FROM login WHERE user_id != '" . $_SESSION['user_id'] . "'";

$statement = $connect->prepare($query);

$statement->execute();
$result = $statement->fetchAll();

$output = '
    <table class="table table-bordered table-striped">
        <tr>
            <th>Username</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
';

foreach ($result as $row) {
    $status = '';
    $current_timestamp = strtotime(date('Y-m-d H:i:s') . '-10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);

    if ($user_last_activity > $current_timestamp) {
        $status = '<span class="btn btn-success">Online</span>';
    } else {
        $status = '<span class="btn btn-danger">Offline</span>';
    }
    $output .= '
        <tr>
            <td>' . $row['username'] .  ' ' . count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect) . ' ' . fetch_is_type_status($row['user_id'], $connect) . '</td>
            <td>' . $status . '</td>
            <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="' . $row['user_id'] . '" data-tousername="' . $row['username'] . '">Start chat</button></td>
        </tr>
    ';
}

$output .= '</table>';

echo $output;
