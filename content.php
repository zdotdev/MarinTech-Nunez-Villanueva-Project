<?php
$dataFile = './data/content.xml';
if (file_exists($dataFile)) {
    $contentXML = simplexml_load_file($dataFile) or die("Error: Cannot create object");
} else {
    die("Error: XML file not found");
}
$id = $_GET['id'];
$foundArticle = null;

foreach ($contentXML->$id as $article) { 
    if ((string) $article->id === $id) {
        $foundArticle = $article;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
</head>
<body>
    <?php
    if ($foundArticle!== null) {
        echo("
        <img src='./image/{$foundArticle->image}' alt='{$foundArticle->id}' style='width: 16rem; height: 10rem;'>
        <h2>{$foundArticle->title}</h2>
        <h3>{$foundArticle->author}</h3>
        <p>{$foundArticle->description}</p>
        <p>{$foundArticle->content}</p>
        ");
    } else {
        echo("<p>Article not found.</p>");
    }
   ?>
</body>
</html>
