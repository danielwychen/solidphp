<?php
declare(strict_types = 1);

require_once('iDB.php');

class DB implements iDB                   
{
  protected $dbServer,
            $dbUsername,
            $dbPassword,
            $dbName,
            $pdo,
            $stmt;
  
  function __construct($dbServer,
                       $dbUsername,
                       $dbPassword,
                       $dbName)
  {
    $this->dbServer = $dbServer;
    $this->dbUsername = $dbUsername;
    $this->dbPassword = $dbPassword;
    $this->dbName = $dbName;
    
    $this->connect();
  }
  
  public function connect()
  {
    $this->pdo = new PDO("mysql:host=" . $this->dbServer . "; dbname=" . $this->dbName, $this->dbUsername, $this->dbPassword);
    
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $this->pdo;
  }
  
  public function get($sql)
  {
    $this->stmt = $this->pdo->query($sql);
    
    $output = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $output;
  }
  
  public function set($query)
  {
    $this->stmt = $this->pdo->query($query);
  }
}