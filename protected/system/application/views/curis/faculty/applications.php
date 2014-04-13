		<div id="content">
			
			<h2>Student Applications</h2>
			<?=(count($projects) == 0?"You currently have no projects for students to apply to.":"")?>
			<?php
			$app_stage = $this->db->query("SELECT app_stage FROM global_settings LIMIT 1")->row()->app_stage;
			foreach ($projects as $project): ?>
			<div class="projectheader">
			<h3><?=$project->title?></h3>
				<?=(count($project->applications) == 0?"This project currently has no applications.":"")?>
				<? foreach ($project->applications as $application): ?>
				<table class="table table-striped table-bordered text-center">
					<tr>
			<td class="h4">Name</td>
						<td><?=$application->name?></td>
					</tr>
		<!--						<tr>
			<td class="h4">Score:</td>
						<td><?=$application->score?></td>
					</tr>
 				<tr>
						<tr>
					<td class=h4><?php 
							if($app_stage == 1) echo "My Primary Rating </td> <td class=input> $application->fac_rating1" ;
							else if($app_stage == 2) echo "My Secondary Rating </td> <td class=input> $application->fac_rating2";
							else  echo "My Tertiary Rating </td> <td class=input> $application->fac_rating3";
							?>
						</td>
					</tr>
					</tr>-->
					<tr>
						<td class="h4">Statement</td>
						<td><?=$application->statement?></td>
					</tr>
					<tr>
					<tr>
						<td class="h4">Status</td>
						<td><h4><?php if ($application->accept_status==1) echo '<span class="label label-success">Accepted</span>';
						if ($application->accept_status==2) echo '<span class="label label-danger">Not Selected</span>';
						if ($application->accept_status==0) echo '<span class="label label-warning">Under Review</span>'?>
						</h4></td>
					</tr>
					<td colspan=2 align="center"> &nbsp;&nbsp;&nbsp; 
					<a href="/resop/protected/index.php/curis/faculty/application/<?=$application->app_id?>">View Full Application</a></td>
					</tr>
				</table>
				<br>
				<? endforeach; //end application foreach ?>
			</div>
			<? endforeach; //end project foreach ?>
				
			</div>