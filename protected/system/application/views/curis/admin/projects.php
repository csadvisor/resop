			<div id="content" class="row">
				<h1 class="page-header">Projects</h1>
				<p> <?php if(!isset($projects)) echo 'There are currently no projects.'; else{ ?>
					<?php
					if(!isset($prevfield)) $prevfield = "";
					if(!isset($prevprof)) $prevprof = "";
					?>
					<form action="" method="post" class="form-inline text-center well" role="form">
						<div class="row">
							<div class="col-sm-3 col-sm-offset-1 text-center">
								<div class="form-group">
									<label for="faculty" class="control-label">Professor</label>
									<select name="faculty" id="faculty" class="form-control">
										<option value="all">All</option>
										<?php foreach ($faculty as $prof): ?>
										<option value="<?=$prof->prof?>" <?=$prof->prof==$prevprof?"selected":""?>><?=$prof->prof?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-sm-3 col-sm-offset-1 text-center">
							<div class="form-group">
								<label for="field" class="control-label">Field</label>
								<select name="field" id="field" class="form-control">
									<option value="all">All</option>
									<?php foreach ($fields as $field): 
									if($field!=""){ ?>
									<option value="<?=$field?>" <?=$field==$prevfield?"selected":""?>><?=$field?></option>
									<?php } endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-sm-1 col-sm-offset-2">
							<input class="btn btn-primary btn-lg" type="submit" name="Action" value="Filter"/>
						</div>
					</div>
				</form>
				<?=(count($projects)==0?"There are no matching projects.":"")?>

				<div class="list-group">
					<?php foreach ($projects as $row): ?>
					<a href="/resop/protected/index.php/curis/admin/projects/0/<?=$row->proj_id?>" class="list-group-item">
						<h4 class="list-group-item-heading"><?=$row->title?></h4>
						<p class="list-group-item-text"><?=$row->prof?></p>
						<p class="list-group-item-text"><?=$row->researchfield?><?=($row->secondfield=="")?"":", ".$row->secondfield?><?=($row->thirdfield=="")?"":", ".$row->thirdfield?></p>
						<p class="list-group-item-text">Viewed <?=$row->views?> times</p>
					</a>
				<?php endforeach;?>
			</div>
			<? } //end no project else ?>
		</div>