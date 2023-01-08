<?php
session_start();
include('connections.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

<html>
<head>
    <title>Website</title>
</head>
<body>
<div>
    <style type="text/css">

        body {
            background-color: #eee;
        }

        .header {
            padding: 30px;
            text-align: center;
            background: white;
        }

        .header h1 {
            font-size: 50px;
        }

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

        .box {
            padding: 30px;
            background: white;
        }

        .header2 {
            font-weight: bold;
        }

    </style>

    <ul>
        <li><a href="create.php">Create a New Post</a></li>
        <li><a href="login.php">Logout</a></li>
    </ul>


    <div class="header">
        <h1>This is my index page</h1>
        <p>Hello, <?php echo $_SESSION['username']; ?></p>
    </div>


    <br>


    <?php

    $sql = "SELECT * FROM `blog` LEFT JOIN `users` ON blog.user_id = users.id;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            echo '<div class="box">';
            echo '<div class="header2">';
            echo $row['title'];
            echo '</div>';
            echo '<br>';
            echo $row['content'];
            echo '<br>';

            if (isset($row['path'])) {
                echo "<img src='" . $row['path'] . "' style='width:1000px' >";
            }

            echo '<br>';
            echo 'Made by: ' . $row['username'];

            echo '<br>';
            echo '<br>';
            echo "</div>";
        }
    }
    ?>

</div>
</div>
</body>
</html>
