<?php
session_start();

include("functions.php");
include("connections.php");

$error = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST ['username'];
    $password = $_POST ['password'];


    $result = null;

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        $query = "select * from users where username = '$username' limit 1";
        $result = mysqli_query($conn, $query);
    }
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);

            //this section of the code is to validate the information being inputted into the login page with the information on the database.
            if (password_verify($password, $userdata['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = ($userdata['email']);
                $_SESSION['user_id'] = $userdata['id'];
                //this is the one time password functionality, there is a random number generator that will generate a number.
                //there is also an email validation section in the code which checks who logged in to make sure the email
                //is sent to the correct address.
                //the final part of the code is the is where the email will come from.
                $to = $_SESSION ['email'];
                $_SESSION ['otp'] = rand(10000, 99999);
                $subject = 'otp';
                $message = 'otp: ' . $_SESSION ['otp'];
                $from = 'pctechotp123@gmail.com';

                // Sending email
                if (mail($to, $subject, $message)) {
                    echo 'Your mail has been sent successfully.';
                    header("Location: email.php");
                } else {
                    echo 'Unable to send email. Please try again.';
                }
                die;
            } else {
                echo "incorrect password";
            }

        }

    } else {
        echo "Please enter some correct information";
    }
}
?>

<html>
<head>
    <title>Login</title>
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

    #login {
        background: #51AC74;
    }


</style>

<div id="box">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div>Login</div>
        <br>

        <tr>
            <input type="text" name="username" placeholder="Username"> <br><br>
        </tr>
        <tr>
            <input type="password" name="password" placeholder="Password"> <br><br>
        </tr>
        <input type="submit" id="login" value="login"> <br><br>

        <a href="signup.php">Signup</a> <br><br>
    </form>
</div>
</body>
</html>