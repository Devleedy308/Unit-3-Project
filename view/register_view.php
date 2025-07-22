<?php include 'header.php'; ?>

<h2>Register</h2>

<form action="/controller/user_controller.php" method="post">
    <input type="hidden" name="action" value="register_user">

    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Register</button>
</form>

<?php include 'footer.php'; ?>
