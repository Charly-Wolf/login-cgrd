<?php
include_once("routes.php");
include_once("utils/notifications.php");

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: index.php"); 
    exit(); 
}

$notification = getNotifications();
clearNotifications();

$newsArray = getAllNews();
include_once("header.html");

// Initialize variables for editing
$editNewsId = isset($_SESSION['edit_news_id']) ? $_SESSION['edit_news_id'] : '';
$editNewsTitle = isset($_SESSION['edit_news_title']) ? $_SESSION['edit_news_title'] : '';
$editNewsDescription = isset($_SESSION['edit_news_description']) ? $_SESSION['edit_news_description'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/style.css">
    <link rel="icon" type="image/png" href="resources/media/favicon.png"> 
    <title>CGRD Dashboard</title>
</head>
<body>
    <main class="container">
        <?php displayNotifications($notification); ?>

        <?php if (count($newsArray) >= 1): ?>
            <div class="news-container">
                <div class="form-title">
                    <h2>All News</h2>
                    <button id="toggle-news-list" type="submit" name="arrow" class="action-btn" title="Toggle News">
                        <i id="arrow-icon" class="arrow-close-icon"></i> 
                    </button>        
                </div>

                <section class="news-list">
                    <?php foreach ($newsArray as $news): ?>
                        <article class="news-card">
                            <div class="news-info">
                                <span class="news-title"><?= htmlspecialchars($news->getTitle()) ?></span>
                                <p class="news-description"><?= htmlspecialchars($news->getDescription()) ?></p>
                            </div>
                            <form class="news-icons" method="post" action="routes.php">
                                <input type="hidden" name="news_id" value="<?= $news->getId() ?>">
                                <button type="button" class="action-btn edit-btn" data-id="<?= $news->getId() ?>" data-title="<?= htmlspecialchars($news->getTitle()) ?>" data-description="<?= htmlspecialchars($news->getDescription()) ?>" title="Edit">
                                    <i class="edit-icon"></i>
                                </button>
                                <button type="submit" name="delete_news" class="action-btn" title="Delete">
                                    <i class="delete-icon"></i>
                                </button>
                            </form>
                        </article>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>

            <div class="create-news-container">
                <div class="form-container">
                    <form id="news-form" method="post" action="routes.php">
                        <div class="form-title">
                            <h2 id="form-title"><?php echo $editNewsId ? 'Edit News' : 'Create News'; ?></h2>
                            <button id="cancel-btn" type="button" class="action-btn hidden">
                                <i class="delete-icon" title="Cancel Edit"></i> 
                            </button>        
                        </div>  
                        <div class="input-group">
                            <input type="hidden" name="news_id" id="news-id" value="<?= htmlspecialchars($editNewsId) ?>">
                            <input type="text" maxlength="30" id="news-title" placeholder="Title" name="title" value="<?= htmlspecialchars($editNewsTitle) ?>" />
                        </div>
                        <div class="input-group">
                            <textarea id="news-description" maxlength="600" placeholder="Description" name="description"><?= htmlspecialchars($editNewsDescription) ?></textarea>
                        </div>

                        <input id="save-btn" class="btn" type="submit" name="<?= $editNewsId ? 'save_news' : 'create_news' ?>" value="<?= $editNewsId ? 'Save' : 'Create' ?>" />
                    </form>
                    <form method="post" action="utils/logout.php">
                        <button id="logout-btn" class="btn" type="submit">Logout</button>
                    </form>
                </div>
            </div> 
        </div>
    </main>
    <script src="resources/script.js"></script>
</body>
</html>
