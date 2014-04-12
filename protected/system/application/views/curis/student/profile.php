			<div id="content">
				
			<script language="Javascript">
			function validate(){
					return confirm("Are you sure you want to delete your profile?  A completed profile is required for all ResOp applications.");
			}
			</script>
				<h2>Your Profile</h2>
				<p><?php if($message != "") echo $message; ?> In order to be considered for projects, you must fill out the following profile information:</p>
				<form method="post" enctype="multipart/form-data" >
					<table>
						<tr>
							<td class="caption">Your Name</td>
							<td class="input"><input type="text" name="name" size="40" tabindex="1" value="<?=$User->name?>"/></td>
						</tr>
						<tr>
							<td class="caption">Your preferred Email</td>
							<td class="input">
								<input TYPE=text SIZE=40 MAXLENGTH=100 NAME=email VALUE='<?=$User->email?>' TABINDEX='2'>
							</td>
						</tr>
						<tr>
							<td class="caption">Webpage (if you have one)</td>
							<td class="input">
								<INPUT TYPE=text SIZE=50 MAXLENGTH=100 NAME=webpage VALUE='<?=$User->webpage?>' TABINDEX='3'>
							</td>
						</tr>
						<tr>
							<td class="caption">Research Interest Area</td>
							<td class="input">
								<INPUT TYPE=text SIZE=50 MAXLENGTH=100 NAME=interestarea VALUE='<?=$User->interestarea?>' TABINDEX='4'>
							</td>
						</tr>
						<tr>
							<td class="caption">Department/major</td>
							<td class="input">
								<SELECT NAME='major'>
									<OPTION <?= ($User->major == "CS" ? "selected" : "")?> VALUE='CS'>CS</OPTION>
									<OPTION <?=($User->major == "EE" ? "selected" : "")?> VALUE='EE'>EE</OPTION>
									<OPTION <?=($User->major == "MCS" ? "selected" : "")?> VALUE='MCS'>MCS</OPTION>
									<OPTION <?=($User->major == "Symsys" ? "selected" : "")?> VALUE='Symsys'>Symsys</OPTION>
									<OPTION <?=($User->major == "BMC" ? "selected" : "")?> VALUE='BMC'>BMC</OPTION>
									<OPTION VALUE='other'>other</OPTION>
								</SELECT>
							</td>
						</tr>
						<tr>
							<td class="caption">if other, specify:</td>
							<td><INPUT TYPE=text SIZE=50 MAXLENGTH=100 NAME=major_typed VALUE='<?=(($User->major !="CS" && $User->major !="Symsys" && $User->major !="EE" && $User->major != "MCS" && $User->major != "BMC") ? $User->major : "") ?>' TABINDEX='5'></td>
						</tr>
						<tr>
							<td class="caption">GPA in Math/CS Courses</td>
							<td class="input">
								<INPUT TYPE=text SIZE=6 MAXLENGTH=18 NAME=gpa VALUE='<?=$User->gpa?>' TABINDEX='6'>
							</td>
						</tr>
<!--				<tr>
							<td class="caption">Will you be getting your degree this coming June?</td>
						<td class="input">
								Yes: <INPUT TYPE=radio NAME=graduating  VALUE='1' <?=($User->graduating == "1" ? "checked":"")?>> No: <input type=radio name=graduating value='0' <?=($User->graduating != "1" ? "checked":"")?>>
							</td>
						</tr>
						<tr>
							<td class="caption">Will you be a declared CS major by March 1?</td>
							<td class="input">
								Yes: <INPUT TYPE=radio NAME=majorwhen  VALUE='1' <?=($User->majorwhen == "1" ? "checked":"")?>> No: <input type=radio name=majorwhen value='0' <?=($User->majorwhen != "1" ? "checked":"")?>>
							</td>
						</tr>
						<tr>
							<td class="caption">CS Coterm?</td>
							<td class="input">
								Yes: <INPUT TYPE=radio NAME=coterm  VALUE='1' <?=($User->coterm == "1" ? "checked":"")?>> No: <input type=radio name=coterm value='0' <?=($User->coterm != "1" ? "checked":"")?>>
							</td>
						</tr>-->
						<tr>
							<td class="caption">Year at Stanford</td>
							<td class="input">
								<INPUT TYPE='RADIO' NAME='year' VALUE='Freshman' <?=($User->year == "Freshman" ? "checked":"")?>>
								Freshman<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Sophomore' <?=($User->year == "Sophomore" ? "checked":"")?>>
								Sophomore<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Junior' <?=($User->year == "Junior" ? "checked":"")?>>
								Junior<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Senior' <?=($User->year == "Senior" ? "checked":"")?>>
								Senior<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Graduate' <?=($User->year == "Graduate" ? "checked":"")?>>
								Graduate<BR>
							</td>
						</tr>
						<tr>
							<TD align='center' valign='bottom' colspan=2><font color='#9c0000'><H3>All uploads <i>must</i> be PDF or TXT files!</H3></font>
							</td>
						</tr>
						<tr>
							<td class="caption">Upload Transcript</td>
							<td class="input">
								<INPUT TYPE=HIDDEN NAME='MAX_FILE_SIZE' VALUE='' ><INPUT TYPE='file'  NAME=transcript>
								<?php if($User->transcript != ""){ 
									echo "<a href = \"$User->transcript\" target = _blank> View Transcript </a>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td class="caption">Upload Resume</td>
							<td class="input">
								<INPUT TYPE=HIDDEN NAME='MAX_FILE_SIZE' VALUE='' ><INPUT TYPE='file'  NAME=resume>
								<?php if($User->resume != ""){ 
									echo "<a href = \"$User->resume\" target = _blank > View Resume </a>";
									}
								?>
							</td>
						</tr>
						<TR VALIGN='TOP'>
							<TD ALIGN='Center' COLSPAN=2>
								<INPUT TYPE='Submit' NAME='Action' VALUE='Save' <?=($enabled !="1"?"disabled":"")?>> <input type="submit" Name='Action' value="Delete" <?=($enabled!="1"?"disabled":"")?> onClick="return validate()"> 
								<INPUT TYPE='reset' VALUE='Reset'> <?=($enabled !="1"?"<br>Updating student profiles has been disabled by the CURIS Administrator.":"")?>
							</td>
						</tr>	
					</table>
				</form>
			</div>