			<div id="content">
				<h2>Current Users</h2>
				<p>You can edit the user entries here.  Entries are sorted by assigned role - Students, then faculty, then alpha by SUNet ID.</p>
				<table width=600 align=center>
					<tr>
						<td>Name</td>
						<td>SUNet ID</td>
						<td>Email</td>
						<td>Type</td>
						<td>Admin</td>
						<td>Edit</td>
					</tr>
					<?php foreach($result as $row): ?>
					<tr>
						<td><?=$row->name?></td>
						<td><?=$row->sunetid?></td>
						<td><?=$row->email?></td>
						<td><?=$row->type?></td>
						<td><?=($row->admin == "1" ? "Yes" : "No")?></td>
						<td><a href="/resop/protected/index.php/curis/admin/users/<?=$row->user_id?>">Edit</a></td>
					</tr>
					<? endforeach; ?>
				</table>
			</div>