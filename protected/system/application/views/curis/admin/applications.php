<div id="content">
	<h2>Current Applications</h2>
	<p> <?php 
	if($app == "") echo 'No applications have been started';
	else{ 
		$app_stage = $this->db->query("SELECT app_stage FROM global_settings LIMIT 1")->row()->app_stage;
		?>

		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Student</th>
					<th>Project</th>
					<th>Professor</th>
					<th>Status</th>
				</tr>
			</thead>				
			<?php foreach ($app as $row): ?>

			<tr>
				<td class=input>
					<a href="/resop/protected/index.php/curis/admin/users/<?=$row->user_id?>">
						<?php
						$query = $this->db->query("SELECT name FROM users WHERE user_id = '$row->user_id' ");
						$temp = $query->result();
						foreach ($temp as $temprow)
							echo $temprow->name;
						?>
					</a>
				</td>				
				<td class=input><a href="/resop/protected/index.php/curis/admin/projects/0/<?=$row->proj_id?>"><?=$row->proj_title?></a></td>
				<td class=input><?=$row->proj_prof?></td>
				<td class="input"><?php if ($row->accept_status==1) echo '<span class="accept">Accepted</span>';
				if ($row->accept_status==2) echo '<span class="reject">Not Selected</span>';
				if ($row->accept_status==0) echo 'Under Review'?>
			</td>
		</tr>

	<?php endforeach;?>
</table>
<? } //end no project else ?>
</div>