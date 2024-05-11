<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="./js/signup.js" async></script>
</head>
<body>
    <form action="signup.php" method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required minlength="6">
        <button type="submit">Sign up</button>
    </form>
    <p id="message-area"></p>
    <a href="http://localhost/jayson/login.php">Login?</a>
</body>
</html>