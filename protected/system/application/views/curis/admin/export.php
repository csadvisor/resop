			<div id="content">
			
			<h2>Export Matches</h2>
			<p>Click here to generate a spreadsheet containing all matched students.  The file is in CSV format, and saved as .xls.  When importing into your spreadsheet program, the text delimiter is '"' and the value separator is ','.</p>
			<form action="" method=post>
			<input type="submit" name="Action" value="Generate">
			</form>
			
			<?=(isset($message)?$message:"")?><?=(isset($url)?'<a href="'.$url.'">Spreadsheet</a>':"")?>
			
			</div>