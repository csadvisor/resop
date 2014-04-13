			<div id="content">
			
			<h2>Nominate Assistants</h2>
			<p>You can use this interface to nominate people by SUNet ID to act as your proxy through the ResOp website faculty interface.
			
			<form action="" method="post" role="form" class="form-inline">
			SUNet ID: <input type="text" class="form-control" name="sunetid"> <input class="btn btn-primary" type="submit" name="Action" value="Add">
			</form>

			<?php if(isset($assistants))
					foreach($assistants as $assistant):
			?>
			<form action="" method="post" role="form" class="form-inline">
			<p><?=$assistant->sunetid?> - <input class="btn btn-primary" type="submit" name="Action" value="Remove"></p>
			<input type="hidden" name="sunetid" value="<?=$assistant->sunetid?>">
			</form>
			<?php endforeach;?> 

			</div>