<h1>Manage Account</h1>

<form method="post">
	<label>Username:</label><br>
	<input type="text" name="txtname" value="<?=User::getProfile()['username']?>">
	<?=getError('Username')?>

	<br><br>

	<label>Email:</label><br>
	<input type="email" name="txtmail" value="<?=User::getProfile()['email']?>">
	<?=getError('Email')?>
	
	<br><br>

	<button type="submit" name="savebtn">Save</button>
</form>