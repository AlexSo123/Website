<?php
session_start();

include("functions.php");
include("connections.php");
$error = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $password2 = mysqli_real_escape_string($conn,$_POST['password2']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);

    if (strlen($username) < 5) {
        $error = "<p> Your username needs to be at least 5 characters</p>";
    } elseif ($password2 != $password) {
        $error .= "<p> Your passwords do not match</p>";
    } else {

        //used to connect to the sql database.
        $mysqli = new mySQLi('localhost', 'root', '', 'login_db');
        $password = password_hash($password, PASSWORD_DEFAULT);
        //used to input the data into the sql database.
        $insert = $mysqli->query("INSERT INTO users (username, password, email)
		VALUES('$username', '$password', '$email')");
        //when code is executed and the data is saved to the sql database,
        //it will then take you to the login page to sign in.
        header("Location: login.php");

        if ($insert) {
            echo "success";
        } else {
            echo $mysqli->error;
        }
    }
}
?>

<html>
<head>
    <title>Signup</title>
</head>
<body>

<style type="text/css">

    body {
        background-color: #eee;
    }

    #box {
        color: #777;
        border: 0px solid #afafaf;
        width: 25%;
        margin-left: 35%;
        margin-top: 120px;
        text-align: center;
        padding: 40px;
        padding-top: 20px;
        border-radius: 3px;
        box-shadow: 0px 0px 8px #777;
        background: rgba(255, 255, 255, 0.6);
    }

    input {
        color: #777;
        font-weight: bold;
        width: 70%;
        padding: 10px;
        margin: 10px;
        border: 1px solid #afafaf;
        border-radius: 3px;
        background: rgba(255, 255, 255, 0.5);
        outline: none;
    }

    input[type="button"] {
        color: white;
        width: 30%;
        border: 0px solid transparent;
        outline: none;
        cursor: pointer;
    }

    #signup {
        background: #51AC74;
    }

</style>

<div id="box">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div> Signup</div>
        <br>
        <tr>
            <td><input type="text" name="username" placeholder="Username"></td>
            <br><br>
        </tr>
        <tr>
            <td><input type="password" name="password" placeholder="Password"></td>
            <br><br>
        </tr>
        <tr>
            <td><input type="password" name="password2" placeholder="Repeat Password"></td>
            <br><br>
        </tr>
        <tr>
            <td><input type="email" name="email" placeholder="Email"></td>
            <br><br>
        </tr>
        <input type="submit" value="signup" id="signup"> <br><br>

        <a href="login.php">Login</a> <br><br>

        <div> <?php $error ?> </div>
    </form>
</div>
</body>
</html>