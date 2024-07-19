<?php
session_start();
include_once('config/connect.php'); 
include_once('classes/News.php'); 
include_once('utils/notifications.php'); 
include_once('classes/NotificationType.php');


// Routing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_news'])) {
        createNews();
    } elseif (isset($_POST['save_news'])) {
        saveNews();
    } elseif (isset($_POST['delete_news'])) {
        deleteNews();
    } elseif (isset($_POST['cancel'])) {
        unset($_SESSION['edit_news_id']);
        unset($_SESSION['edit_news_title']);
        unset($_SESSION['edit_news_description']);
        header("Location: dashboard.php");
        exit();
    }
}

// Methods
function getAllNews(): array {
    global $conn;
    $newsArray = [];

    $sql = "SELECT * FROM news WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION["userId"]);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $news = new News($row['title'], $row['description'], $row['user_id'], $row['id']);
        $newsArray[] = $news;
    }

    return $newsArray;
}

function createNews(): void {
    global $conn;
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title) || empty($description)) {
        setNotification(new Notification(NotificationType::ERROR, "Title and description cannot be empty!"));
        header("Location: dashboard.php");
        exit();
    }

    $sql = "INSERT INTO news (title, description, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $_SESSION["userId"]);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        setNotification(new Notification(NotificationType::SUCCESS, "News was successfully created!"));
    } else {
        setNotification(new Notification(NotificationType::ERROR, "Error! News could not be created."));
    }

    header("Location: dashboard.php");
    exit();
}

function deleteNews(): void {
    global $conn;
    $newsId = $_POST['news_id'];

    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $newsId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        setNotification(new Notification(NotificationType::SUCCESS, "News was successfully deleted!"));
    } else {
        setNotification(new Notification(NotificationType::ERROR, "Error! News could not be deleted."));
    }

    header("Location: dashboard.php");
    exit();
}

function saveNews(): void {
    global $conn;
    $newsId = $_POST['news_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Validate input
    if (empty($newsId) || empty($title) || empty($description)) {
        setNotification(new Notification(NotificationType::ERROR, "All fields are required!"));
        header("Location: dashboard.php");
        exit();
    }

    $sql = "UPDATE news SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $newsId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        setNotification(new Notification(NotificationType::SUCCESS, "News was successfully edited!"));
    } else {
        setNotification(new Notification(NotificationType::ERROR, "Error! News could not be edited."));
    }

    // Clear the edit session variables
    unset($_SESSION['edit_news_id']);
    unset($_SESSION['edit_news_title']);
    unset($_SESSION['edit_news_description']);

    header("Location: dashboard.php");
    exit();
}
?>
