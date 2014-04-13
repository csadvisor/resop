			<div id="content">
				<h2 align=center><?=$project->title?></h2>
				<h3 align=center><?=$project->researchfield?><?=($project->secondfield=="")?"":", ".$project->secondfield?><?=($project->thirdfield=="")?"":", ".$project->thirdfield?></h3>
				<table class="table table-striped table-bor">
			            <tr valign="top">
						<td class="h4">Project Website</td>
						<td class=input><?=$project->url?></td>
					</tr>
					<tr valign="top">
						<td class="h4">Professor</td>
						<td class="input"><?
							if ($project->prof_webpage != '') {
								echo "<a href=\"".$project->prof_webpage."\">";
							}
							?><?=$project->prof?></td>
					</tr>
					<tr valign="top">
						<td class="h4">Contact</td>
						<td class="input"><a href="mailto:<?=$project->prof_email?>"><?=$project->prof_email?></td>
					</tr>
					<tr  valign="top">
						<td class="h4">Description</td>
						<td class=input><?=stripslashes($project->description)?></td>
					</tr>
					<!--<tr>
						<td class="h4">Spring Quarter Preparation</td>
						<td class=input><?=stripslashes($project->spring_prep)?></td>
					</tr>-->
					<tr  valign="top">
						<td class="h4">Recommended Background</td>
						<td class=input><?=stripslashes($project->background)?></td>
					</tr>
					<tr  valign="top">
						<td class="h4" width="30%">Eligible Degree Programs</td>
						<td class="input"> <?= ($project->degree_program==0)? "Master's, Undergraduate":""?>
						<?= ($project->degree_program==1)? "Master's":""?>
						<?= ($project->degree_program==2)? "Undergraduate":""?></td>
					</tr>
					<tr  valign="top">
						<td class="h4" width="25%">Available Work Incentives</td>
						<td class="input">
						<?=($project->incentives==0? "None":"")?>
						<?=(($project->incentives & 1)>0 ? "-RA-ship<br/>":"")?>
						<?=(($project->incentives & 2)>0  ? "-Hourly pay<br/>":"")?>
						<?=(($project->incentives & 4)>0 ? "-Credit<br/>":"")?></td>
					</tr>
				</table>
				<?php if($rate_enabled == "1") {?>
				<div style="margin-left:20px;">
				<form method="post" enctype="multipart/form-data" >
		<!--		<TR><TD colspan=2 >&nbsp;</TD></TR>
				<TR><TD colspan=2 >Students - to be considered for a project you need to give it a score:</P>
				
				0 - This project is not up my alley; don't consider me for it.<BR>
				1 - I would be willing to work on this project<BR>
				2 - I like this project<BR>
				3 - I would love to work on this project<BR>
				</TD></TR>
				<TR VALIGN='TOP'> <TD ALIGN='Right' VALIGN='Middle'>
				<b> Your score
				</b></TD>
				<TD ALIGN='Left'><SELECT NAME='score'>
				<OPTION VALUE='0'<?= ($application->score == 0 ? "selected" : "") ?> > 0</OPTION>
				<OPTION VALUE='1'<?= ($application->score == 1 ? "selected" : "") ?> >1</OPTION>
				<OPTION VALUE='2'<?= ($application->score == 2 ? "selected" : "") ?> >2</OPTION>
				<OPTION VALUE='3'<?= ($application->score == 3 ? "selected" : "") ?>>3</OPTION>
				</SELECT><BR>
				</TD></TR>-->

				<p style="font-weight:bold;">To apply to this project please answer the following questions:</p>
				<ul>
				<li>Why are you interested in this project?</li>
				<li>Why do you think you are qualified?</li>
				</ul>
				<div>
				<textarea class="form-control" NAME='statement' style="width:100%;margin-bottom:5px;" MAXLENGTH=2000 rows='10' wrap='VIRTUAL'><?php echo $application->statement; ?></textarea>
				</div>
				<br />
				<div class="text-center">
				  <input class="btn btn-success btn-lg" type='Submit' name='Action' value='Save'>
				  <input class="btn btn-danger btn-lg" type='Submit' name='Action' value='Delete' onClick="return confirm('Are you sure you want to delete your application for this project?')">
				  <!--<input type='reset' value='Reset Form'>-->
				</div>
				</form>
				</div>
				
				<?php } else {?>
				<p>Project Applications are currently disabled by the CURIS Administrator.</p>
				<?php } ?>


			</div>