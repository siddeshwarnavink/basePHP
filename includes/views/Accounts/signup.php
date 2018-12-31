<h2>Create an account</h2>

<form action="" method="post">
      <label>Username:</label><br>
      <input type="text" name="txtname" value="<?=getValue('txtname')?>">
      <?=getError('Username')?>
      <br><br>

      <label>Email:</label><br>
      <input type="email" name="txtmail" value="<?=getValue('txtmail')?>">
      <?=getError('Email')?>
      <br><br>

      <label>Password:</label><br>
      <input type="password" name="txtpwd">
      <?=getError('Password')?>
      <br><br>

      <label>Confirm Password:</label><br>
      <input type="password" name="txtpwd2">
      <?=getError('Confirm Password')?>
      <br><br>

      <button type="submit" name="createaccountbtn">Create</button>
      <a href="./sign-in">Already have an account?</a>
</form>