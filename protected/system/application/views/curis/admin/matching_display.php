			<div id="content">
				<p align="center">Your matching results:</p><br><form method="post" action="">
				<table>
				<?php
				$curMatchNum;
				foreach($text as $entry) {
					if(strstr($entry, 'Total Match(es): ') !=FALSE)
						$curMatchNum = str_replace ('Total Match(es): ','', $entry);
					else if(strstr($entry, '======================================================') != FALSE){
						echo "<br><INPUT TYPE='Submit' NAME='Action' VALUE='Select matching $curMatchNum'><br><br>";
					}
					echo $entry . '<br>';
				}
				?>
				</table>
				</form>

			</div>