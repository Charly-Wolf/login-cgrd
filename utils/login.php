<?php
include_once("config/connect.php");
include_once('notifications.php');

session_start();

if (isset($_POST["login"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty(trim($username)) || empty(trim($password))) {
        setNotification(new Notification(NotificationType::ERROR, "Username and password cannot be empty"));
        header("Location: index.php");
        exit();
    } else {
        $sql = "SELECT id FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $username;
            $_SESSION["userId"] = $row['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            setNotification(new Notification(NotificationType::ERROR, "Wrong Login Data!"));
            header("Location: index.php");
            exit();
        }
    }
}
?>
