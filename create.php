<?php
session_start();

include("functions.php");

$error = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST ['title'];
    $content = $_POST ['content'];
    $user_id = $_SESSION ['user_id'];
    $path = $_SESSION ['destination'];
    //used to connect to the sql database.
    $mysqli = new mySQLi('localhost', 'root', '', 'login_db');
    //used to input the data into the sql database.
    $insert = $mysqli->query("INSERT INTO blog (user_id, title, content, path)
		VALUES('$user_id', '$title', '$content', '$path')");
    if ($insert) {
        echo "success";
    } else {
        echo $mysqli->error;
    }
    header("Location: index.php");
}
?>

<style type="text/css">
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #111;
    }
</style>

<ul>
    <li><a href="index.php">Homepage</a></li>
    <li><a href="login.php">Logout</a></li>
</ul>

<br>

<?php
if (isset($_SESSION['destination'])) {
    echo "<img src='" . $_SESSION['destination'] . "' style='width:1000px' >";
}
?>

<div class="input">
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        Please select a image to upload.
        <input type="file" name="file">
        <button type="submit" name="submit"> Upload</button>
    </form>
</div>

<br>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="text" name="title" placeholder="Blog Title"><br>
    <textarea name="content"></textarea><br>
    <button>Add Post</button>
</form>

