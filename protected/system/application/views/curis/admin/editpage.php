<div id="content">
	<!-- TinyMCE -->
	<script type="text/javascript" src="http://cs.stanford.edu/protected/js/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="http://cs.stanford.edu/protected/js/tiny_mce/curis_config.js"></script>
	<!-- /TinyMCE -->
	<h2>Edit Page</h2>
	<h3 align="center"><?=str_replace(".", " ", ucfirst($page))?></h3>
	<?php
		if($success != "")
			echo '<p align="center">'.$success.'</p>';
	?>
	<form method="post" action="" role="form">
	<center><textarea class="form-control" style="width: 95%" rows="15" name=html><?=$edithtml?></textarea></center>
	<p align="center"><br /><input class="btn btn-primary" type="submit" name="Action" value="Save"/> <input class="btn btn-primary" type="reset" name="Action" value="Reset"/></p>
	</form>
</div>