<?php
require_once('iLike.php');

class Like implements iLike
{
  protected $db,
            $login;
  
  function __construct(iDB $db,
                       iLogin $login)
  {
    $this->db = $db;
    $this->login = $login;
  }
  
  public function setLikes()
  {
    $loginNo = $this->login->getLoginNo();
    $loginNo = array_pop($loginNo);
    $loginNo = array_pop($loginNo);
    
    $username = $_SESSION['username'];
    
    if( isset($_GET['type'], $_GET['commentNo']) ) {
      $type = $_GET['type'];
      $commentNo = (int) $_GET['commentNo'];
      
      switch($type) {
        case 'comment':
          $query = "INSERT INTO comment_likes(commentNo,
                                              username,
                                              loginNo)
                      SELECT $commentNo,
                             '$username',
                             $loginNo
                        FROM comment
                      JOIN login
                        ON comment.username = login.username
                      WHERE EXISTS(
                        SELECT loginNo
                          FROM login
                        WHERE loginNo = $loginNo
                      ) AND NOT EXISTS(
                        SELECT loginNo
                          FROM comment_likes
                        WHERE commentNo = $commentNo
                          AND username = '$username'
                      ) LIMIT 1";
          $this->db->set($query);
        break;
      }
    }
  }
  
  public function getLikes($commentNo)
  {       
    $likes = $this->db->get("SELECT COUNT(cl.commentNo)
                               FROM comment_likes cl
                             JOIN comment c
                               ON cl.commentNo = c.commentNo
                             WHERE cl.commentNo = $commentNo
                               GROUP BY c.commentNo");
    
    $likes = array_pop($likes);
    
    if( is_array($likes) ) {
      $likeNo = array_pop($likes);
    } else if( is_null($likes) ) {
      $likeNo = 0;
    }
    
    return $likeNo;
  }
}