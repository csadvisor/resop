<div id="content">
	<h1 class="page-header text-center">Edit Project</h1>
	<form method="post" action="" role="form" class="form-horizontal">
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">Project Title</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="title" id="title" maxlength="100" value="<?=$project->title?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="researchfield" class="col-sm-3 control-label">Research Field 1</label>
			<div class="col-sm-8">
				<SELECT NAME='researchfield' id="researchfield">
					<OPTION VALUE='other'>Other (enter in adjacent field)</OPTION>
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
				</SELECT>

				<INPUT class="pull-right" TYPE=text SIZE=50 MAXLENGTH=150 NAME=researchfield_typed VALUE='<?= (($project->researchfield != "AI" && $project->researchfield != "Algorithms" && $project->researchfield != "Architecture & Hardware" && $project->researchfield != "BioComputation" && $project->researchfield != "Compilers" && $project->researchfield != "Databases" && $project->researchfield != "Distributed Systems" && $project->researchfield != "Graphics" && $project->researchfield != "HCI" && $project->researchfield != "Networking" && $project->researchfield != "Operating Systems" && $project->researchfield != "Programming Languages" && $project->researchfield != "Robotics" && $project->researchfield != "Scientific Computing" && $project->researchfield != "Security" && $project->researchfield != "Software Engineering" && $project->researchfield != "Theory of Computation" && $project->researchfield != "Vision") ? $project->researchfield : "")?>' TABINDEX='2'>
			</div>
		</div>
		<div class="form-group">
			<label for="secondfield" class="col-sm-3 control-label">Research Field 2</label>
			<div class="col-sm-8">
				<SELECT NAME='secondfield' id="secondfield">
					<OPTION VALUE='other'>Other (enter in adjacent field)</OPTION>
					<OPTION VALUE='AI' <?= ($project->secondfield == "AI" ? "selected" : "")?>>AI</OPTION>
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
				</SELECT>

				<INPUT class="pull-right" TYPE=text SIZE=50 MAXLENGTH=150 NAME=secondfield_typed VALUE='<?= (($project->secondfield != "AI" && $project->secondfield != "Algorithms" && $project->secondfield != "Architecture & Hardware" && $project->secondfield != "BioComputation" && $project->secondfield != "Compilers" && $project->secondfield != "Databases" && $project->secondfield != "Distributed Systems" && $project->secondfield != "Graphics" && $project->secondfield != "HCI" && $project->secondfield != "Networking" && $project->secondfield != "Operating Systems" && $project->secondfield != "Programming Languages" && $project->secondfield != "Robotics" && $project->secondfield != "Scientific Computing" && $project->secondfield != "Security" && $project->secondfield != "Software Engineering" && $project->secondfield != "Theory of Computation" && $project->secondfield != "Vision") ? $project->secondfield : "")?>' TABINDEX='2'>
			</div>
		</div>
		<div class="form-group">
			<label for="thirdfield" class="col-sm-3 control-label">Research Field 2</label>
			<div class="col-sm-8">
				<SELECT NAME='thirdfield' id="thirdfield">
					<OPTION VALUE='other'>Other (enter in adjacent field)</OPTION>
					<OPTION VALUE='AI' <?= ($project->thirdfield == "AI" ? "selected" : "")?>>AI</OPTION>
					<OPTION VALUE='Algorithms' <?= ($project->thirdfield == "Algorithms" ? "selected" : "")?>>Algorithms</OPTION>
					<OPTION VALUE='Architecture & Hardware' <?= ($project->thirdfield == "Architechure & Hardware" ? "selected" : "")?>>Architecture & Hardware</OPTION>
					<OPTION VALUE='BioComputation' <?= ($project->thirdfield == "BioComputation" ? "selected" : "")?>>BioComputation</OPTION>
					<OPTION VALUE='Compilers' <?= ($project->thirdfield == "Compilers" ? "selected" : "")?>>Compilers</OPTION>
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
				</SELECT>

				<INPUT class="pull-right" TYPE=text SIZE=50 MAXLENGTH=150 NAME=thirdfield_typed VALUE='<?= (($project->thirdfield != "AI" && $project->thirdfield != "Algorithms" && $project->thirdfield != "Architecture & Hardware" && $project->thirdfield != "BioComputation" && $project->thirdfield != "Compilers" && $project->thirdfield != "Databases" && $project->thirdfield != "Distributed Systems" && $project->thirdfield != "Graphics" && $project->thirdfield != "HCI" && $project->thirdfield != "Networking" && $project->thirdfield != "Operating Systems" && $project->thirdfield != "Programming Languages" && $project->thirdfield != "Robotics" && $project->thirdfield != "Scientific Computing" && $project->thirdfield != "Security" && $project->thirdfield != "Software Engineering" && $project->thirdfield != "Theory of Computation" && $project->thirdfield != "Vision") ? $project->thirdfield : "")?>' TABINDEX='2'>
			</div>
		</div>
		<div class="form-group">
			<label for="url" class="col-sm-3 control-label">Project URL</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="url" id="url" maxlength="100" value="<?=$project->url?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="description" class="col-sm-3 control-label">Description</label>
			<div class="col-sm-8">
				<textarea class="form-control" name="description" id="description" maxlength="100"><?=stripslashes($project->description)?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="background" class="col-sm-3 control-label">Recommended Background</label>
			<div class="col-sm-8">
				<textarea class="form-control" name="background" id="background" maxlength="100"><?=stripslashes($project->background)?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="degree_program" class="col-sm-3 control-label">Eligible Degrees</label>
			<div class="col-sm-8">
				<div id="degree_program">
					<div class="radio">
						<label>
							<input type="radio" name="degree_program" value="2" <?=($project->degree_program=="2"?"Checked":"")?>>
							Undergraduate
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="degree_program" value="1" <?=($project->degree_program=="1"?"Checked":"")?>>
							Masters
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="degree_program" value="0" <?=($project->degree_program=="0"?"Checked":"")?>>
							Both
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="incentives" class="col-sm-3 control-label">Available Incentives</label>
			<div class="col-sm-8">
				<div id="incentives">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="RAship" value="1" <?=(($project->incentives & 1)>0 ? "Checked":"")?>>
							RA-ship (Master's only)
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="hourly" value="2" <?=(($project->incentives & 2)>0 ? "Checked":"")?>>
							Hourly pay
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="credit" value="4" <?=(($project->incentives & 4)>0 ? "Checked":"")?>>
							Credit
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="capacity" class="col-sm-3 control-label"># Students</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="capacity" id="capacity" maxlength="100" maxlength="9" value="<?=$project->capacity?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="prof" class="col-sm-3 control-label">Professor</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="prof" id="prof" maxlength="100" maxlength="9" value="<?=$project->prof?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="prof_email" class="col-sm-3 control-label">Professor Email</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="prof_email" id="prof_email" maxlength="100" maxlength="9" value="<?=$project->prof_email?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="prof_webpage" class="col-sm-3 control-label">Professor Webpage</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="prof_webpage" id="prof_webpage" maxlength="100" maxlength="9" value="<?=$project->prof_webpage?>" />
			</div>
		</div>
		<div class="text-center">
			<INPUT class="btn btn-primary" TYPE='Submit' NAME='Action' VALUE='Save' />
			<input class="btn btn-primary" type="Submit" name="Action" value="Delete"  onClick="return confirm('Are you sure you want to delete this project?')" />
			<INPUT class="btn btn-primary" TYPE='Reset' NAME='Action' VALUE='Reset'>
		</div>

	</form>

</div>