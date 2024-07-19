<?php
function getNotifications() {
    return isset($_SESSION['notification']) ? $_SESSION['notification'] : ['type' => '', 'message' => ''];
}

function displayNotifications($notification) {
    if (!empty($notification['message'])) {
        $class = $notification['type'] === 'error' ? 'error-notification' : 'success-notification';
        echo "<div class=\"{$class} notification\">";
        echo "<p>" . htmlspecialchars($notification['message']) . "</p>";
        echo "</div>";
    }
}

function clearNotifications() {
    unset($_SESSION['notification']);
}
?>
