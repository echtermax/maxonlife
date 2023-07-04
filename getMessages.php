<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
   include 'includes/dbh.inc.php';
   session_start();
   $fusername = $_GET['user'];
   $username = $_SESSION['username'];
   $query = "SELECT * FROM messages WHERE (sender='$username' AND receiver='$fusername') OR (sender='$fusername' AND receiver='$username') ORDER BY `date` DESC, `time` DESC";
   if ($db) {
      $result = mysqli_query($db, $query);
      while ($row = mysqli_fetch_assoc($result)) {
         $msg_id = $row['id'];
         $cipher = "aes-256-cbc";
         $key = "(RVo77rOvruR&itfuZ8roufV&Rcriif&";
         $iv = base64_decode($row['iv']);
         $tag = NULL;
         $content = $row['content'];
         $content = openssl_decrypt($content, $cipher, $key, $options=0, $iv, $tag);

         if (str_contains($content, "@")) {
            $pos_start = strpos($content, "@");
            $str_length = strpos($content, " ", $pos_start) - $pos_start;
            $at = substr($content, $pos_start, $str_length);
            $user = str_replace("@", "", $at);
            $replace = "<a href=\"profile.php?user=" . $user . "\">" . $at . "</a>";
            $content = str_replace($at, $replace, $content);
            $content = str_replace("@@", "@", $content);
         }

         if ($row["file"] !== NULL) {
            echo '<img id="file" src="data:image/png;base64,' . base64_encode($row["file"]) . '"/>';
         }

         if ($username == $row['sender']) {
            $float = "float: right;";
         } else {
            $float = "float: left;";
            $sql = "UPDATE messages SET gelesen = '1' WHERE id = '$msg_id'";
            mysqli_query($db, $sql);
         }
         echo "<div style='width: 100%'><p style='" . $float . " max-width: 45%;'><strong>" . $row['sender'] . ": </strong>" . $content . "</p></div>";
      }
   } else {
      echo "DB Fehler";
   }
?>
</body>
</html>