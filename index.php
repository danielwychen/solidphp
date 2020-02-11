<?php
require('core/config.php');

session_start();

if( isset($_SESSION["login"]) ) {
  $login->setLogin();
  unset($_SESSION["login"]);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, IE=edge" http-equiv="x-ua-compatible">
		<title><?php echo translate('title'); ?></title>
		<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	</head>
  
  	<body>
		<header class="flex flex-row items-center justify-center">
      <?php
      if(translate('title') == 'Play Sudoku!') {
        echo "<img class='w-1/6 p-4' src='images/Sudoku_Puzzle.svg' alt='Sudoku Puzzle'>";
      } else if(translate('title') == 'Learn Hindi! हिंदी सीखें') {
        echo "<img class='w-1/6 p-4' src='images/lotus.svg' alt='Lotus'>";
      }
      ?>
			<h1 class="text-4xl"><?php echo translate('title'); ?></h1>
		</header>
		
		<nav>
      <ul class="flex flex-row justify-center mb-6">      
        <?php
        if( isset($_SESSION["username"]) ) {
          echo '<li class="p-5"><a href="logout.php">Log out</a></li>';
        } else {
          echo '<li class="p-5"><a href="login.php">Log in</a></li>';
        }

        if( !isset($_SESSION["username"]) ) {
          echo '<li class="p-5"><a href="register.php">Register</a></li>';
        }

        if( isset($_SESSION["username"]) ) {
          echo '<li class="p-5"><a href="review.php">Review</a></li>';
        }
        ?>
      </ul>
		</nav>
    
    <main class="bg-gray-100 pt-6 pb-6">
      <?php
      if( isset($_SESSION["rego"]) ) {
        echo "<div class='flex flex-row items-baseline justify-center pb-1'><p class=px-8>Your user login has been registered.</p></div><br>";
        unset($_SESSION["rego"]);
      }
      
      if( isset($_SESSION["username"]) ) {
        echo "<div class='flex flex-row items-baseline justify-center pb-1'><p class=px-8>Welcome, " . $_SESSION["username"] . ".</p></div><br>";
      }
      ?>
      <div class="flex flex-row items-baseline justify-center pb-1">
        <p class=px-8><?php echo translate('blurb'); ?></p>
      </div>
    </main>
    
    <footer>
      <p class="flex flex-row justify-center p-2 mb-6"><?php echo translate('title'); ?> is a creation of Daniel Chen.</p>
		</footer>
	</body>
</html>