<?php 
    session_start(); 
    if(isset($_SESSION['id'])) {
      header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="CSS/register.css">
	<title>Sign up for Huddle</title>
</head>
<body>
  <h1>Join the Huddle family and make new connections today.</h1>
	<form action="/register.php" method="POST" enctype="multipart/form-data">
    <label for="profile_picture" id="label_file"><br>
      <div id="file_box">
        <div class="camera">
          <div class="flash"></div>
          <div class="base"></div>
          <div class="lens1"></div>
          <div class="lens2"></div>
          <div class="point"></div>
        </div>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/png"> <br>
        <span id="imageName"></span>
      </div>
    </label>

    <label for="email">Email:</label><br>
    <input type="email" id="email input" name="email" onkeyup="validate();"><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    
    <label for="confirm_password">Confirm Password:</label><br>
    <input type="password" id="confirm_password" name="confirm_password"><br>
    
    <label for="username">Username:</label><br>
    <input type="text" id="username input" name="username" onkeyup="validate();"><br>
    
    <button type="submit" name="submit" class="btn">Login</button><br>

    <p id="new-member">
      Already a member?<br>
      <a href="login.php">Sign in</a>
    </p>
  </form>
  <?php
    // connect to the database
    include('includes/dbh.inc.php');
      // Check all data has been submitted and is valid
      if (isset($_POST['submit'])) {
        // Check if username is already in use
        $username = $_POST['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($db, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
          echo "<p class='error'>Username already in use</p>";
        } else {
          // Check if passwords match
          $password = $_POST['password'];
          $password_confirm = $_POST['confirm_password'];
          if ($password != $password_confirm) {
            echo "<p class='error'>Passwords do not match</p>";
          } else {
            // Check if email is already in use
            $email = $_POST['email'];
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($db, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
              echo "<p class='error'>Email already in use</p>";
            } else {
              if (isset($_FILES['profile_picture'])) {
  			    // Use default image
  			    $number = rand(1,8);
  			    $default_image = 'default/profile_picture/' . $number . '.png';
  			    $fp = fopen($default_image, 'r');
  			    $content = fread($fp, filesize($default_image));
  			    fclose($fp);
  			} else {
  			    $file = $_FILES['profile_picture'];
  			    $fp = fopen($file['tmp_name'], 'r');
  			    $content = fread($fp, filesize($file['tmp_name']));
  			    fclose($fp);
  			}

  			$blob = addslashes($content);
  			$password = password_hash($password, PASSWORD_DEFAULT);
              // Insert data into database
              $sql = "INSERT INTO user (username, email, password, profile_picture) VALUES ('$username', '$email', '$password', '$blob')";
              mysqli_query($db, $sql);
              header("Location: login.php");
            }
          }
        }
      }
  ?>
</body>
<script>
  let input = document.getElementById("profile_picture");
  let imageName = document.getElementById("imageName");

  function validate() {
    var element = document.getElementById('input');
    element.value = element.value.replace(/[^a-zA-Z0-9@ .]+/,'');
  };

  input.addEventListener("change", ()=>{
    let inputImage = document.querySelector("input[type=file]").files[0];
    imageName.innerText = inputImage.name;
  })
</script>
</html>