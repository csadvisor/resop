			<div id="content">
				<h2>ResOp Administration</h2>
				<h3 align="center">Current Settings</h3>
				<form method="post" action="">
					<table id="adminsettings" align="center">
						<tr>
							<td><?=(isset($updated))?$updated:""?> </td>
							<td class="button">Enabled</td>
							<td class="button">Disabled</td>
						</tr>
						<tr>
							<td>Landing page login link </td>
							<td class="button"><input name="login_link" type="radio" value="1" <?=($settings->login_link =="1")?"checked":""?>/></td>
							<td class="button"><input name="login_link" type="radio" value="0" <?=($settings->login_link =="0")?"checked":""?>/></td>
						</tr>
						<tr>
							<td>Faculty can add projects</td>
							<td class="button"><input name="fac_edit_proj" type="radio" value="1" <?=($settings->fac_edit_proj =="1")?"checked":""?>/></td>
							<td class="button"><input name="fac_edit_proj" type="radio" value="0" <?=($settings->fac_edit_proj =="0")?"checked":""?>/></td>
						</tr>
						<tr>
							<td>Faculty can assign assistants</td>
							<td class="button"><input name="fac_assn_asst" type="radio" value="1" <?=($settings->fac_assn_asst =="1")?"checked":""?>/></td>
							<td class="button"><input name="fac_assn_asst" type="radio" value="0" <?=($settings->fac_assn_asst =="0")?"checked":""?>/></td>
						</tr>
						<tr>
							<td>Faculty can accept or reject student applications</td>
							<td class="button"><input name="fac_rate_stud" type="radio" value="1" <?=($settings->fac_rate_stud =="1")?"checked":""?>/></td>
							<td class="button"><input name="fac_rate_stud" type="radio" value="0" <?=($settings->fac_rate_stud =="0")?"checked":""?>/></td>
						</tr>
					<!--	<tr>
							<td>Faculty can see matches</td>
							<td class="button"><input name="fac_see_matches" type="radio" value="1" <?=($settings->fac_see_matches =="1")?"checked":""?>/></td>
							<td class="button"><input name="fac_see_matches" type="radio" value="0" <?=($settings->fac_see_matches =="0")?"checked":""?>/></td>
						</tr>-->
						<tr>
							<td>Students can edit profiles</td>
							<td class="button"><input name="stud_edit_prof" type="radio" value="1" <?=($settings->stud_edit_prof =="1")?"checked":""?>/></td>
							<td class="button"><input name="stud_edit_prof" type="radio" value="0" <?=($settings->stud_edit_prof =="0")?"checked":""?>/></td>
						</tr>
						<tr>
							<td>Students can see projects</td>
							<td class="button"><input name="stud_see_proj" type="radio" value="1" <?=($settings->stud_see_proj =="1")?"checked":""?>/></td>
							<td class="button"><input name="stud_see_proj" type="radio" value="0" <?=($settings->stud_see_proj =="0")?"checked":""?>/></td>
						</tr>
						<tr>
							<td>Students can apply for projects</td>
							<td class="button"><input name="stud_apply" type="radio" value="1" <?=($settings->stud_apply =="1")?"checked":""?>/></td>
							<td class="button"><input name="stud_apply" type="radio" value="0" <?=($settings->stud_apply =="0")?"checked":""?>/></td>
						</tr>
					<!--	<tr>
							<td>Students can accept matches</td>
							<td class="button"><input name="stud_accept" type="radio" value="1" <?=($settings->stud_accept =="1")?"checked":""?>/></td>
							<td class="button"><input name="stud_accept" type="radio" value="0" <?=($settings->stud_accept =="0")?"checked":""?>/></td>
						</tr>
						<tr><td> &nbsp;</td></tr>-->
					<!--	<tr>
							<td></td>
							<td class="button">Primary</td>
							<td class="button">Secondary</td>
							<td class="button">Tertiary</td>
						</tr>
						<tr>
							<td >Application Stage</td>
							<td class="button"><input name="app_stage" type="radio" value="1" <?=($settings->app_stage =="1")?"checked":""?> onClick="alert('WARNING, changing the application stage sets all faculty and project capacities to zero.')"/></td>
							<td class="button"><input name="app_stage" type="radio" value="2" <?=($settings->app_stage =="2")?"checked":""?> onClick="alert('WARNING, changing the application stage sets all faculty and project capacities to zero.')"/></td>
							<td class="button"><input name="app_stage" type="radio" value="3" <?=($settings->app_stage =="3")?"checked":""?> onClick="alert('WARNING, changing the application stage sets all faculty and project capacities to zero.')"/></td>
						</tr>-->
						<tr><td> &nbsp;</td></tr>
						<tr>
							<td colspan="3" class="button">
							<input type="submit" name="Action" value="Save"/>
								<input type="reset" value="Reset"/>
								
							</td>
						</tr>
					</table>
				</form>
			</div>