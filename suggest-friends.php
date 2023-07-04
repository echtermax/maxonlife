<?php

// Include the database connection file
include_once 'includes/dbh.inc.php';

// Function to find friend suggestions for a given user
function find_friend_suggestions($username) {
    global $db;

    // Retrieve all friends of the given user
    $friends_query = "SELECT fusername FROM friends WHERE username='$username'";
    $friends_result = mysqli_query($db, $friends_query);

    if (mysqli_num_rows($friends_result) > 0) {
        // Loop through each friend and find their potential mutual connections
        $suggestions = array();
        while ($friend_row = mysqli_fetch_assoc($friends_result)) {
            $friend_username = $friend_row['fusername'];

            $mutual_query = "SELECT u.username, u.profile_picture, COUNT(*) AS num_mutual
                             FROM friends f
                             JOIN user u ON u.username = f.username
                             WHERE f.fusername='$friend_username' AND f.username NOT IN (
                                 SELECT fusername
                                 FROM friends
                                 WHERE username='$username'
                             )
                             GROUP BY f.username";
            $mutual_result = mysqli_query($db, $mutual_query);

            if (mysqli_num_rows($mutual_result) > 0) {
                while ($mutual_row = mysqli_fetch_assoc($mutual_result)) {
                    $mutual_username = $mutual_row['username'];
                    $num_mutual = $mutual_row['num_mutual'];
                    $profile_picture = $mutual_row['profile_picture'];

                    // Store the potential mutual connection in an array, incrementing the count if it already exists
                    if (array_key_exists($mutual_username, $suggestions)) {
                        $suggestions[$mutual_username]['count'] += $num_mutual;
                    } else {
                        $suggestions[$mutual_username] = array('count' => $num_mutual, 'profile_picture' => $profile_picture);
                    }
                }
            }
        }

        // Remove the user's own name from the list of suggested friends
        unset($suggestions[$username]);

        // Sort the potential mutual connections by count and echo the top suggestions with the count and profile picture
        arsort($suggestions);
        $i = 0;
        if (empty($suggestions)) {
            echo "<style>.box { display:none;}</style>";
        }
        foreach ($suggestions as $friend => $data) {
            if ($i >= 10) {
                break;
            } elseif ($friend == "") {
                break;
            } elseif ($i == 0) {
                echo "<h2>Maybe You Know...</h2>";
            }

            $profile_picture = base64_encode($data['profile_picture']);
            echo "<div style='display: flex; align-items: center;'>";
            echo "<div style='border: 1px solid black; border-radius: 50%; overflow: hidden; margin-right: 10px;'><img src='data:image/jpeg;base64,$profile_picture' width='50' height='50' alt='$friend'></div>";
            echo "<div><a href='profile.php?user=" . $friend . "' style='color: black; text-decoration: none;'>" . $friend . "</a>(mutual friends: " . $data['count'] . ")</div>";
            echo "</div><br>";
            $i++;
        }
    }
}

// Example usage:
session_start();
$username = $_SESSION['username'];

find_friend_suggestions($username);

?>
