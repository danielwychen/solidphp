<?php
interface iLogin
{
  public function getLoginNo();
  public function getPwdHash($username);
  public function getReg($username, $password);
  public function setLogin();
}