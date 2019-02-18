<?php
/**
 * Created by PhpStorm.
 * User: lananh
 * Date: 2019-02-13
 * Time: 14:14
 */
namespace Controller;
use Model\Product;
use Model\ProductDB;
use Model\DBConnection;

class ProductController
{
    public $productDB;
    public function __construct()
    {
        $connection = new DBConnection("mysql:host=localhost;dbname=s12_Quan_ly_san_pham", 'root', '123456');
        $this->productDB = new ProductDB($connection->connect());

    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
         include 'View/add.php';
        } else {
            $name = $_POST['name'];
            $pice = $_POST['pice'];
            $product =new Product($name, $pice);
            $this->productDB->create($product);
            $message ='Product created';
            include 'View/add.php';
        }
    }
    public function index(){
        $products = $this->productDB->getAll();
        include 'View/list.php';
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $id = $_GET['id'];
            $this->productDB->delete($id);
            header('Location: index.php');

        }
    }
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $_GET['id'];
            $products = $this->productDB->get($id);
            include 'View/edit.php';
        }else {
            $id = $_POST['id'];
            $product = new Product($_POST['name'], $_POST['pice']);
            $this->productDB->update($id, $product);
            header('Location: index.php');
        }
    }

}