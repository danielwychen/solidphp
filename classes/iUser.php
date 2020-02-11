<?php
interface iUser
{
  public function getRegId($username);
  public function setUser($firstName, $surname, $email, $username, $password, $gender, $area);
}