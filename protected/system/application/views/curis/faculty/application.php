		<div id="content">
			
			<h2><?=$application->proj_title?></h2>
			
			<table class="table table-striped table-bordered" align="center" >
				<tr>
					<td class="caption">Name</td>
					<td class="input"><?=$user->name?></td>
				</tr>
				<tr>
					<td class="caption">Major</td>
					<td class="input"><?=$user->major?></td>
				</tr>
				<tr>
					<td class="caption">Year</td>
					<td class="input"><?=$user->year?></td>
				</tr>
				<tr>
					<td class="caption">GPA</td>
					<td class="input"><?=$user->gpa?></td>
				</tr>
				<tr>
					<td class="caption">Interest Area</td>
					<td class="input"><?=$user->interestarea?></td>
				</tr>
				<tr>
					<td class="caption">Webpage</td>
					<td class="input"><a href="<?=$user->webpage?>"><?=$user->webpage?></a></td>
				</tr>
				<tr>
					<td class="caption">Email</td>
					<td class="input"><a href="mailto:<?=$user->email?>"><?=$user->email?></a></td>
				</tr>
			<!--	<tr>
					<td class="caption">Will graduate this year?</td>
					<td><?= ($user->graduating == "1")? "Yes" : "No"?></td>
				</tr>
				<tr>
					<td class="caption">Will declare by March 1?</td>
					<td><?= ($user->majorwhen == "1")?"Yes":"No"?></td>
				</tr>
				<tr>
					<td class="caption">Coterm?</td>
					<td><?= ($user->coterm =="1")?"Yes":"No"?></td>
				</tr>
				<tr>
					<td class="caption">Is this project the student's absolute top choice?</td>
					<td><?= ($application->topmatch == "1")?"Yes":"No"?></td>
				</tr>
				<tr>
					<td class="caption">Application Rating</td>
					<td><?=$application->score?></td>
				</tr>-->
				<tr>
					<td class="caption">Application Statement</td>
					<td class="input"><?=$application->statement?></td>
				</tr>
				<tr>
					<td class="caption">Transcript</td>
					<td class="input"><a href="<?=$user->transcript?>" target="_blank"><?=($user->transcript == "") ? "":"Available"?></a></td>
				</tr>
				<tr>
					<td class="caption">Resume</td>
					<td class="input"><a href="<?=$user->resume?>"  target="_blank"><?=($user->resume == "")?"":"Available"?></a></td>
				</tr>
			</table>
			<form method="post" action="">
			<!--	<table>
					<tr>
						<td colspan="2">To have a student be considered for a project you need to provide a score:<p>
          3 - I really want to work with this student<BR>
          2 - This student is qualified and would do fine<BR>
          1 - If no one else is available, this student would do.<BR>
          0 - This student is not to be considered.<BR></TD></TR>
          			<tr>
          				<td class="caption">Score:</td>
          				<?php $app_stage = $this->db->query("SELECT app_stage FROM global_settings LIMIT 1")->row()->app_stage;
          					if($app_stage == 1) $fac_rating = $application->fac_rating1 ;
							else if($app_stage == 2) $fac_rating = $application->fac_rating2 ;
							else  $fac_rating = $application->fac_rating3 ;
							?>
          				<td><select name="score" <?=($rate_enabled !="1"?"disabled":"")?>>
          					<option value='0' <?=($fac_rating == "0")?"selected":""?>>0</option>
          					<option value='1'<?=($fac_rating == "1")?"selected":""?>>1</option>
          					<option value='2'<?=($fac_rating == "2")?"selected":""?>>2</option>
          					<option value='3'<?=($fac_rating == "3")?"selected":""?>>3</option>
          					
          					</select>
          					<input type="hidden" name="stud_id" value="<?=$user->user_id?>"/>
          					<input type="hidden" name="proj_id" value="<?=$application->proj_id?>"/>
          					<input type="hidden" name="prof_id" value="<?=$prof_id?>"/>
          					<?php if(isset($updated)) echo'<br>'.$updated; ?>
          				</td>
          			</tr>
          			<tr>
          				<td colspan="2" align="center"><input type="submit" name="Action" value="Save" <?=($rate_enabled !="1"?"disabled":"")?>> <?=($rate_enabled !="1"?"<br>Rating has been disabled by the ResOp Administrator.":"")?></td>
          			</tr>
          		</table>-->
          	</form>
          	<script language="Javascript">
          	function verify(msg){
          		return confirm(msg);
          	}
          	</script>
          	<form method="post" action="" class="form-horizontal" role="form">
          		<input type="hidden" name="sunetid" value="<?=$user->sunetid?>"/>
          		<input type="hidden" name="proj_id" value="<?=$application->proj_id?>"/>
          		<div class="form-group">
          			<label for="accept_status" class="col-sm-3 control-label">Application Status</label>
          			<div class="col-sm-9">
          				<select name="accept_status" id="accept_status" class="form-control">
          				<option value='0' <?=($application->accept_status=="0")? "selected":""?>>Under Review</option>
          				<option value='1' <?=($application->accept_status=="1")? "selected":""?>>Accepted</option>
          				<option value='2' <?=($application->accept_status=="2")? "selected":""?>>Rejected</option>
          			</select>
          			</div>
          		</div>
          		<div class="form-group">
          			<label for="decision_rational" class="col-sm-3 control-label">Comments (optional)</label>
          			<div class="col-sm-9">
          				<TEXTAREA class="form-control" NAME='decision_rational' id="decision_rational" MAXLENGTH=2000 rows="6"><?=stripslashes($application->rationale)?></TEXTAREA>
          			</div>
          		</div>
          		<input class="btn btn-primary" type="submit" name="Action" value="Save"  <?=($rate_enabled !="1"?"disabled":"")?>
          		</form>


          	</div>