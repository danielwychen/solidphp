<?php
declare(strict_types = 1);

require_once('iValidator.php');

class Validator implements iValidator
{  
  public function filterName($name)
  {
    $name = filter_var(trim($name), FILTER_SANITIZE_STRING);
    
    if(preg_match("/^[a-zA-Z]*$/", $name) ) {
      return $name;
    } else {
      header("Location: ./register.php?error=invalidname");
      exit();
    } 
  }
  
  public function filterEmail($email)
  {
    if( filter_var(trim($email), FILTER_VALIDATE_EMAIL) ) {
      return $email;
    } else {
      header("Location: ./register.php?error=invalidmail");
      exit();
    }
  }
  
  public function filterUsername($username)
  {
    $username = filter_var(trim($username), FILTER_SANITIZE_STRING);
    
    if( preg_match("/^[a-zA-Z0-9_]*$/", $username) ) {
      return $username;
    } else {
      header("Location: ./register.php?error=invalidusername");
      exit();
    }
  }
  
  public function filterPwd($password)
  {  
    if( strlen($password) < 6 ) {
      header("Location: ./register.php?error=invalidpwd");
      exit();
    } else {
      $password = password_hash(trim($password), PASSWORD_DEFAULT);
      return $password;
    }
  }
}