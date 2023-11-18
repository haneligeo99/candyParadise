<!DOCTYPE html>
<html>
    <head>
        <title>The Generics | Store</title>
        <meta name="description" content="This is the description">
        <link rel="stylesheet" href="styles.css" />
        <script src="store.js" async></script>
    </head>
    <header class="main-header">
            <nav class="nav main-nav">
                <ul>
                    <li><a href="index.html">LOGIN</a></li>
                </ul>
            </nav><br><br>
            <h1 class="band-name band-name-large">Candy Paradise</h1><br><br>
        </header>

    <body>

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once 'db.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fname = $_POST['FName'];
            $lname = $_POST['LName'];
            $email = $_POST['Email'];
            $username = $_POST['username'];
            $password = password_hash($_POST['UPassword'], PASSWORD_DEFAULT);

            // Check if the email is already taken
            $checkQuery = "SELECT * FROM Users WHERE Email = ?";
            $checkStatement = mysqli_prepare($connection, $checkQuery);
            mysqli_stmt_bind_param($checkStatement, "s", $email);
            mysqli_stmt_execute($checkStatement);
            $checkResult = mysqli_stmt_get_result($checkStatement);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "Email already registered. Please choose another email.";
            } else {
                $insertQuery = "INSERT INTO Users (FName, LName, Email, username, UPassword) VALUES (?, ?, ?, ?, ?)";
                $insertStatement = mysqli_prepare($connection, $insertQuery);
                mysqli_stmt_bind_param($insertStatement, "sssss", $fname, $lname, $email, $username, $password);
                $insertResult = mysqli_stmt_execute($insertStatement);


                if ($insertResult) {
                    echo "<script>
                                alert('Registration successful!');
                                window.location.href = 'store.html';
                            </script>";
                } else {
                    echo "Error registering user.". mysqli_error($connection);
                }
            }
        }
        mysqli_close($connection);
        ?>
        <section class="content-section container">

            <h2>Registeration to your Candy Paradise!</h2>
            <p> Fill out the form below and then login after.
            <form action="register.php" method="post">
                <label for="FName">First Name:</label>
                <input type="text" name="FName" required><br>

                <label for="LName">Last Name:</label>
                <input type="text" name="LName" required><br>

                <label for="Email">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="email" name="Email" required><br>

                <label for="username">Username:&nbsp;</label>
                <input type="text" name="username" required><br>

                <label for="UPassword">Password:&nbsp;&nbsp;</label>
                <input type="password" name="UPassword" required><br><br>

                <input type="checkbox" name="agree" required>
                <label for="agree">I agree to recieve emails only pertaining to orders I've made on this website</label><br><br>

                <input type="submit" value="Register">
            </form>
        </section><br><br>


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
