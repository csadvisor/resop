			<div id="content">
				<form method="post" action="">
				<p align="center"><input type="submit" name="Action" value="Finalize this selection and send emails"/> </p>
				<p align="center">From: <input type="text" name="from" size="25" tabindex="1" value="@stanford.edu"/></p>
				<p align="center">Note: This may take some time, timeouts are taken to protect the server</p>
				</form>
				<br>
				<p align="center">Email Message Preview:</p>
				<?php
				echo 'TO: leeland@stanford.edu<br>';
				echo 'CC: jane@stanford.edu<br><br>';
				echo'CURIS matching for project: "Project Title"<br>';
				echo 'Student: Leeland Stanford Jr.<br>';
				echo 'Mentor: Jane Stanford<br>';
				echo '<br>';
				echo 'Dear Leeland Stanford Jr.,<br>';
				
				exec("cat matching_code/mesg", $output);
				foreach($output as $entry) {
					echo $entry . '<br>';
				}
				?>
				<br>
				<p align="center">Current Selected Matches:</p>
				<?php
				foreach($text as $entry) {
					echo $entry . '<br>';
				}
				?>

			</div>