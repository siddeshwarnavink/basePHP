<h2>Sing in</h2>

<form action="" method="post">
      <label>Email:</label><br>
      <input type="email" name="txtmail" value="<?=getValue('txtmail')?>">
      <?=getError('Email')?>

      <br><br>

      <label>Password:</label><br>
      <input type="password" name="txtpwd">
      <?=getError('Password')?>

      <br><br>

      <button type="submit" name="loginbtn">Login</button>
      <a href="./sign-up">Don`t have an account?</a>
</form>