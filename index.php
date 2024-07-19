<?php
    $loginError = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
    unset($_SESSION['login_error']);

    // Redirect to dashboard if user is already logged in
    if (!empty($_SESSION["username"]) || isset($_SESSION["username"])) {
        header("Location: dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/style.css">
    <link rel="icon" type="image/png" href="resources/media/favicon.png"> 
    <title>CGRD Login</title>
</head>
<body>

<?php
include_once("header.html");
include_once("login.php")
?>
</body>
</html>