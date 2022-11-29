<?php
require_once './database.php';

$message = '';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_POST['register'])) {
    $query = "SELECT * FROM login WHERE username = :username";

    $statement = $connect->prepare($query);
    $statement->bindParam(":username", $_POST['username']);
    $statement->execute();

    $count = $statement->rowCount();
    if (!$count) {
        $username = filter_var($_POST['username']);
        $password = $_POST['password'];
        $pass=md5($password);

        $query = "INSERT INTO login(username, password) VALUES(:username, :password)";

        $statement = $connect->prepare($query);
        $data = [
            ":username" => $username,
            ":password" => $pass
        ];
        $statement->execute($data);

        $message = "<label>Successful register!</label>";
    } else {
        $message = '<label>Your username has been registered</label>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Chat Sederhana | Register</title>
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
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <p class="text-info"><?= $message; ?></p>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label><input type="text" name="username" class="form-control" id="" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label><input type="password" name="password" id="" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Register" class="btn btn-primary" name="register">
                        <a href='login.php' class='btn btn-secondary'>Login</a>
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