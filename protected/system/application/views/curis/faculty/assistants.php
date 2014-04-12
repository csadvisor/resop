			<div id="content">
			
			<h2>Nominate Assistants</h2>
			<p>You can use this interface to nominate people by SUNet ID to act as your proxy through the ResOp website faculty interface.
			
			<form action="" method="post">
			SUNet ID: <input type="text" name="sunetid"> <input type="submit" name="Action" value="Add">
			
			<?php if(isset($assistants))
					foreach($assistants as $assistant):
			?>
			<form action="" method="post">
			<p><?=$assistant->sunetid?> - <input type="submit" name="Action" value="Remove"></p>
			<input type="hidden" name="sunetid" value="<?=$assistant->sunetid?>">
			</form>
			<?php endforeach;?> 
			</form>
			</div>