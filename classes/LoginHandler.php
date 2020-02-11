<?php
declare(strict_types = 1);

require_once('iLogin.php');

class LoginHandler implements iLogin
{
  protected $db,
            $username,
            $pwdHash;
  
  function __construct(iDB $db)
  {
    $this->db = $db;
  }
  
  public function getLoginNo()
  {
    $username = $_SESSION["username"];
    
    return $this->db->get("SELECT loginNo
                             FROM login
                           WHERE username = '$username'
                             ORDER BY loginNo DESC
                           LIMIT 1");
  }
  
  public function getPwdHash($username)
  {
    $this->username = htmlentities($username, ENT_COMPAT);
    
    $this->pwdHash = $this->db->get("SELECT password 
                                       FROM registration
                                     WHERE username = '$this->username'");
    
    $this->pwdHash = array_pop($this->pwdHash);
    
    if( is_array($this->pwdHash) ) {
      $this->pwdHash = array_pop($this->pwdHash);
      
      return $this->pwdHash;
    } else if( is_bool($this->pwdHash) ) {
      header("Location: ./login.php?error=invalid");
      exit();
    }
  }

  public function getReg($username, $password)
  {
    $this->getPwdHash($username);
    
    if(password_verify($password, $this->pwdHash) ) {
      $regId = $this->db->get("SELECT regId 
                                 FROM registration
                               WHERE username = '$this->username'");
      
      $regId = array_pop($regId);
      $regId = array_pop($regId);
      
      $_SESSION["username"] = $this->username;
      $_SESSION["password"] = $this->pwdHash;
      $_SESSION["regId"] = $regId;
      $_SESSION["login"] = 1;
      
      header("Location: ./index.php");
    } else {
      header("Location: ./login.php?error=invalid");
      exit();
    }
  }
  
  public function setLogin()
  {
    $username = $_SESSION["username"];
    $pwdHash = $_SESSION["password"];
    $id = $_SESSION["regId"];
    
    $query = "INSERT INTO login(username, 
                                password,
                                regId) 
                VALUES('$username', 
                       '$pwdHash',
                       '$id')";
    
    $this->db->set($query);
  }
}