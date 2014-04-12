<div id="sidebar">
	<h3 style="margin-bottom:10px">Navigation</h3>
	<ul>
		<?php 
		foreach($links as $name => $link){
			echo "<li><a href =\"".$link."\">".$name ."</a></li>";
		}
		?>
	</ul>
</div>