<?php
require_once './database.php';

$message = '';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_POST['login'])) {
    $query = "SELECT * FROM login WHERE username = :username";

    $statement = $connect->prepare($query);
    $statement->bindParam(":username", $_POST['username']);
    $statement->execute();

    $count = $statement->rowCount();
    if ($count) {
        $result = $statement->fetchAll();
        foreach ($result as $row) :
            if (isset($_POST['login'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];

                $sub_query = "INSERT INTO login_details(user_id) VALUES('" . $row['user_id'] . "')";

                $statement = $connect->prepare($sub_query);
                $statement->execute();

                $_SESSION['login_details_id'] = $connect->lastInsertId();
                header("Location: index.php");
            } else {
                $message = "<label>Wrong password</label>";
            }
        endforeach;
    } else {
        $message = '<label>Wrong username</label>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Chat Sederhana</title>
    <link rel="stylesheet" href="./vendor/jquery-ui/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="./vendor/bootstrap.min.css" />
    <script src="./vendor/bootstrap.min.js" type="text/javascript"></script>
    <script src="./vendor/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="./vendor/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        <br />
        <h3 style="text-align:center;">Aplikasi Chat Sederhana</h3><br />
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <p class="text-danger"><?= $message; ?></p>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label><input type="text" name="username" class="form-control" id="" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label><input type="password" name="password" id="" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-primary" name="login">
                        <a href='register.php' class='btn btn-secondary'>Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <p style="text-align: center;">&copy;123200029</p>
    </div>
</body>

</html>