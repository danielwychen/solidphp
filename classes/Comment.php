<?php
declare(strict_types = 1);

require_once('iComment.php');

class Comment implements iComment
{
  protected $db;
  
  function __construct(iDB $db)
  {
    $this->db = $db;
  }
  
  public function getComments()
  {
    return $this->db->get("SELECT dateTime, 
                                  message,
                                  commentNo,
                                  username
                             FROM comment");
  }
  
  public function setComments($message, $loginNo)
  {
    $dateTime = date('Y-m-d H:i:s');
    $comment = htmlentities($message, ENT_COMPAT);
    $comment = preg_replace("/'/", "\'", $message);
    $username = $_SESSION['username'];
    
    $query = "INSERT INTO comment(dateTime,
                                  message, 
                                  username,
                                  loginNo) 
                VALUES('$dateTime',
                       '$comment',
                       '$username',
                       $loginNo)";
    
    $this->db->set($query);
  }
}