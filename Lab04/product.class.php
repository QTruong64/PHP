<?php
require_once ("config/db.class.php");

class Product
{
    public $productID;
    public $productName;
    public $cateID;
    public $price;
    public $quantity;
    public $description;
    public $picture;

    public function __construct($pro_name, $cate_id, $price, $quantity, $desc, $picture)
    {
        $this->productName = $pro_name;
        $this->cateID = $cate_id;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $desc;
        $this->picture = $picture;
    }
    public function save()
    {
        $db = new Db();
        $sql = "INSERT INTO product (ProductName, CateID, Price, Quantity, Description, Picture) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->connect()->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("sidiis", $this->productName, $this->cateID, $this->price, $this->quantity, $this->description, $this->picture);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public static function list_product()
    {
        $db = new Db();
        $sql = "SELECT * FROM product";
        $rs = $db->select_to_array($sql);
        return $rs;
    }
}
?>