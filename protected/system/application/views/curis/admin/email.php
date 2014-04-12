		<div id="content">
		<script language="Javascript">
			function verify(){
				if(document.pressed == "Send")return confirm('Send email message?');
				if(document.pressed == "Save Message Body")return confirm('Save message?');
				return confirm('Reset message to last saved?');
			}
			</script>

				<h3 align="center">Edit/Send Email Message</h3>
				<?php
					if($success != "")
						echo '<p align="center">'.$success.'</p>';
				?>
				<form method="post" action=""  onReset="return verify('Reset to last saved message?')" onSubmit="return verify()">
				<center>
				To: <select name="to">
						<option value="0">All Faculty and Students</option>
						<option value="1">All Faculty</option>
						<option value="2">All Students</option>
						<option value="3">All Applied Students</option>
						<option value="4">All Matched Students</option>
						<option value="5">All Unmatched Students</option>
					</select><br>
				From: <input type="text" name="from" size="25" tabindex="1" value="@stanford.edu"/><br>
				Subject: <input type="text" name="subject" size="25" tabindex="1" value="CURIS"/>
				<textarea style="width: 95%" rows="15" name=text><?php foreach ($text as $entry) echo $entry."\n"; ?></textarea></center>
				<p align="center">
				<input type="submit" name="Action" value="Save Message Body" onClick="document.pressed=this.value"/>
				<input type="submit" name="Action" value="Send" onClick="document.pressed=this.value"/>
				<input type="reset" name="Action" value="Reset" onClick="document.pressed=this.value"/>

				</form>
				</p>
			</div>