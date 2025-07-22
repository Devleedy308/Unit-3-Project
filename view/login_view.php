 <?php include 'header.php'; ?>

<h2>Login</h2>

<form action="../controller/user_controller.php" method="post">
    <input type="hidden" name="action" value="login_user">

    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email" required><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password" required><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account?
    <a href="../controller/user_controller.php?action=show_register">Register here</a>
</p>

<?php include 'footer.php'; ?>
