			<div id="content">
			
			<script language="Javascript">
			function validate(){
					return confirm("Are you sure you want to delete your application for this project?");
			}
			</script>
			
				<h2>Applications</h2>
				<p><i><?= isset($message)?"$message":""?></i></p>
				<p> <?php if(count($app) == 0) echo 'You currently have no applications.'; else{ ?>
				
				<?php foreach ($app as $row): ?>
				<table class="projectblurb">
					<tr>
						<td class=caption>Project Title:</td>
						<td class=input><span class="b"><?=$row->proj_title?></span></td>
					</tr>
					<tr>
						<td class=caption>Professor:</td>
						<td class=input><span class="b"><?=$row->proj_prof?></span></td>
					</tr>
					<tr>
					<tr>
						<td class=caption>Statement:</td>
						<td class=input><?=$row->statement?></td>
					</tr>
					<tr>
						<td class="caption">Status:</td>
						<td class="input"><?php if ($row->accept_status==1) echo '<span class="accept">Accepted</span>';
							if ($row->accept_status==2) echo '<span class="reject">Not Selected</span>';
							if ($row->accept_status==0) echo 'Under Review'?>
						</td>
					</tr>
					<?php if($row->rationale !="") echo '
					<tr>
						<td class="caption">Comments:</td>
						<td class="input">'.$row->rationale.'</td>
					</tr>'?>
					<!--<tr>
						<td class=caption>Score</td>
						<td class=input><span class="b"><?=$row->score?></span></td>
					</tr>-->
					<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr>
						<td style="font-size:13px;" colspan="2" align="center"><a href="/resop/protected/index.php/curis/student/projects/<?=$row->proj_id?>">View Project</a></td>
					</tr>
					<tr>
						<form method="post" action="" onSubmit="return validate()">
						<input type="hidden" name="app_id" value="<?=$row->app_id?>" />
						<td colspan="2" align="center"><input type='Submit' name='Action' value='Delete application'></td>
						</form>
					</tr>
				
				</table>
		
				<?php endforeach;?>
				
				<? } //end no project else ?>
			</div>