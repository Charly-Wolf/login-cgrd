<?php
include_once("NotificationType.php");

class Notification {
    private NotificationType $type;
    private string $message;

    public function __construct(NotificationType $type, string $message) {
        $this->type = $type;
        $this->message = $message;
    }

    public function getType(): NotificationType {
        return $this->type;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function isSuccess(): bool {
        return $this->type === NotificationType::SUCCESS;
    }

    public function isError(): bool {
        return $this->type === NotificationType::ERROR;
    }
}
?>
