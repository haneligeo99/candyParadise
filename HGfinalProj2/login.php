<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php
session_start();

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['UPassword'];

    $query = "SELECT * FROM Users WHERE username = ?";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['UPassword'])) {
            $_SESSION['user_id'] = $row['Email'];
            $_SESSION['username'] = $row['username'];
            header('Location: store.html');
            exit();
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Username not found. Please register (<a href='register.php'>Register</a>).";
    }
}

mysqli_close($connection);
?>

<h2>Login</h2>
<div>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="UPassword">Password:</label>
        <input type="password" name="UPassword" required><br>

        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
