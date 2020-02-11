<?php
interface iValidator
{
  public function filterName($name);
  public function filterEmail($email);
  public function filterUsername($username);
  public function filterPwd($password);
}