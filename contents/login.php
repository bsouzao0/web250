<?php

$valid_username = "web250user"; 
$valid_password = "LetMeIn!"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['user'] = $username;
        header("Location: index.php?page=budget"); 
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>


<div class="login-container">
    <h2>Login</h2>
    
    <?php if (isset($error_message)): ?>
        <div class="error"><?= $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="?page=login">
        <input type="text" name="username" class="input-field" placeholder="Username" required><br>
        <input type="password" name="password" class="input-field" placeholder="Password" required><br>
        <button type="submit" class="login-button">Login</button>
    </form>
</div>
