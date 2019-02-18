<?php
/**
 * Created by PhpStorm.
 * User: lananh
 * Date: 2019-02-13
 * Time: 11:57
 */
namespace Model;
class ProductDB
{
    public $connection;
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function create($product)
    {
        $sql = "INSERT INTO Products('name', 'pice') value (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$product->name);
        $stmt->bindParam(2,$product->pice);
        return $stmt->execute();

    }
    public function getAll()
    {
        $sql = "SELECT * FROM Products";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $products = [];
        foreach ($result as $item){
            $product = new Product($item['name'], $item['pice']);
            $product->id = $item['id'];
            $products[] = $product ;
        }
        return $products;

    }
    public function get($id){
        $sql = "SELECT * FROM Products WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $item = $stmt->fetch();
        $product = new Product($item['name'], $item['pice']);
        $product->id = $item['id'];
        return $product;
    }
    public function delete($id)
    {
        $sql = "DELETE FROM customer WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $id);
        return $stmt->execute();

    }
    public function update($id, $product)
    {
        $sql = "UPDATE Products SET name =?, pice = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $product->name);
        $stmt->bindParam(2, $product->pice);
        $stmt->bindParam(3, $id);
        return $stmt->execute();
    }
}
