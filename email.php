<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION ['otp'] == $_POST ['otp']) {
        header("Location: index.php");
    } else {
        echo "incorrect otp";
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

        <div> OTP</div>
        <br>

        <tr>
            <input type="text" name="otp" placeholder="otp"> <br><br>
        </tr>
        <input type="submit" id="login" value="login"> <br><br>
    </form>
</div>
</body>
</html>
