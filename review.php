<?php
require('core/config.php');

session_start();

if( !isset($_SESSION["username"]) ) {
  header("Location: ./login.php?error=review");
}

if( isset($_POST['submit']) ) {
  $message = $_POST['comment'];
  $loginNo = $login->getLoginNo();
  $loginNo = array_pop($loginNo);
  $loginNo = array_pop($loginNo);
  $comment->setComments($message, $loginNo);
}

$comments = $comment->getComments();
$like->setLikes($login);
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
			<h1 class="text-4xl">Review</h1>
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

        if( !isset($_SESSION["username"]) ) {
          echo '<li class="p-5"><a href="register.php">Register</a></li>';
        }
        ?>
      </ul>
		</nav>
    
		<main class="bg-gray-100 pt-6 pb-6">
      <?php
      if( isset($comments) ) {
        foreach($comments as $section) {
          echo "<div class='flex flex-row items-center justify-center'>"; 
            echo "<div class='flex flex-col items-center p-4'><img class='w-16 m-2' src='images/profile.svg' alt='Profile Picture'>" . array_pop($section) . "</div>";
            echo array_shift($section) . " " . array_shift($section);
            
            $commentNo = array_pop($section);
            echo "<div class='flex flex-col items-center p-4'>";
              echo "<a href='review.php?type=comment&commentNo="; 
              echo $commentNo;
              echo "'><button class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded m-2'>Like</button></a>";
              $likes = $like->getLikes($commentNo);
              echo $likes;
            if($likes == "1") {
              echo " like</div>";
            } else {
              echo " likes</div>";
            }
          echo "</div><br>";
        }
      }
      ?>
      
      <div class="flex flex-row items-center justify-center">
        <div class="flex flex-col items-center">
          <img class="w-1/3 m-2" src="images/profile.svg" alt="Profile Picture">
          <?php
          echo $_SESSION["username"];
          ?>
        </div>
           
        <textarea class="border border-gray-400 rounded-lg w-1/3 m-2 p-2" placeholder="Share your thoughts about this game..." form="comment" name="comment" required></textarea>
        
        <form action="review.php" id="comment" method="post">
          <input class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded m-2" type="submit" name="submit" value="Submit">
        </form>
      </div>
		</main>
		
		<footer>
      <p class="flex flex-row justify-center p-2"><?php echo translate('title'); ?> is a creation of Daniel Chen.</p>
		</footer>
	</body>
</html>