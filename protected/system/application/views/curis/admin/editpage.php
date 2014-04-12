		<div id="content">
			<!-- TinyMCE -->
<script type="text/javascript" src="http://cs.stanford.edu/protected/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="http://cs.stanford.edu/protected/js/tiny_mce/curis_config.js">
</script>
<!-- /TinyMCE -->
				<h2>Edit Page</h2>
				<h3 align="center"><?=$view?></h3>
				<?php
					if($success != "")
						echo '<p align="center">'.$success.'</p>';
				?>
				<form method="post" action="">
				<center><textarea style="width: 95%" rows="15" name=html><?=$html?></textarea></center>
				<p align="center"><input type="submit" name="Action" value="Save"/> <input type="reset" name="Action" value="Reset"/></p>
				</form>
			</div>