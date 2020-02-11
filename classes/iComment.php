<?php
interface iComment
{
  public function getComments();
  public function setComments($message, $loginNo);
}