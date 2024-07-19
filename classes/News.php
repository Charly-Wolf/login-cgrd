<?php
  class News {
    private int $id;
    private string $title;
    private string $description;
    private string $userId;

    public function __construct($title, $description, $userId, $id = null)
    {
      $this->id = $id;
      $this->title = $title;
      $this->description = $description;
      $this->userId = $userId;
    }

    function getId(): int {
      return $this->id;
    }

    function getTitle(): string {
      return $this->title;
    }

    function getDescription(): string {
      return $this->description;
    }

    function getUserId(): int {
      return $this->userId;
    }

    function setTitle($title): void {
      $this->title = $title;
    }

    function setDescription($description): void {
      $this->description = $description;
    }

    function setUserId($userId): void {
      $this->userId = $userId;
    }

  }
?>