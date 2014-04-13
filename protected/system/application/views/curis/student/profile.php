			<div id="content">
				
				<script language="Javascript">
				function validate(){
					return confirm("Are you sure you want to delete your profile?  A completed profile is required for all ResOp applications.");
				}
				</script>
				<h2>Your Profile</h2>
				<p><?php if($message != "") echo $message; ?> In order to be considered for projects, you must fill out the following profile information:</p>
				<form method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" id="name" value="<?=$User->name?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="email" id="email" maxlength="100" value="<?=$User->email?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="webpage" class="col-sm-2 control-label">Webpage (optional)</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="webpage" id="webpage" maxlength="100" value="<?=$User->webpage?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="interestarea" class="col-sm-2 control-label">Research Interest Area</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="interestarea" id="interestarea" maxlength="100" value="<?=$User->interestarea?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="major" class="col-sm-2 control-label">Department/Major</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="major" id="major" maxlength="100" value="<?=$User->major?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="gpa" class="col-sm-2 control-label">GPA in Math/CS Courses</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="gpa" id="gpa" maxlength="100" value="<?=$User->gpa?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="year" class="col-sm-2 control-label">Year at Stanford</label>
						<div class="col-sm-10">
							<div id="year">
								<div class="radio">
									<label>
										<input type="radio" name="year" id="freshman" value="Freshman" <?=($User->year == "Freshman" ? "checked":"")?>>
										Freshman
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="year" id="sophomore" value="Sophomore" <?=($User->year == "Sophomore" ? "checked":"")?>>
										Sophomore
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="year" id="junior" value="Junior" <?=($User->year == "Junior" ? "checked":"")?>>
										Junior
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="year" id="senior" value="Senior" <?=($User->year == "Senior" ? "checked":"")?>>
										Senior
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="year" id="graduate" value="Graduate" <?=($User->year == "Graduate" ? "checked":"")?>>
										Graduate
									</label>
								</div>
							</div>
						</div>
					</div>

					
					<div class="form-group">
						<label for="transcript" class="col-sm-2 control-label">Transcript</label>
						<div class="col-sm-10">
							<input type="hidden" name="MAX_FILE_SIZE" value="" />
							<input type="file" name="transcript" id="transcript" />
							<?php if($User->transcript != ""){ 
								echo "<a href = \"$User->transcript\" target = _blank> View Transcript </a>";
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label for="resume" class="col-sm-2 control-label">Resume</label>
						<div class="col-sm-10">
							<input type="hidden" name="MAX_FILE_SIZE" value="" />
							<input type="file" name="resume" id="resume" />
							<?php if($User->resume != ""){ 
								echo "<a href = \"$User->resume\" target = _blank> View Resume </a>";
							}
							?>
						</div>
					</div>
					<div class="text-center">	
						<h5 class="text-danger">All uploads must be PDF or TXT files</h5>
						<button class="btn btn-success btn-lg" type="submit" name='Action' value='Save' <?=($enabled !="1"?"disabled":"")?>>Save</button> 
						<button class="btn btn-danger btn-lg" type="submit" type="submit" name='Action' value="Delete" <?=($enabled!="1"?"disabled":"")?> onClick="return validate()">Delete</button> 
						<button class="btn btn-primary btn-lg" type='reset' value='Reset'> <?=($enabled !="1"?"<br>Updating student profiles has been disabled by the CURIS Administrator.":"")?>Reset</button>
					</div>
				</form>
			</div>