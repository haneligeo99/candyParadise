<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}

// Assuming you have a function to fetch user details from the database
require_once 'db.php';

// Fetch user details based on the user_id in the session
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM Users WHERE Email = ?";
$statement = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($statement, "s", $user_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error or redirect to login page
    header('Location: index.php');
    exit();
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>

<header class="main-header">
    <nav class="main-nav nav">
        <ul>
            <li><a href="myAccount.php">MY ACCOUNT</a></li>
            <li><a href="store.html">STORE</a></li>
            <li><a href="about.html">ABOUT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav><br><br>
    <h1 class="band-name band-name-large">Candy Paradise</h1><br><br>
</header>

<section class="content-section container">
    <h2>My Account</h2>
    <p>Welcome, <?php echo $user['FName'] . ' ' . $user['LName']; ?>!</p>

    <!-- Display user details -->
    <p>Email: <?php echo $user['Email']; ?></p>
    <p>Username: <?php echo $user['username']; ?></p>

    <!-- Form to update user information -->
    <h3>Update Account Information</h3>
    <form action="updateAccount.php" method="post">
        <label for="newUsername">New Username:</label>
        <input type="text" name="newUsername" required><br>

        <label for="newPassword">New Password:&nbsp;</label>
        <input type="password" name="newPassword" required><br><br>

        <input type="submit" value="Update Account">
    </form>

    <!-- Form to delete account -->
    <h3>Delete Account</h3>
    <form action="deleteAccount.php" method="post">
        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
        <input type="submit" value="Delete Account">
    </form><br><br>
</section>

<footer class="main-footer">
    <div class="container main-footer-container">
        <h1 class="band-name">This website was created by <a href="https://haneligeo99.github.io/">Hannah George</a></h1>
        <ul class="nav footer-nav">
            <li>
                <a href="https://github.com/haneligeo99" target="_blank">
                    <img src="Images/github.png">
                </a>
            </li>

            <li>
                <a href="https://www.linkedin.com/in/hannah-george-775a17188" target="_blank">
                    <img src="Images/linkedin.png">
                </a>
            </li>
        </ul>
    </div>
</footer>

</body>
</html>
