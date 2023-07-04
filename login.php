<?php 
    session_start(); 
    if(isset($_SESSION['id'])) {
        header("Location: index.php");
    }
?>
<head>
    <meta charset="utf-8">
    <title>Sign in for Huddle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="login.php" method="POST">
                <h1>Log In to Your Huddle</h1>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" onkeyup="validate();" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="input-group" id="submit">
                    <button type="submit" name="login" class="btn">Login</button>
                </div>
                <p id="new-member">
                    Not a member?<br>
                    <a href="register.php">Register</a>
                </p>
            </form>
            <?php
                session_start();
                // connect to the database
                include('includes/dbh.inc.php');
                // Check all data has been submitted and is valid
                if (isset($_POST['login'])) {
                    // Check if username is already in use
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $sql = "SELECT * FROM user WHERE username = '$username'";
                    $result = mysqli_query($db, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        // Fetch data from database
                        $row = mysqli_fetch_assoc($result);
                        // Check if password is correct
                        if (password_verify($password, $row['password'])) {
                            // Login the user
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['verify'] = $row['verifyed'];
                            $_SESSION['email'] = $row['email'];
                            if ($_SESSION['verify'] == 0) {
                                header("Location: mail.php");
                            } else {
                                header("Location: index.php");
                            }
                        } else {
                            echo "<p class='error'>Incorrect password</p>";
                        }
                    } else {
                        echo "<p class='error'>Username not found</p>";
                    }
                }
            ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    function validate() {
        var element = document.getElementById('username');
        element.value = element.value.replace(/[^A-Za-z0-9_.@-\s]/g, '');
    };
</script>
</html>