<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Delete user account from the database
    $deleteQuery = "DELETE FROM Users WHERE Email = ?";
    $deleteStatement = mysqli_prepare($connection, $deleteQuery);
    mysqli_stmt_bind_param($deleteStatement, "s", $user_id);
    $deleteResult = mysqli_stmt_execute($deleteStatement);

    if ($deleteResult) {
        // Logout the user after deleting the account
        session_unset();
        session_destroy();
        echo "<script>
                alert('Account deleted successfully!');
                window.location.href = 'index.html';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Error deleting account.');
                window.location.href = 'myAccount.php';
              </script>";
    }
}

mysqli_close($connection);
?>
