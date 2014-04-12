			<div id="content">
				<h2>Edit Project</h2>
				<form method="post" action="">
				<table>
					<tr>
						<td class="caption">Project Title</td>
						<td class="input"><input type="text" name="title" size="40" maxlength="100" tabindex=1 value='<?=$project->title?>'/></td>
					</tr>
					<tr>
						<td class="caption">Field of Research</td>
						<td class="input">
						<SELECT NAME='researchfield'>
							<OPTION VALUE='other'>Other (enter below)</OPTION>
							<OPTION VALUE='AI' <?= ($project->researchfield == "AI" ? "selected" : "")?>>AI</OPTION>
							<OPTION VALUE='Algorithms' <?= ($project->researchfield == "Algorithms" ? "selected" : "")?>>Algorithms</OPTION>
							<OPTION VALUE='Architecture & Hardware' <?= ($project->researchfield == "Architechure & Hardware" ? "selected" : "")?>>Architecture & Hardware</OPTION>
							<OPTION VALUE='BioComputation' <?= ($project->researchfield == "BioComputation" ? "selected" : "")?>>BioComputation</OPTION>
							<OPTION VALUE='Compilers' <?= ($project->researchfield == "Compilers" ? "selected" : "")?>>Compilers</OPTION>
							<OPTION VALUE='Databases' <?= ($project->researchfield == "Databases" ? "selected" : "")?>>Databases</OPTION>
							<OPTION VALUE='Distributed Systems' <?= ($project->researchfield == "Distributed Systems" ? "selected" : "")?>>Distributed Systems</OPTION>
							<OPTION VALUE='Graphics' <?= ($project->researchfield == "Graphics" ? "selected" : "")?>>Graphics</OPTION>
							<OPTION VALUE='HCI' <?= ($project->researchfield == "HCI" ? "selected" : "")?>>HCI</OPTION>
							<OPTION VALUE='Networking' <?= ($project->researchfield == "Networking" ? "selected" : "")?>>Networking</OPTION>
							<OPTION VALUE='Operating Systems' <?= ($project->researchfield == "Operating Systems" ? "selected" : "")?>>Operating Systems</OPTION>
							<OPTION VALUE='Programming Languages' <?= ($project->researchfield == "Programming Languages" ? "selected" : "")?>>Programming Languages</OPTION>
							<OPTION VALUE='Robotics' <?= ($project->researchfield == "Robotics" ? "selected" : "")?>>Robotics</OPTION>
							<OPTION VALUE='Scientific Computing' <?= ($project->researchfield == "Scientific Computing" ? "selected" : "")?>>Scientific Computing</OPTION>
							<OPTION VALUE='Security' <?= ($project->researchfield == "Security" ? "selected" : "")?>>Security</OPTION>
							<OPTION VALUE='Software Engineering' <?= ($project->researchfield == "Software Engineering" ? "selected" : "")?>>Software Engineering</OPTION>
							<OPTION VALUE='Theory of Computation'  <?= ($project->researchfield == "Theory of Computation" ? "selected" : "")?>>Theory of Computation</OPTION>
							<OPTION VALUE='Vision' <?= ($project->researchfield == "Vision" ? "selected" : "")?>>Vision</OPTION>
							</SELECT><BR>

							<INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=researchfield_typed VALUE='<?= (($project->researchfield != "AI" && $project->researchfield != "Algorithms" && $project->researchfield != "Architecture & Hardware" && $project->researchfield != "BioComputation" && $project->researchfield != "Compilers" && $project->researchfield != "Databases" && $project->researchfield != "Distributed Systems" && $project->researchfield != "Graphics" && $project->researchfield != "HCI" && $project->researchfield != "Networking" && $project->researchfield != "Operating Systems" && $project->researchfield != "Programming Languages" && $project->researchfield != "Robotics" && $project->researchfield != "Scientific Computing" && $project->researchfield != "Security" && $project->researchfield != "Software Engineering" && $project->researchfield != "Theory of Computation" && $project->researchfield != "Vision") ? $project->researchfield : "")?>' TABINDEX='2'>
						</td>
					</tr>
					<tr>
						<td class="caption">Second Field of Research (optional)</td>
						<td class="input">
						<SELECT NAME='secondfield'>
							<option value=''> </option>
							<OPTION VALUE='other'>Other (enter below)</OPTION>
							<OPTION VALUE='AI' <?= ($project->secondfield == "AI") ? "selected" : ""?>>AI</OPTION>
							<OPTION VALUE='Algorithms' <?= ($project->secondfield == "Algorithms" ? "selected" : "")?>>Algorithms</OPTION>
							<OPTION VALUE='Architecture & Hardware' <?= ($project->secondfield == "Architechure & Hardware" ? "selected" : "")?>>Architecture & Hardware</OPTION>
							<OPTION VALUE='BioComputation' <?= ($project->secondfield == "BioComputation" ? "selected" : "")?>>BioComputation</OPTION>
							<OPTION VALUE='Compilers' <?= ($project->secondfield == "Compilers" ? "selected" : "")?>>Compilers</OPTION>
							<OPTION VALUE='Databases' <?= ($project->secondfield == "Databases" ? "selected" : "")?>>Databases</OPTION>
							<OPTION VALUE='Distributed Systems' <?= ($project->secondfield == "Distributed Systems" ? "selected" : "")?>>Distributed Systems</OPTION>
							<OPTION VALUE='Graphics' <?= ($project->secondfield == "Graphics" ? "selected" : "")?>>Graphics</OPTION>
							<OPTION VALUE='HCI' <?= ($project->secondfield == "HCI" ? "selected" : "")?>>HCI</OPTION>
							<OPTION VALUE='Networking' <?= ($project->secondfield == "Networking" ? "selected" : "")?>>Networking</OPTION>
							<OPTION VALUE='Operating Systems' <?= ($project->secondfield == "Operating Systems" ? "selected" : "")?>>Operating Systems</OPTION>
							<OPTION VALUE='Programming Languages' <?= ($project->secondfield == "Programming Languages" ? "selected" : "")?>>Programming Languages</OPTION>
							<OPTION VALUE='Robotics' <?= ($project->secondfield == "Robotics" ? "selected" : "")?>>Robotics</OPTION>
							<OPTION VALUE='Scientific Computing' <?= ($project->secondfield == "Scientific Computing" ? "selected" : "")?>>Scientific Computing</OPTION>
							<OPTION VALUE='Security' <?= ($project->secondfield == "Security" ? "selected" : "")?>>Security</OPTION>
							<OPTION VALUE='Software Engineering' <?= ($project->secondfield == "Software Engineering" ? "selected" : "")?>>Software Engineering</OPTION>
							<OPTION VALUE='Theory of Computation'  <?= ($project->secondfield == "Theory of Computation" ? "selected" : "")?>>Theory of Computation</OPTION>
							<OPTION VALUE='Vision' <?= ($project->secondfield == "Vision" ? "selected" : "")?>>Vision</OPTION>
							</SELECT><BR>

							<INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=secondfield_typed VALUE='<?= (( $project->secondfield != "AI" && $project->secondfield != "Algorithms" && $project->secondfield != "Architecture & Hardware" && $project->secondfield != "BioComputation" && $project->secondfield != "Compilers" && $project->secondfield != "Databases" && $project->secondfield != "Distributed Systems" && $project->secondfield != "Graphics" && $project->secondfield != "HCI" && $project->secondfield != "Networking" && $project->secondfield != "Operating Systems" && $project->secondfield != "Programming Languages" && $project->secondfield != "Robotics" && $project->secondfield != "Scientific Computing" && $project->secondfield != "Security" && $project->secondfield != "Software Engineering" && $project->secondfield != "Theory of Computation" && $project->secondfield != "Vision") ? $project->secondfield :"")?>' TABINDEX='2'>
						</td>
					</tr>
					<tr>
						<td class="caption">Third Field of Research (optional)</td>
						<td class="input">
						<SELECT NAME='thirdfield'>
							<option value=""> </option>
							<OPTION VALUE='other'>Other (enter below)</OPTION>
							<OPTION VALUE='AI' <?= ($project->thirdfield == "AI" ? "selected" : "")?>>AI</OPTION>
							<OPTION VALUE='Algorithms' <?= ($project->thirdfield == "Algorithms" ? "selected" : "")?>>Algorithms</OPTION>
							<OPTION VALUE='Architecture & Hardware' <?= ($project->thirdfield == "Architechure & Hardware" ? "selected" : "")?>>Architecture & Hardware</OPTION>
							<OPTION VALUE='BioComputation' <?= ($project->thirdfield == "BioComputation" ? "selected" : "")?>>BioComputation</OPTION>
							<OPTION VALUE='Compilers' <?= ($project->researchfield == "Compilers" ? "selected" : "")?>>Compilers</OPTION>
							<OPTION VALUE='Databases' <?= ($project->thirdfield == "Databases" ? "selected" : "")?>>Databases</OPTION>
							<OPTION VALUE='Distributed Systems' <?= ($project->thirdfield == "Distributed Systems" ? "selected" : "")?>>Distributed Systems</OPTION>
							<OPTION VALUE='Graphics' <?= ($project->thirdfield == "Graphics" ? "selected" : "")?>>Graphics</OPTION>
							<OPTION VALUE='HCI' <?= ($project->thirdfield == "HCI" ? "selected" : "")?>>HCI</OPTION>
							<OPTION VALUE='Networking' <?= ($project->thirdfield == "Networking" ? "selected" : "")?>>Networking</OPTION>
							<OPTION VALUE='Operating Systems' <?= ($project->thirdfield == "Operating Systems" ? "selected" : "")?>>Operating Systems</OPTION>
							<OPTION VALUE='Programming Languages' <?= ($project->thirdfield == "Programming Languages" ? "selected" : "")?>>Programming Languages</OPTION>
							<OPTION VALUE='Robotics' <?= ($project->thirdfield == "Robotics" ? "selected" : "")?>>Robotics</OPTION>
							<OPTION VALUE='Scientific Computing' <?= ($project->thirdfield == "Scientific Computing" ? "selected" : "")?>>Scientific Computing</OPTION>
							<OPTION VALUE='Security' <?= ($project->thirdfield == "Security" ? "selected" : "")?>>Security</OPTION>
							<OPTION VALUE='Software Engineering' <?= ($project->thirdfield == "Software Engineering" ? "selected" : "")?>>Software Engineering</OPTION>
							<OPTION VALUE='Theory of Computation'  <?= ($project->thirdfield == "Theory of Computation" ? "selected" : "")?>>Theory of Computation</OPTION>
							<OPTION VALUE='Vision' <?= ($project->thirdfield == "Vision" ? "selected" : "")?>>Vision</OPTION>
							</SELECT><BR>

							<INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=thirdfield_typed VALUE='<?= ((
							$project->thirdfield != "AI" && 
							$project->thirdfield != "Algorithms" && 
							$project->thirdfield != "Architecture & Hardware" && 
							$project->thirdfield != "BioComputation" && 
							$project->thirdfield != "Compilers" && 
							$project->thirdfield != "Databases" && 
							$project->thirdfield != "Distributed Systems" && 
							$project->thirdfield != "Graphics" && 
							$project->thirdfield != "HCI" && 
							$project->thirdfield != "Networking" && 
							$project->thirdfield != "Operating Systems" && 
							$project->thirdfield != "Programming Languages" && 
							$project->thirdfield != "Robotics" && 
							$project->thirdfield != "Scientific Computing" && 
							$project->thirdfield != "Security" && 
							$project->thirdfield != "Software Engineering" && 
							$project->thirdfield != "Theory of Computation" && 
							$project->thirdfield != "Vision") ? $project->thirdfield :"" )?>' TABINDEX='2'>
						</td>
					</tr>
					<tr>
						<td class="caption">Project URL</td>
						<td class="input"><INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=url VALUE='<?=$project->url?>' TABINDEX='3'></td>
					</tr>
					<tr>
						<td class="caption">Project Description</td>
						<td class="input"><TEXTAREA NAME='description' MAXLENGTH=20000 cols='50' rows='6' wrap='VIRTUAL' tabindex='3'><?=stripslashes($project->description)?></TEXTAREA>
						</td>
					</tr>
					<tr>
						<td class="caption">Recommended Background</td>
						<td class="input"><TEXTAREA NAME='background' MAXLENGTH=20000 cols='50' rows='3' wrap='VIRTUAL' tabindex='4'><?=stripslashes($project->background)?></TEXTAREA>
						</td>
					</tr>
					<tr>
						<td class="caption">Eligible Degree Programs</td>
						<td class="input"><input type="radio" name="degree_program" value='2' <?=($project->degree_program=="2"?"Checked":"")?>> Undergraduate |
						<input type="radio" name="degree_program" value='1' <?=($project->degree_program=="1"?"Checked":"")?>> Master's |
						<input type="radio" name="degree_program" value='0' <?=($project->degree_program=="0"?"Checked":"")?>> Both</td>
					</tr>
					<tr>
						<td class="caption">Available Work Incentives</td>
						<td class="input"><input type="checkbox" name="RAship" value='1'
						<?=(($project->incentives & 1)>0 ? "Checked":"")?>>RA-ship (Master's only) <br/>
						<input type="checkbox" name="hourly" value='2'
						<?=(($project->incentives & 2)>0  ? "Checked":"")?>>Hourly pay </br>
						<input type="checkbox" name="credit" value='4'
						<?=(($project->incentives & 4)>0 ? "Checked":"")?>>Credit</td>
					</tr>
					<tr>
						<td class="caption">Number of Students (for this project)</td>
						<td class="input"><INPUT TYPE=text SIZE=3 MAXLENGTH=9 NAME=capacity VALUE='<?=$project->capacity?>' TABINDEX='5'>
						</td>
					</tr>
					<tr>
						<td class="caption">Contact Professor</td>
						<td class="input"><INPUT TYPE=text SIZE=40 MAXLENGTH=120 NAME=prof VALUE='<?=$project->prof?>' TABINDEX='6'></td>
					</tr>
					<tr>
						<td class="caption">Contact Email</td>
						<td class="input"><INPUT TYPE=text SIZE=40 MAXLENGTH=120 NAME=prof_email VALUE='<?=$project->prof_email?>' TABINDEX='7'>
						</td>
					</tr>
					<!--<tr>
						<td class="caption">Spring Quarter Preparation</td>
						<td class="input"><TEXTAREA NAME='spring_prep' MAXLENGTH=1000 cols='50' rows='3' wrap='VIRTUAL' tabindex='8'><?=stripslashes($project->spring_prep)?></TEXTAREA>
						</td>
					</tr>-->
					<tr>
						<td colspan=2 align=center>
						<INPUT TYPE='Submit' NAME='Action' VALUE='Save'>
						<input type="Submit" name="Action" value="Delete"  onClick="return confirm('Are you sure you want to delete this project?')">
					 	<INPUT TYPE='Reset' NAME='Action' VALUE='Reset'>
						</td>
					</tr>
				</table>
				</form>

			</div>