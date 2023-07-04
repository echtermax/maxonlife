<?php
	$sql = "SELECT
		CASE WHEN sender = '$username' THEN receiver ELSE sender END as other_user,
		MAX(y.date) as last_date,
		MAX(y.time) as last_time,
		(SELECT m.gelesen FROM messages m WHERE m.date = MAX(y.date) AND m.time = MAX(y.time) AND ((m.sender = '$username' AND m.receiver = other_user) OR (m.sender = other_user AND m.receiver = '$username'))) as is_read,
		(SELECT x.sender FROM messages x WHERE (x.sender = '$username' AND x.receiver = other_user) OR (x.sender = other_user AND x.receiver = '$username') ORDER BY x.date DESC, x.time DESC LIMIT 1) as last_sender,
		(SELECT x.content FROM messages x WHERE (x.sender = '$username' AND x.receiver = other_user) OR (x.sender = other_user AND x.receiver = '$username') ORDER BY x.date DESC, x.time DESC LIMIT 1) as last_content,
		(SELECT x.iv FROM messages x WHERE (x.sender = '$username' AND x.receiver = other_user) OR (x.sender = other_user AND x.receiver = '$username') ORDER BY x.date DESC, x.time DESC LIMIT 1) as last_iv
		FROM messages y
		WHERE y.sender = '$username' OR y.receiver = '$username'
		GROUP BY other_user
		ORDER BY last_date DESC, last_time DESC";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "<br><br>";
		while ($row = mysqli_fetch_assoc($result)) {
			$cipher = "aes-256-cbc";
			$key = "(RVo77rOvruR&itfuZ8roufV&Rcriif&";
			$iv = base64_decode($row['last_iv']);
			$tag = NULL;
			$content = $row['last_content'];
			$content = openssl_decrypt($content, $cipher, $key, $options=0, $iv, $tag);

			echo '<a id="friend-link" href="chat.php?user=' . $row['other_user'] . '"><div id="box"><table>';
				echo "<tr>";
					echo "<td><b>" . $row["other_user"] . "</b></td>";
					echo "<td></td>";
				echo "</tr>";
				echo "<tr>";
					if ($row["last_sender"] == $row["other_user"]) {
						if ($row["is_read"] == 0) {
							echo "<td>" . $content . "</td>";

						} else {
							echo "<td>" . $content . "</td>";
						}
					} else {
						echo "<td>" . $content . "</td>";
					}
					echo "<td id='time'>";
						echo $row['last_date'];
						echo "<br>";
						echo $row['last_time'];
					echo "</td>";
				echo "</tr>";
		    echo '</table></div></a>';
		}
	}