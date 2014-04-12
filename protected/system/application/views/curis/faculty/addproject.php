			<div id="content">
				<h2>Add a Project</h2>
				<form method="post" action="">
				<table>
					<tr>
						<td class="caption">Project Title</td>
						<td class="input"><input type="text" name="title" size="40" maxlength="100" tabindex=1/></td>
					</tr>
					<tr>
						<td class="caption">Field of Research</td>
						<td class="input">
						<SELECT NAME='researchfield'>
							<OPTION VALUE='other'>Other (enter below)</OPTION><OPTION VALUE='AI'>AI</OPTION><OPTION VALUE='Algorithms'>Algorithms</OPTION><OPTION VALUE='Architecture & Hardware'>Architecture & Hardware</OPTION><OPTION VALUE='BioComputation'>BioComputation</OPTION><OPTION VALUE='Compilers'>Compilers</OPTION><OPTION VALUE='Databases'>Databases</OPTION><OPTION VALUE='Distributed Systems'>Distributed Systems</OPTION><OPTION VALUE='Graphics'>Graphics</OPTION><OPTION VALUE='HCI'>HCI</OPTION><OPTION VALUE='Networking'>Networking</OPTION><OPTION VALUE='Operating Systems'>Operating Systems</OPTION><OPTION VALUE='Programming Languages'>Programming Languages</OPTION><OPTION VALUE='Robotics'>Robotics</OPTION><OPTION VALUE='Scientific Computing'>Scientific Computing</OPTION><OPTION VALUE='Security'>Security</OPTION><OPTION VALUE='Software Engineering'>Software Engineering</OPTION><OPTION VALUE='Theory of Computation'>Theory of Computation</OPTION><OPTION VALUE='Vision'>Vision</OPTION></SELECT><BR>

							<INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=researchfield_typed VALUE='' TABINDEX='2'>
						</td>
					</tr>
					<tr>
						<td class="caption">Secondary Field of Research(optional)</td>
						<td class="input">
						<SELECT NAME='secondfield'>
							<option value=''> </option>
							<OPTION VALUE='other'>Other (enter below)</OPTION><OPTION VALUE='AI'>AI</OPTION><OPTION VALUE='Algorithms'>Algorithms</OPTION><OPTION VALUE='Architecture & Hardware'>Architecture & Hardware</OPTION><OPTION VALUE='BioComputation'>BioComputation</OPTION><OPTION VALUE='Compilers'>Compilers</OPTION><OPTION VALUE='Databases'>Databases</OPTION><OPTION VALUE='Distributed Systems'>Distributed Systems</OPTION><OPTION VALUE='Graphics'>Graphics</OPTION><OPTION VALUE='HCI'>HCI</OPTION><OPTION VALUE='Networking'>Networking</OPTION><OPTION VALUE='Operating Systems'>Operating Systems</OPTION><OPTION VALUE='Programming Languages'>Programming Languages</OPTION><OPTION VALUE='Robotics'>Robotics</OPTION><OPTION VALUE='Scientific Computing'>Scientific Computing</OPTION><OPTION VALUE='Security'>Security</OPTION><OPTION VALUE='Software Engineering'>Software Engineering</OPTION><OPTION VALUE='Theory of Computation'>Theory of Computation</OPTION><OPTION VALUE='Vision'>Vision</OPTION></SELECT><BR>

							<INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=secondfield_typed VALUE='' TABINDEX='2'>
						</td>
					</tr>
					<tr>
						<td class="caption">Third Field of Research(optional)</td>
						<td class="input">
						<SELECT NAME='thirdfield'>
							<option value=''> </option>
							<OPTION VALUE='other'>Other (enter below)</OPTION><OPTION VALUE='AI'>AI</OPTION><OPTION VALUE='Algorithms'>Algorithms</OPTION><OPTION VALUE='Architecture & Hardware'>Architecture & Hardware</OPTION><OPTION VALUE='BioComputation'>BioComputation</OPTION><OPTION VALUE='Compilers'>Compilers</OPTION><OPTION VALUE='Databases'>Databases</OPTION><OPTION VALUE='Distributed Systems'>Distributed Systems</OPTION><OPTION VALUE='Graphics'>Graphics</OPTION><OPTION VALUE='HCI'>HCI</OPTION><OPTION VALUE='Networking'>Networking</OPTION><OPTION VALUE='Operating Systems'>Operating Systems</OPTION><OPTION VALUE='Programming Languages'>Programming Languages</OPTION><OPTION VALUE='Robotics'>Robotics</OPTION><OPTION VALUE='Scientific Computing'>Scientific Computing</OPTION><OPTION VALUE='Security'>Security</OPTION><OPTION VALUE='Software Engineering'>Software Engineering</OPTION><OPTION VALUE='Theory of Computation'>Theory of Computation</OPTION><OPTION VALUE='Vision'>Vision</OPTION></SELECT><BR>

							<INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=thirdfield_typed VALUE='' TABINDEX='2'>
						</td>
					</tr>
					<tr>
						<td class="caption">Project URL</td>
						<td class="input"><INPUT TYPE=text SIZE=50 MAXLENGTH=150 NAME=url VALUE='' TABINDEX='3'></td>
					</tr>
					<tr>
						<td class="caption">Project Description</td>
						<td class="input"><TEXTAREA NAME='description' MAXLENGTH=20000 cols='50' rows='6' wrap='VIRTUAL' tabindex='3'></TEXTAREA>
						</td>
					</tr>
					<tr>
						<td class="caption">Recommended Background</td>
						<td class="input"><TEXTAREA NAME='background' MAXLENGTH=20000 cols='50' rows='3' wrap='VIRTUAL' tabindex='4'></TEXTAREA>
						</td>
					</tr>
					<tr>
						<td class="caption">Eligible Degree Programs</td>
						<td class="input"><input type="radio" name="degree_program" value='2'> Undergraduate |<input type="radio" name="degree_program" value='1'> Master's |
						<input type="radio" name="degree_program" value='0' Checked> Both</td>
					</tr>
					<tr>
						<td class="caption">Available Work Incentives</td>
						<td class="input"><input type="checkbox" name="RAship" value='1'>RA-ship (Master's only) <br/>
						<input type="checkbox" name="hourly" value='2'>Hourly pay </br>
						<input type="checkbox" name="credit" value='4'>Credit</td>
					</tr>
					<tr>
						<td class="caption">Number of Students (for this project)</td>
						<td class="input"><INPUT TYPE=text SIZE=3 MAXLENGTH=9 NAME=capacity VALUE='' TABINDEX='5'>
						</td>
					</tr>
					<tr>
						<td class="caption">Contact Professor</td>
						<td class="input"><INPUT TYPE=text SIZE=40 MAXLENGTH=120 NAME=prof VALUE='<?=$User->name?>' TABINDEX='6'></td>
					</tr>
					<tr>
						<td class="caption">Contact Email</td>
						<td class="input"><INPUT TYPE=text SIZE=40 MAXLENGTH=120 NAME=prof_email VALUE='<?=$User->email?>' TABINDEX='7'>
						</td>
					</tr>
					<tr>
						<td colspan=2 align=center>
						<INPUT TYPE='Submit' NAME='Action' VALUE='Save'><INPUT TYPE='Reset' NAME='Action' VALUE='Reset'>
						</td>
					</tr>
				</table>
				</form>

			</div>