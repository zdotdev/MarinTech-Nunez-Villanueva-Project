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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <script src="./js/main.js" async></script>
</head>
<body>
    <?php 
        foreach ($content_array as $article_data){
            echo "<div id='article-container' data-articleId='{$article_data['id']}'>
                    <div id='{$article_data['title']}'>
                        <img src='./image/{$article_data['image']}' alt='{$article_data['id']}' style='width: 16rem; height: 10rem;'>
                        <h2>Title: {$article_data['title']}</h2>
                        <h3>Author: {$article_data['author']}</h3>
                        <p>Description: {$article_data['description']}</p>
                        <p>{$article_data['content']}</p>
                    </div>
                </div>";}
    ?>
    <footer>
        <form action="mailto:nunezjayson09@gmail.com" method="post">
            <input type="hidden" name="message" value="Yoh, mga supot!!!">
            <button type="submit">Contact us</button>
        </form>
    </footer>
</body>
</html>