			<div id="content">
			<script language="Javascript">
			function verify(msg){
				return confirm(msg);
			}
			</script>
			
			
			<h2>Housekeeping</h2>
			<?=(isset($result)?"<p><i>".$result."</i></p>":"")?>

			<p><span class="b-red">WARNING: the following actions are irreversible.</span> Please make sure you know what you're doing.</p>
			
			<p>These functions are currently disabled for controller testing - the actual deletion functions will be enabled in the near future.</p>
			<form action="" method="post" onSubmit="return verify('Are you sure you want to archive the database?')">
			<p>Archive the Database <input type="submit" name="Action" value="Archive"></p></form>
			<form action="" method="post" onSubmit="return verify('Are you sure you want to delete all applications?')">
			<p>Delete all student applications <input type="submit" name="Action" value="Delete Apps"></p></form>
			<form action="" method="post" onSubmit="return verify('Are you sure you want to delete all projects?')">
			<p>Delete all projects <input type="submit" name="Action" value="Delete Projects"></p></form>
			<form action="" method="post" onSubmit="return verify('Are you sure you want to delete all professor proxies?')">
			<p>Delete all professors' assistant proxies <input type="submit" name="Action" value="Delete Proxies"></p></form>
			<!--<form action="" method="post" onSubmit="return verify('Are you sure you want to delete all matches?')">
			<p>Delete all student-project matches <input type="submit" name="Action" value="Delete Matches"></p></form>-->
			<form action="" method="post" onSubmit="return verify('Are you sure you want to clear all profiles?')">
			<p>Clear all student profiles <input type="submit" name="Action" value="Clear Profiles"></p></form>
			<form action="" method="post" onSubmit="return verify('Are you sure you want to move all uploads to archive?  This will remove them from the users\' view.')">
			<p>Move all uploads to archive in new directory: <input type="text" name="directory" size = "15" value ="<?=date('Y')?>_Uploads"></input>
			<input type="submit" name="Action" value="Archive Documents"></p></form>
			
			
			</div>