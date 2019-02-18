<?php
/**
 * Created by PhpStorm.
 * User: lananh
 * Date: 2019-02-13
 * Time: 11:57
 */
namespace Model;
use PDO;
class DBConnection
{
public $dsn;
public $username;
public $password;

public function __construct($dsn, $username, $password)
{
    $this->dsn = $dsn;
    $this->username = $username;
    $this->password = $password;
}
public function connect()
{
    return new PDO($this->dsn, $this->username, $this->password);
}

}