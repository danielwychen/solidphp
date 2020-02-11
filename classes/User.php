<?php
declare(strict_types = 1);

require_once('iUser.php');

class User implements iUser
{
  protected $db,
            $validator,
            $firstName,
            $surname,
            $email,
            $username,
            $password,
            $gender,
            $area;
  
  function __construct(iDB $db,
                       iValidator $validator)
  {
    $this->db = $db;
    $this->validator = $validator;
  }
  
  public function getRegId($username)
  {
    $this->username = $this->validator->filterUsername($username);
    
    $regId = $this->db->get(
      "SELECT regId
        FROM registration
       WHERE username = '$this->username'"
    );
    
    if($regId) {
      header("Location: ./register.php?error=usertaken");
      exit();
    }
    
    return $regId;
  }
  
  public function setUser($firstName,
                          $surname,
                          $email,
                          $username,
                          $password,
                          $gender,
                          $area)
  {
    $this->firstName = $this->validator->filterName($firstName);
    $this->surname = $this->validator->filterName($surname);
    $this->email = $this->validator->filterEmail($email);
    $this->username = $this->validator->filterUsername($username);
    $this->password = $this->validator->filterPwd($password);
    $this->gender = $gender;
    $this->area = $area;
    
    $query = "INSERT INTO registration(firstName,
                                       surname,
                                       email,
                                       username,
                                       password,
                                       gender,
                                       area)
                VALUES('$this->firstName',
                       '$this->surname',
                       '$this->email',
                       '$this->username', 
                       '$this->password',
                       '$this->gender',
                       '$this->area')";
    
    $this->db->set($query);
  }
}