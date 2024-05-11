<?php
$dataFile = './data/content.xml';
if (file_exists($dataFile)) {
    $contentXML = simplexml_load_file($dataFile) or die("Error: Cannot create object");
} else {
    die("Error: XML file not found");
}
$content_array = [];
foreach ($contentXML->children() as $article) {
    $content_data = [];
    foreach ($article->children() as $key => $value) {
        $content_data[$key] = (string) $value;
    }
    $content_array[] = $content_data;
}
if (isset($_POST['save_article'])) {
    $articleTitle = $_POST['article_title'];
    $articleAuthor = $_POST['article_author'];
    $articleDescription = $_POST['article_description'];
    $articleContent = $_POST['article_content'];
    $articleImage = $_POST['article_image'];
    $articleId = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5);
    
    $contentItem = $contentXML->addChild($articleId);
    $contentItem->addChild('title', $articleTitle);
    $contentItem->addChild('author', $articleAuthor);
    $contentItem->addChild('description', $articleDescription);
    $contentItem->addChild('content', $articleContent);
    $contentItem->addChild('image', $articleImage);
    $contentItem->addChild('id', $articleId);
    $contentXML->asXML($dataFile);
    header("Location: http://localhost/jayson/admin.php");
    exit();
}
if (isset($_POST['delete_article'])) {
    $article_id = $_POST['article_id'];
    foreach ($contentXML->children() as $key => $article) {
        if ((string) $article->id === $article_id) {
        unset($contentXML->{$key});
        break;
        }
    }
    $contentXML->asXML($dataFile);
    header("Location: http://localhost/jayson/admin.php");
    exit();
}
if (isset($_POST['save_edited_article'])) {
    $articleTitle = $_POST['edit_article_title'];
    $articleAuthor = $_POST['edit_article_author'];
    $articleDescription = $_POST['edit_article_description'];
    $articleContent = $_POST['edit_article_content'];
    $articleImage = $_POST['edit_article_image'];
    $articleId = $_POST['edit_article_id'];

    $itemExists = false;
    foreach ($contentXML->children() as $item) {
        if ((string)$item->id === $articleId) {
            $item->title = $articleTitle;
            $item->author = $articleAuthor;
            $item->description = $articleDescription;
            $item->content = $articleContent;
            $item->image = $articleImage;
            $itemExists = true;
            break;
        }
    }
    if (!$itemExists) {
        $contentItem = $contentXML->addChild($articleId);
        $contentItem->addChild('title', $articleTitle);
        $contentItem->addChild('author', $articleAuthor);
        $contentItem->addChild('description', $articleDescription);
        $contentItem->addChild('content', $articleContent);
        $contentItem->addChild('image', $articleImage);
        $contentItem->addChild('id', $articleId);
    }
    $contentXML->asXML($dataFile);
    header("Location: http://localhost/jayson/admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="./js/admin.js" async></script>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="article_title" placeholder="Title">
        <input type="text" name="article_author" placeholder="Author">
        <input type="text" name="article_description" placeholder="Description">
        <input type="text" name="article_content" placeholder="Content">
        <input type="file" name="article_image">
        <button type="submit" name="save_article">Add Article</button>
    </form>
    <?php 
        foreach ($content_array as $article_data){
            echo "<div id='article-container' data-articleId='{$article_data['id']}'>
                    <div>
                        <img src='./image/{$article_data['image']}' alt='{$article_data['id']}' style='width: 16rem; height: 10rem;'>
                        <h2>Title: {$article_data['title']}</h2>
                        <h3>Author: {$article_data['author']}</h3>
                        <p>Description: {$article_data['description']}</p>
                        <p>{$article_data['content']}</p>
                        <form class='form' method='post'>
                            <input type='hidden' name='article_id' value='{$article_data['id']}' />
                            <button type='submit' name='delete_article'>Delete</button>
                        </form>
                        <button id='edit-button'>Edit</button>
                        <dialog id='edit-dialog-{$article_data['id']}'>
                            <form action='' method='post'>
                                <input type='hidden' name='edit_article_id' value='{$article_data['id']}'>
                                <label>
                                    Title: <input type='text' name='edit_article_title' placeholder='Title' value='{$article_data['title']}'>
                                </label>
                                <label>
                                    Author: <input type='text' name='edit_article_author' placeholder='Author' value='{$article_data['author']}'>
                                </label>
                                <label>
                                    Description: <input type='text' name='edit_article_description' placeholder='Description' value='{$article_data['description']}'>
                                </label>
                                <label>
                                    Content: <input type='text' name='edit_article_content' placeholder='Content' value='{$article_data['content']}'>
                                </label>
                                <label>
                                    Image: <input type='file' name='edit_article_image'>
                                </label>
                                <button type='submit' name='save_edited_article'>Save Article</button>
                            </form>
                        </dialog>
                    </div>
                </div>";}
    ?>
</body>
</html>