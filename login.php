<?php
    include_once("utils/login.php");
    include_once("utils/notifications.php");

    // Redirect to dashboard if already logged in
    if (!empty($_SESSION["username"])) {
        header("Location: dashboard.php");
        exit();
    }

    $notification = getNotifications();
    clearNotifications();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/style.css">
    <link rel="icon" type="image/png" href="resources/media/favicon.png">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <main id="login-screen">
            <?php displayNotifications($notification); ?>
            <div class="form-container">
                <form id="login-form" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                    <div class="input-group">
                        <input type="text" placeholder="Username" name="username" id="username" />
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Password" name="password" id="password" />
                    </div>
                    <input id="login-btn" class="btn" type="submit" name="login" value="Login" />
                </form>
            </div>
        </main>
    </div>
</body>
</html>
