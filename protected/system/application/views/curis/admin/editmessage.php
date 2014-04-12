		<div id="content">

				<h3 align="center">Edit Successful Matching Message</h3>
				<?php
					if($success != "")
						echo '<p align="center">'.$success.'</p>';
				?>
				<form method="post" action="">
				<center><textarea style="width: 95%" rows="15" name=text><?php foreach ($text as $entry) echo $entry."\n"; ?></textarea></center>
				<p align="center"><input type="submit" name="Action" value="Save"/> <input type="reset" name="Action" value="Reset"/></p>
				</form>
			</div>