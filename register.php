<?php
require('core/config.php');

session_start();

if( isset($_POST['submit']) ) {
  $firstName = $_POST['firstName'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $gender = $_POST['gender'];
  $area = $_POST['area'];
  
  $user->getRegId($username);
  $user->setUser($firstName, $surname, $email, $username, $password, $gender, $area);
  
  $_SESSION["rego"] = 1;
  header('Location: ./index.php');
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
			<h1 class="text-4xl">Registration</h1>
		</header>
		
		<nav>
      <ul class="flex flex-row justify-center mb-6">
        <li class="p-5"><a href="index.php">Home</a></li>
        <?php
        if( isset($_SESSION["username"]) ) {
          echo '<li class="p-5"><a href="logout.php">Log out</a></li>';
        } else {
          echo '<li class="p-5"><a href="login.php">Log in</a></li>';
        }
          
        if( isset($_SESSION["username"]) ) {
          echo '<li class="p-5"><a href="review.php">Review</a></li>';
        }
        ?>
      </ul>
		</nav>
		
		<main class="bg-gray-100 pt-6 pb-6">
      <form action="#" method="post">
        <?php
        if( isset($_GET['error']) ) {
          if($_GET['error'] == "invalidname") {
            echo '<p class="flex flex-row items-baseline justify-center pb-1">Invalid first and/or sur-name.<p><br>';
          } else if($_GET['error'] == "invalidmail") {
            echo '<p class="flex flex-row items-baseline justify-center pb-1">Invalid email.<p><br>';
          } else if($_GET['error'] == "invalidusername") {
            echo '<p class="flex flex-row items-baseline justify-center pb-1">Invalid username.<p><br>';
          } else if($_GET['error'] == "invalidpwd") {
            echo '<p class="flex flex-row items-baseline justify-center pb-1">Password must be at least six characters long.<p><br>';
          } else if($_GET['error'] == "usertaken") {
            echo '<p class="flex flex-row items-baseline justify-center pb-1">The username has already been taken.<p><br>';
          }
        }
        ?>
        
        <div class="flex flex-row items-baseline justify-center pb-1">
          <label for="firstName">First Name:</label><input class="border border-gray-400 rounded-lg ml-2 pl-2" type="text" name="firstName" placeholder="Enter your first name" required><br><br>
        </div>
        
        <div class="flex flex-row items-baseline justify-center pb-1">
          <label for="surname">Surname:</label><input class="border border-gray-400 rounded-lg ml-2 pl-2" type="text" name="surname" placeholder="Enter your surname" required><br><br>
        </div>
        
        <div class="flex flex-row items-baseline justify-center pb-1">
          <label for="email">Email:</label><input class="border border-gray-400 rounded-lg ml-2 pl-2" type="email" name="email" placeholder="Enter your email" required><br><br>
        </div>
        
        <div class="flex flex-row items-baseline justify-center pb-1">
          <label for="username">Username:</label><input class="border border-gray-400 rounded-lg ml-2 pl-2" type="text" name="username" placeholder="Enter your username" required><br><br>
        </div>
        
        <div class="flex flex-row items-baseline justify-center pb-1">
          <label for="password">Password:</label><input class="border border-gray-400 rounded-lg ml-2 pl-2" type="password" name="password" placeholder="Enter your password" required><br><br>
        </div>
        
        <div class="flex flex-row items-baseline justify-center pb-1">
          <label for="gender">Gender:</label>
           <input class="ml-2 mr-1" type="radio" name="gender" value="male">Male</label>
           <input class="ml-2 mr-1" type="radio" name="gender" value="female" checked>Female</label><br><br>
        </div>
        
        <div class="flex flex-row items-baseline justify-center pb-1">
          <label for="area">Area:</label>
          <select class="border border-gray-400 rounded-lg ml-2 pl-2" name="area">
            <option value="auck">Auckland</option>
            <option value="well">Wellington</option>
            <option value="chch">Christchurch</option>
            <option value="dune">Dunedin</option>
            <option value="othr">Other</option>
          </select><br><br>
        </div>
        
        <div class="flex flex-row justify-center pb-2">
          <input class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded m-2" type="submit" name="submit" value="Submit">
          <input class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded m-2" type="reset" value="Cancel">
        </div>
      </form>
		</main>
		
		<footer>
      <p class="flex flex-row justify-center p-2 mb-6"><?php echo translate('title'); ?> is a creation of Daniel Chen.</p>
		</footer>
	</body>
</html>