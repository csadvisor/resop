<div id="content">
	<h2>Your Projects</h2>
	<p> <?php if(!isset($projects)) echo 'You currently have no projects.'; else{ ?>
		<?php
		$capacity = $this->db->query("SELECT fac_capacity FROM users WHERE user_id='".$this->User->user_id."'")->row()->fac_capacity;
		?>

		<script language="Javascript">
		function validate(msg){
			return confirm(msg);
		}
		</script>

		<!--form method="post" action="" role="form" class="form-inline well">
			<span class="h4">Maximum Number of Students for All Projects:</span>

			<INPUT class="form-control" TYPE=text SIZE=3 MAXLENGTH=3 NAME=capacity VALUE='<?=$capacity?>' TABINDEX='7' />
			<INPUT class="btn btn-primary" TYPE='Submit' NAME='Action' VALUE='Save Capacity' />
			<INPUT class="btn btn-primary" TYPE='Reset' NAME='Action' VALUE='Reset' />
		</form-->

		<div class="list-group">
			<?php foreach ($projects as $row): ?>
			<a href="/resop/protected/index.php/curis/faculty/projects/<?=$row->proj_id?>" class="list-group-item">
				<div class="row">
					<div class="col-sm-9">
						<h4 class="list-group-item-heading"><?=$row->title?></h4>
						<p class="list-group-item-text"><?=$row->researchfield?><?=($row->secondfield=="")?"":", ".$row->secondfield?><?=($row->thirdfield=="")?"":", ".$row->thirdfield?></p>
						<p class="list-group-item-text">Viewed <?=$row->views?> times</p>
					</div>
					<div class="col-sm-3">
						<form method="post" role="form" action="" style="margin-top:12px;" onSubmit="return validate('Are you sure you want to delete this project?')">
							<input type="hidden" name="proj_id" value="<?=$row->proj_id?>" />
							<INPUT class="btn btn-danger" TYPE='Submit' NAME='Action' VALUE='Delete project'>
						</form>
					</div>
				</div>
			</a>
		<?php endforeach;?>
	</div>

	<form method="post" role="form" action="" onSubmit="return verify('Are you sure you want to delelte all your projects?')">
		<p align = 'center'><INPUT class="btn btn-danger btn-lg" TYPE='Submit' NAME='Action' VALUE='Delete All Projects'></p>
	</form>


	<? } //end 'no-project' else ?>
</div>