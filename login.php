<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="./js/login.js" async></script>
</head>
<body>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required minlength="6">
        <button type="submit">Login</button>
    </form>
    <p id="message-area"></p>
    <a href="http://localhost/jayson/signup.php">Register?</a>
</body>
</html>