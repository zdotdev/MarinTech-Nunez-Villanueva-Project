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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            echo "<div id='food-container' data-foodId='{$article_data['id']}'>
                    <div>
                        <img src='' alt='{$article_data['id']}'>
                        <h2>Title: {$article_data['title']}</h2>
                        <h3>Author: {$article_data['author']}</h3>
                        <p>Description: {$article_data['description']}</p>
                        <p>{$article_data['content']}</p>
                        <form class='form' method='post'>
                            <input type='hidden' name='article_id' value='{$article_data['id']}' />
                            <button type='submit' name='delete_article'>Delete</button>
                        </form>
                    </div>
                </div>";}
    ?>
</body>
</html>