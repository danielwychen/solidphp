<?php
declare(strict_types = 1);

require_once('iDB.php');

class SafeDB extends DB implements iDB
{
  function __construct($dbServer,
                       $dbUsername,
                       $dbPassword,
                       $dbName)
  {
    parent::__construct($dbServer, $dbUsername, $dbPassword, $dbName);
  }
  
  public function connect()
  {
    try {
      $pdo = parent::connect();
      return $pdo;
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      exit();
    }
  }
  
  public function get($sql)
  {
    try {
      $output = parent::get($sql);
      return $output;
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      exit();
    }
  }
  
  public function set($query)
  {
    try {
      parent::set($query);
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      exit();
    }
  }
}