<div id="content">
	<h1 class="page-header text-center">Add Project</h1>
	<form method="post" action="" role="form" class="form-horizontal">
		<div class="form-group">
			<label for="title" class="col-sm-4 control-label">Project Title</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="title" id="title" maxlength="100" />
			</div>
		</div>
		<div class="form-group">
			<label for="researchfield" class="col-sm-4 control-label">Research Field 1</label>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-6">
						<SELECT class="form-control" NAME='researchfield' id="researchfield">
							<OPTION VALUE='other'>Other (enter in adjacent field)</OPTION><OPTION VALUE='AI'>AI</OPTION><OPTION VALUE='Algorithms'>Algorithms</OPTION><OPTION VALUE='Architecture & Hardware'>Architecture & Hardware</OPTION><OPTION VALUE='BioComputation'>BioComputation</OPTION><OPTION VALUE='Compilers'>Compilers</OPTION><OPTION VALUE='Databases'>Databases</OPTION><OPTION VALUE='Distributed Systems'>Distributed Systems</OPTION><OPTION VALUE='Graphics'>Graphics</OPTION><OPTION VALUE='HCI'>HCI</OPTION><OPTION VALUE='Networking'>Networking</OPTION><OPTION VALUE='Operating Systems'>Operating Systems</OPTION><OPTION VALUE='Programming Languages'>Programming Languages</OPTION><OPTION VALUE='Robotics'>Robotics</OPTION><OPTION VALUE='Scientific Computing'>Scientific Computing</OPTION><OPTION VALUE='Security'>Security</OPTION><OPTION VALUE='Software Engineering'>Software Engineering</OPTION><OPTION VALUE='Theory of Computation'>Theory of Computation</OPTION><OPTION VALUE='Vision'>Vision</OPTION>
						</SELECT>
					</div>

					<div class="col-sm-6"><INPUT class="pull-right form-control" TYPE=text SIZE=50 MAXLENGTH=150 NAME=researchfield_typed VALUE='' TABINDEX='2'></div>
				</div></div>
		</div>
		<div class="form-group">
			<label for="secondfield" class="col-sm-4 control-label">Research Field 2 (optional)</label>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-6">
						<SELECT class="form-control" NAME='secondfield' id="secondfield">
							<OPTION VALUE='other'>Other (enter in adjacent field)</OPTION><OPTION VALUE='AI'>AI</OPTION><OPTION VALUE='Algorithms'>Algorithms</OPTION><OPTION VALUE='Architecture & Hardware'>Architecture & Hardware</OPTION><OPTION VALUE='BioComputation'>BioComputation</OPTION><OPTION VALUE='Compilers'>Compilers</OPTION><OPTION VALUE='Databases'>Databases</OPTION><OPTION VALUE='Distributed Systems'>Distributed Systems</OPTION><OPTION VALUE='Graphics'>Graphics</OPTION><OPTION VALUE='HCI'>HCI</OPTION><OPTION VALUE='Networking'>Networking</OPTION><OPTION VALUE='Operating Systems'>Operating Systems</OPTION><OPTION VALUE='Programming Languages'>Programming Languages</OPTION><OPTION VALUE='Robotics'>Robotics</OPTION><OPTION VALUE='Scientific Computing'>Scientific Computing</OPTION><OPTION VALUE='Security'>Security</OPTION><OPTION VALUE='Software Engineering'>Software Engineering</OPTION><OPTION VALUE='Theory of Computation'>Theory of Computation</OPTION><OPTION VALUE='Vision'>Vision</OPTION>
						</SELECT>
					</div>

					<div class="col-sm-6"><INPUT class="pull-right form-control" TYPE=text SIZE=50 MAXLENGTH=150 NAME=secondfield_typed VALUE='' TABINDEX='2'></div>
				</div></div>
		</div>
		<div class="form-group">
			<label for="thirdfield" class="col-sm-4 control-label">Research Field 3 (optional)</label>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-6">
						<SELECT class="form-control" NAME='thirdfield' id="thirdfield">
							<OPTION VALUE='other'>Other (enter in adjacent field)</OPTION><OPTION VALUE='AI'>AI</OPTION><OPTION VALUE='Algorithms'>Algorithms</OPTION><OPTION VALUE='Architecture & Hardware'>Architecture & Hardware</OPTION><OPTION VALUE='BioComputation'>BioComputation</OPTION><OPTION VALUE='Compilers'>Compilers</OPTION><OPTION VALUE='Databases'>Databases</OPTION><OPTION VALUE='Distributed Systems'>Distributed Systems</OPTION><OPTION VALUE='Graphics'>Graphics</OPTION><OPTION VALUE='HCI'>HCI</OPTION><OPTION VALUE='Networking'>Networking</OPTION><OPTION VALUE='Operating Systems'>Operating Systems</OPTION><OPTION VALUE='Programming Languages'>Programming Languages</OPTION><OPTION VALUE='Robotics'>Robotics</OPTION><OPTION VALUE='Scientific Computing'>Scientific Computing</OPTION><OPTION VALUE='Security'>Security</OPTION><OPTION VALUE='Software Engineering'>Software Engineering</OPTION><OPTION VALUE='Theory of Computation'>Theory of Computation</OPTION><OPTION VALUE='Vision'>Vision</OPTION>
						</SELECT>
					</div>

					<div class="col-sm-6"><INPUT class="pull-right form-control" TYPE=text SIZE=50 MAXLENGTH=150 NAME=thirdfield_typed VALUE='' TABINDEX='2'></div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="url" class="col-sm-4 control-label">Project URL</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="url" id="url" maxlength="100" />
			</div>
		</div>
		<div class="form-group">
			<label for="description" class="col-sm-4 control-label">Description</label>
			<div class="col-sm-8">
				<textarea class="form-control" name="description" id="description" maxlength="100"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="background" class="col-sm-4 control-label">Recommended Background</label>
			<div class="col-sm-8">
				<textarea class="form-control" name="background" id="background" maxlength="100"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="degree_program" class="col-sm-4 control-label">Eligible Degrees</label>
			<div class="col-sm-8">
				<div id="degree_program">
					<div class="radio">
						<label>
							<input type="radio" name="degree_program" value="2">
							Undergraduate
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="degree_program" value="1">
							Masters
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="degree_program" value="0">
							Both
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="incentives" class="col-sm-4 control-label">Available Incentives</label>
			<div class="col-sm-8">
				<div id="incentives">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="RAship" value="1" >
							RA-ship (Master's only)
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="hourly" value="2" >
							Hourly pay
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="credit" value="4" >
							Credit
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="capacity" class="col-sm-4 control-label">Number of Students</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="capacity" id="capacity" maxlength="100" maxlength="9" />
			</div>
		</div>
		<div class="form-group">
			<label for="prof" class="col-sm-4 control-label">Professor</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="prof" id="prof" maxlength="100" maxlength="9" value="<?=$User->name?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="prof_email" class="col-sm-4 control-label">Professor Email</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="prof_email" id="prof_email" maxlength="100" maxlength="9" value="<?=$User->email?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="prof_webpage" class="col-sm-4 control-label">Professor Webpage</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="prof_webpage" id="prof_webpage" maxlength="100" maxlength="9" value="<?=$User->webpage?>" />
			</div>
		</div>
		<div class="text-center">
			<INPUT class="btn btn-success btn-lg" TYPE='Submit' NAME='Action' VALUE='Save'>
			<INPUT class="btn btn-danger btn-lg" TYPE='Reset' NAME='Action' VALUE='Reset'>
		</div>

	</form>

</div>