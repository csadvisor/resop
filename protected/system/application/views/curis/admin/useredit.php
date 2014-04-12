			<?php $row = $query->row(); ?>
			
			<div id="content">
				<h2>Edit User</h2>
				<?php if($message != "") echo $message; ?>
				<p align="center">Editing the entry for <?=$row->name?></p>
				<form method=post action="" enctype="multipart/form-data">
				<table width=600 align=center>
					<tr>
						<td class="caption">Name</td>
						<td class="input"><input type="text" name="name" size="40" tabindex="1" value="<?=$row->name?>"/></td>
					</tr>
					<tr>
							<td class="caption">Email</td>
							<td class="input">
								<input TYPE=text SIZE=40 MAXLENGTH=100 NAME=email VALUE='<?=$row->email?>' TABINDEX='2'>
							</td>
						</tr>
						<tr>
							<td class="caption">SUNet ID</td>
							<td class="input">
								<input TYPE=text SIZE=40 MAXLENGTH=100 NAME=sunetid VALUE='<?=$row->sunetid?>' TABINDEX=3'>
							</td>
						</tr>
						<tr>
							<td class="caption">Assistant to... </td>
							<td class="input">
								<input TYPE=text SIZE=40 MAXLENGTH=100 NAME=assistantto VALUE='<?=$row->assistantto?>' TABINDEX=3'>
							</td>
						</tr>
<!--						<tr>
							<td class="caption">Matched?</td>
							<td class="input">
								Yes: <INPUT TYPE=radio NAME=matched  VALUE='1' <?=($row->matched == "1" ? "checked":"")?>> No: <input type=radio name=matched value='0' <?=($row->matched != "1" ? "checked":"")?>>
							</td>
						</tr>-->
						<tr>
							<td class="caption">Administrative Priveleges?</td>
							<td class="input">
								Yes: <INPUT TYPE=radio NAME=admin  VALUE='1' <?=($row->admin == "1" ? "checked":"")?>> No: <input type=radio name=admin value='0' <?=($row->admin != "1" ? "checked":"")?>>
							</td>
						</tr>
						<tr>
							<td class="caption">Webpage</td>
							<td class="input">
								<INPUT TYPE=text SIZE=50 MAXLENGTH=100 NAME=webpage VALUE='<?=$row->webpage?>' TABINDEX='4'>
							</td>
						</tr>
						<tr>
							<td class="caption">Research Interest Area</td>
							<td class="input">
								<INPUT TYPE=text SIZE=50 MAXLENGTH=100 NAME=interestarea VALUE='<?=$row->interestarea?>' TABINDEX='5'>
							</td>
						</tr>
						<tr>
							<td class="caption">Department/Major</td>
							<td class="input">
								<SELECT NAME='major'>
									<OPTION VALUE='other'>other</OPTION>
									<OPTION <?= ($row->major == "CS" ? "selected" : "")?> VALUE='CS'>CS</OPTION>
									<OPTION <?=($row->major == "Symsys" ? "selected" : "")?> VALUE='Symsys'>Symsys</OPTION>
									<OPTION <?=($row->major == "EE" ? "selected" : "")?> VALUE='EE'>EE</OPTION>
									<OPTION <?=($row->major == "MCS" ? "selected" : "")?> VALUE='MCS'>MCS</OPTION>
								</SELECT>
							</td>
							<tr>
								<td class="caption">if other, specify:</td>
								<td class="input"><INPUT TYPE=text SIZE=50 MAXLENGTH=100 NAME=major_typed VALUE='<?=(($row->major !="CS" && $row->major !="Symsys" && $row->major !="EE" && $row->major != "MCS") ? $row->major : "") ?>' TABINDEX='5'></td>
							</tr>
						</tr>
						<tr>
							<td class="caption">GPA in Math/CS Courses</td>
							<td class="input">
								<INPUT TYPE=text SIZE=6 MAXLENGTH=18 NAME=gpa VALUE='<?=$row->gpa?>' TABINDEX='6'>
							</td>
						</tr>
				<!--		<tr>
							<td class="caption">Conferring in June?</td>
							<td class="input">
								Yes: <INPUT TYPE=radio NAME=graduating  VALUE='1' <?=($row->graduating == "1" ? "checked":"")?>> No: <input type=radio name=graduating value='0' <?=($row->graduating != "1" ? "checked":"")?>>
							</td>
						</tr>
						<tr>
							<td class="caption">Declared CS major by March 1?</td>
							<td class="input">
								Yes: <INPUT TYPE=radio NAME=majorwhen  VALUE='1' <?=($row->majorwhen == "1" ? "checked":"")?>> No: <input type=radio name=majorwhen value='0' <?=($row->majorwhen != "1" ? "checked":"")?>>
							</td>
						</tr>
						<tr>
							<td class="caption">CS Coterm?</td>
							<td class="input">
								Yes: <INPUT TYPE=radio NAME=coterm  VALUE='1' <?=($row->coterm == "1" ? "checked":"")?>> No: <input type=radio name=coterm value='0' <?=($row->coterm != "1" ? "checked":"")?>>
							</td>
						</tr>-->
						<tr>
							<td class="caption">Year at Stanford</td>
							<td class="input">
								<INPUT TYPE='RADIO' NAME='year' VALUE='Freshman' <?=($row->year == "Freshman" ? "checked":"")?>>
								Freshman<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Sophomore' <?=($row->year == "Sophomore" ? "checked":"")?>>
								Sophomore<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Junior' <?=($row->year == "Junior" ? "checked":"")?>>
								Junior<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Senior' <?=($row->year == "Senior" ? "checked":"")?>>
								Senior<BR>
								<INPUT TYPE='RADIO' NAME='year' VALUE='Graduate' <?=($row->year == "Graduate" ? "checked":"")?>>
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
								<?php if($row->transcript != ""){ 
									echo "<a href = \"$row->transcript\" target = _blank> View Transcript </a>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td class="caption">Upload Resume</td>
							<td class="input">
								<INPUT TYPE=HIDDEN NAME='MAX_FILE_SIZE' VALUE='' ><INPUT TYPE='file'  NAME=resume>
								<?php if($row->resume != ""){ 
									echo "<a href = \"$row->resume\" target = _blank > View Resume </a>";
									}
								?>
							</td>
						</tr>
						<TR VALIGN='TOP'>
							<TD ALIGN='Center' COLSPAN=2>
								<INPUT TYPE='Submit' NAME='Action' VALUE='Save'>
								<INPUT TYPE='Submit' NAME='Function' VALUE='Delete Profile'>
								<INPUT TYPE='Submit' NAME='Action' VALUE='Cancel/Back'>
							</td>
						</tr>	
				</table>
				</form>
				
			</div>