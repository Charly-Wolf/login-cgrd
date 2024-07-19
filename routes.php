<?php
session_start();
include("config/connect.php");
include("classes/News.php");

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
function getAllNews() {
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

function createNews() {
    global $conn;
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title) || empty($description)) {
        $_SESSION['notification'] = ['type' => 'error', 'message' => "Title and description cannot be empty!"];
        header("Location: dashboard.php");
        exit();
    }

    $sql = "INSERT INTO news (title, description, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $_SESSION["userId"]);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = ['type' => 'success', 'message' => "News was successfully created!"];
    } else {
        $_SESSION['notification'] = ['type' => 'error', 'message' => "Error! News could not be created."];
    }

    header("Location: dashboard.php");
    exit();
}

function deleteNews() {
    global $conn;
    $newsId = $_POST['news_id'];

    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $newsId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = ['type' => 'success', 'message' => "News was successfully deleted!"];
    } else {
        $_SESSION['notification'] = ['type' => 'error', 'message' => "Error! News could not be deleted."];
    }

    header("Location: dashboard.php");
    exit();
}

function saveNews() {
    global $conn;
    $newsId = $_POST['news_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Validate input
    if (empty($newsId) || empty($title) || empty($description)) {
        $_SESSION['notification'] = ['type' => 'error', 'message' => "All fields are required!"];
        header("Location: dashboard.php");
        exit();
    }

    $sql = "UPDATE news SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $newsId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = ['type' => 'success', 'message' => "News was successfully edited!"];
    } else {
        $_SESSION['notification'] = ['type' => 'error', 'message' => "Error! News could not be edited."];
    }

    // Clear the edit session variables
    unset($_SESSION['edit_news_id']);
    unset($_SESSION['edit_news_title']);
    unset($_SESSION['edit_news_description']);

    header("Location: dashboard.php");
    exit();
}
?>
