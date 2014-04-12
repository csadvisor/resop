			<div id="content">
			
			<h2>Matches</h2>
			<?=(count($projects) == 0?"You currently have no projects.":"")?>
			<?php
			$app_stage = $this->db->query("SELECT app_stage FROM global_settings LIMIT 1")->row()->app_stage;
			foreach ($projects as $project): ?>
			<div class="projectheader">
			<h3><?=$project->title?></h3>
				<?=(count($project->matches) == 0?"There are no matches for this project.":"")?>
				<? foreach ($project->matches as $match): ?>
				<table class="application">
					
					<tr>
						<td class="caption">Name</td>
						<td><?php
						$row = $this->db->query("SELECT name, user_id FROM users WHERE sunetid='$match->sunetid'")->row();
						echo $row->name;
						?>	</td>
					</tr>
					<tr>
						<td class="caption">Status:</td>
						<td><?php 
								switch($match->accepted){
									case "yes":
										echo 'Accepted';
										break;
									case "no":
										echo 'Declined';
										break;
									case "":
										echo 'Not Responded';
										break;
								}
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">Statement</td>
						<td><?=$this->db->query("SELECT statement FROM project_applications WHERE user_id='$row->user_id' AND proj_id = '$project->proj_id'")->row()->statement ?></td>
					</tr>
					
				</table>
				<br>
				<? endforeach; //end application foreach ?>
			</div>
			<? endforeach; //end project foreach ?>
				
			</div>