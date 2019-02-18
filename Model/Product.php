<?php
/**
 * Created by PhpStorm.
 * User: lananh
 * Date: 2019-02-13
 * Time: 11:56
 */
namespace Model;
class Product
{
public $id;
public $name;
public $pice;

public function __construct($name, $pice)
{
    $this->name = $name;
    $this->pice = $pice;
}

}