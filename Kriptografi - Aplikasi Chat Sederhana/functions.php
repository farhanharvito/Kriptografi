<?php

// initial S-Box
$sBox = range(0, 255);

/*
*  Chat Applications with RC4 Algorithm
* // reference 
* https://github.com/agung96tm/rc4
* */

// Algoritma Kriptografi RC4
// proses menukar 
function swap(&$a, &$b): void
{
    // penukaran menggunakan alamat pointernya
    $temp = $a;
    $a = $b;
    $a = $temp;
}

// Proses mengacak S-Box
function randomSBox($key, $sBox): void
{
    $i = 0;
    $j = 0;
    // menghitung ukuran panjang key
    $length = strlen($key);
    for ($i = 0; $i < 256; $i++) {
        // konversi karakter ke bilangan 0 - 255
        $char = ord($key[$i % $length]);

        $j = ($j + $sBox[$i] + $char) % 256;
        swap($sBox[$i], $sBox[$j]);
    }
}

// Proses Pseudo Random Byte
function pseudoRandomWithXor(string $data, array $sBox): string
{
    // menghitung ukuran panjang data
    $n = strlen($data);
    $i = $j = 0;
    // konversi string ke array
    $data = str_split($data, 1);

    for ($m = 0; $m < $n; $m++) {
        $i = ($i + 1) % 256;
        $j = ($j + $sBox[$i]) % 256;

        swap($sBox[$i], $sBox[$j]);

        // konversi strig ke 0-255
        $char = ord($data[$m]);
        $t = ($sBox[$i] + $sBox[$j]) % 256;

        // kemudian xor kan hasil pembangkitan kunci dengan karakter yang ingin dienckrip/dekrip
        $char = $sBox[$t] ^ $char;
        // konversi angka 0-255 ke karakter
        $data[$m] = chr($char);
    }

    // menggabungkan array menjadi satu
    $data = implode('', $data);
    return $data;
}

function encrypt(array $sBox, string $key, string $plainText): string
{
    randomSBox($key, $sBox);
    $chiperText = pseudoRandomWithXor($plainText, $sBox);
    return $chiperText;
}

function decrypt(array $sBox, string $key, string $chiperText): string
{
    randomSBox($key, $sBox);
    $plaintText = pseudoRandomWithXor($chiperText, $sBox);
    return $plaintText;
}

function fetch_user_last_activity($user_id, $connect)
{
    $query = "SELECT * FROM login_details WHERE user_id = '" . $user_id . "' ORDER BY last_activity DESC LIMIT 1";

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['last_activity'];
    }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
    global $sBox;
    $query = "SELECT *, login.username as username_from FROM chat_message INNER JOIN login ON from_user_id = user_id WHERE (from_user_id = '" . $from_user_id . "' AND to_user_id = '" . $to_user_id . "') OR (from_user_id = '" . $to_user_id . "' AND to_user_id ='" . $from_user_id . "')   ORDER BY created_at DESC";

    $statement = $connect->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();
    $output = '<ul class="list-unstyled">';

    foreach ($result as $row) {
        $username = '';
        $chat_message = '';
        $dynamic_background = '';

        if ($row['from_user_id'] == $from_user_id) {
            if ($row['status_message'] == '2') {
                $chat_message = '<em>This message has been removed</em>';
                $username = '<strong class="text-success">You</strong>';
            } else {
                $chat_message = $row['chat_message'];
                $username = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="' . $row['chat_message_id'] . '">x</button>&nbsp;<strong class="text-success">You</strong>';
            }
            $dynamic_background = 'background-color: #ffe6e6';
        } else {
            if ($row['status_message'] == '2') {
                $chat_message = '<em>This message has been removed</em>';
            } else {
                $chat_message = $row['chat_message'];
            }

            $username = '<strong class="text-danger">' . get_user_name($row['from_user_id'], $connect) . '</strong>';
            $dynamic_background = 'background-color: #ffffe6';
        }

        $output .= '
            <li style="border-bottom: 1px solid #ccc;padding-left:8px;padding-right:8px;' . $dynamic_background . '">
                <p>' . $username . ' - ' . base64_decode(str_rot13($chat_message))  . //decrypt($sBox, $row['username_from'], $row['chat_message'])  
            '<div align="right">
                        - <small><em>' . $row['created_at'] . '</em></small>
                    </div>
                </p>
            </li>
        ';
    }

    $output .= '</ul>';

    $query = "UPDATE chat_message SET status_message = '0' WHERE from_user_id ='" . $to_user_id . "' AND to_user_id ='" . $from_user_id . "' AND status_message = '1'";

    $statement = $connect->prepare($query);
    $statement->execute();
    return $output;
}

function get_user_name($user_id, $connect)
{
    $query = "SELECT username FROM login WHERE user_id = '" . $user_id . "'";

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        return $row['username'];
    }
}


function count_unseen_message($from_user_id, $to_user_id, $connect)
{
    $query = "SELECT * FROM chat_message WHERE from_user_id = '" . $from_user_id . "' AND to_user_id = '" . $to_user_id . "' AND status_message = '1'";

    $statement = $connect->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    $output = '';

    if ($count > 0) {
        $output .= '<span class="btn btn-success">' . $count . '</span>';
    }

    return $output;
}

function fetch_is_type_status($user_id, $connect)
{
    $query = "SELECT is_type FROM login_details WHERE user_id = '" . $user_id . "' ORDER BY last_activity DESC limit 1";

    $statement = $connect->prepare($query);
    $statement->execute();
    $output = '';

    $result = $statement->fetchAll();
    foreach ($result as $row) {
        if ($row['is_type'] == 'yes') {
            $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
        }
    }

    return $output;
}

function fetch_group_chat_history($connect)
{
    $query = "
        SELECT * FROM chat_message WHERE to_user_id = '0'
        ORDER BY created_at DESC
    ";

    $statement = $connect->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();
    $output = '<ul class="list-unstyled">';

    foreach ($result as $row) {
        $username = '';
        $dynamic_background = '';
        $chat_message = '';

        if ($row['from_user_id'] == $_SESSION['user_id']) {
            if ($row['status_message'] == '2') {
                $chat_message = '<em>This message has been removed</em>';
                $username = '<strong class="text-success">You</strong>';
            } else {
                $chat_message = $row['chat_message'];
                $username = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="' . $row['chat_message_id'] . '">x</button>&nbsp;<strong class="text-success">You</strong>';
            }

            $dynamic_background = 'background-color: #ffe6e6';
        } else {
            if ($row['status_message'] == '2') {
                $chat_message = '<em>This message has been removed</em>';
            } else {
                $chat_message = $row['chat_message'];
            }
            $username  = '<strong class="text-danger">' . get_user_name($row['from_user_id'], $connect) . '</strong>';

            $dynamic_background = 'background-color: #ffffe6';
        }

        $output .= '
            <li style="border-bottom:1px dotted #ccc;padding-left:8px;padding-right:8px;' . $dynamic_background . '">
                <p>' . $username . ' - ' . $chat_message . '
                    <div class="text-right">
                        - <small><em>' . $row['created_at'] . '</em></small>
                    </div>
                </p>
            </li>
        ';
    }
    $output .= '</ul>';

    return $output;
}
