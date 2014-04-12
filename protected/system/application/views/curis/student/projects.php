			<div id="content">
				<h2>Projects</h2>
				<p> <?php if(!isset($projects)) echo 'There are currently no projects.'; else{ ?>
				<form action="" method="post">
				<?php
					if(!isset($prevfield)) $prevfield = "";
					if(!isset($prevprof)) $prevprof = "";
				?>
				<p align="center">Filter by Professor: 
					<select name="faculty">
						<option value="all">All</option>
						<?php foreach ($faculty as $prof): ?>
						<option value="<?=$prof->prof?>" <?=$prof->prof==$prevprof?"selected":""?>><?=$prof->prof?></option>
						<?php endforeach;?>
					</select><br>
					 Filter by Primary Research Field:
					 <select name="field">
					 	<option value="all">All</option>
						<?php foreach ($fields as $field): 
						if($field!=""){ ?>
						<option value="<?=$field?>" <?=$field==$prevfield?"selected":""?>><?=$field?></option>
						<?php } endforeach;?>
					 </select><br>
					<input type="submit" name="Action" value="Filter"/>
					</p>
					</form>
				<?=(count($projects)==0?"There are no projects.":"")?>
				<?php foreach ($projects as $row): ?>
				<table class="projectblurb">
					<tr>
						<td class=caption>Title</td>
						<td class=input><span class="b"><?=$row->title?></span></td>
					</tr>
					<tr>
						<td class=caption>Research Field</td>
						<td class=input><?=$row->researchfield?><?=($row->secondfield=="")?"":", ".$row->secondfield?><?=($row->thirdfield=="")?"":", ".$row->thirdfield?></td>
					</tr>
					<tr>
						<td class=caption>Contact Professor</td>
						<td class=input><?=$row->prof?></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="/resop/protected/index.php/curis/student/projects/<?=$row->proj_id?>">More info</a></td>
					</tr>
				
				</table>
				<?php endforeach;?>
				
				<? } //end no project else ?>
			</div>