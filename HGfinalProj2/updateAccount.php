<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['newUsername'];
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    $user_id = $_SESSION['user_id'];

    // Update user information in the database
    $updateQuery = "UPDATE Users SET username = ?, UPassword = ? WHERE Email = ?";
    $updateStatement = mysqli_prepare($connection, $updateQuery);
    mysqli_stmt_bind_param($updateStatement, "sss", $newUsername, $newPassword, $user_id);
    $updateResult = mysqli_stmt_execute($updateStatement);

    if ($updateResult) {
        echo "<script>
                alert('Account information updated successfully!');
                window.location.href = 'myAccount.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating account information.');
                window.location.href = 'myAccount.php';
              </script>";
    }
}

mysqli_close($connection);
?>
