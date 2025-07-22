<?php include 'header.php'; ?>

<h2>Login</h2>

<form action="/controller/user_controller.php" method="post">
    <input type="hidden" name="action" value="login_user">
    
    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>

<?php include 'footer.php'; ?>