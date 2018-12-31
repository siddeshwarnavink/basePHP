<!DOCTYPE html>
<html>
      <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" type="text/css" href="<?=BASEDIR?>style.css">

            <title><?=Config::get('app')['name']?> - <?=Config::get('app')['timeline']?></title>
      </head>
      <body>
            <nav>
                  <a href="<?=BASEDIR?>">Home</a>
                  <a href="<?=BASEDIR?>hello/">Hello</a>

                  <?php 
                        if(!User::isLoggedin()) 
                              echo "<a class='right' href='" . BASEDIR . "user/sign-in'>Sign in </a>";
                        else {
                              echo "<a class='right' href='" . BASEDIR . "user/manage'>Manage account</a>";
                              echo "<a class='right' href='" . BASEDIR . "user/logout'>Logout</a>";
                        }
                  ?>
            </nav>

            <section class="jumbotron">
                  <h1><?=Config::get('app')['name']?></h1>
            </section>

            <main class="container">
                  <?=$body?>
            </main>
      </body>
</html>