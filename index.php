<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include_once 'nav_bar.php';

    if (isset($_SESSION['id'])) {
        header("Location:post.php");
    } else {
        header("Location:login.php");
    }
    ?>
</body>

</html>