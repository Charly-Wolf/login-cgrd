<?php
include_once('classes/Notification.php');

function getNotifications(): ?Notification {
    if (isset($_SESSION['notification'])) {
        $notificationData = $_SESSION['notification'];
        $type = NotificationType::from($notificationData['type']);
        return new Notification($type, $notificationData['message']);
    }
    return null;
}

function displayNotifications(?Notification $notification): void {
    if ($notification) {
        $class = $notification->isError() ? 'error-notification' : 'success-notification';
        echo "<div class=\"{$class} notification\">";
        echo "<p>" . htmlspecialchars($notification->getMessage()) . "</p>";
        echo "</div>";
    }
}

function setNotification(Notification $notification): void {
    $_SESSION['notification'] = [
        'type' => $notification->getType()->value,
        'message' => $notification->getMessage()
    ];
}

function clearNotifications(): void {
    unset($_SESSION['notification']);
}
?>
