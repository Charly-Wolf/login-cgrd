<?php
  class News {
    private $id;
    private $title;
    private $description;
    private $userId;

    public function __construct($title, $description, $userId, $id = null)
    {
      $this->id = $id;
      $this->title = $title;
      $this->description = $description;
      $this->userId = $userId;
    }

    function getId() {
      return $this->id;
    }

    function getTitle() {
      return $this->title;
    }

    function getDescription() {
      return $this->description;
    }

    function getUserId() {
      return $this->userId;
    }

    function setTitle($title) {
      $this->title = $title;
    }

    function setDescription($description) {
      $this->description = $description;
    }

    function setUserId($userId) {
      $this->userId = $userId;
    }

  }
?>