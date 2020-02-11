<?php
interface iDB
{
  public function connect();
  public function get($sql);
  public function set($query);
}