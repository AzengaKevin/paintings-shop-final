<?php namespace App\Models;

use App\Core\Database;

class Order{

    private ?Database $db = null;
    
    public function __construct() {

        $this->db = Database::init();

    }

    /**
     * Persists an order to the database
     * 
     * @param array $data, orders data
     * 
     * @return int id of the created order
     */
    public function create(array $data)
    {
        $this->db->beginTransacton();
                
        //Create the order
        $orderSql = "INSERT INTO orders(user_id) VALUES (:user_id)";
        
        $this->db->prepare($orderSql);
        
        $this->db->bind('user_id', $data['userId'], \PDO::PARAM_INT);

        $this->db->execute();

        $orderId = $this->db->lastInsertId();

        $orderItemsSql = "INSERT INTO order_items(order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)";

        $this->db->prepare($orderItemsSql);

        foreach ($data['cartItems'] as $key => $value) {

            $this->db->bind('order_id', $orderId, \PDO::PARAM_INT);
            $this->db->bind('product_id', $key, \PDO::PARAM_INT);
            $this->db->bind('quantity', $value, \PDO::PARAM_INT);

            $this->db->execute();
        }

        $this->db->commit();

        return $orderId;

    }

    /**
     * Get order with Items
     * 
     * @param int $id the id of the order
     * 
     * @return object of order that has the passed id
     * 
     */
    public function find(int $id)
    {
        $query = 
        "SELECT orders.*,  SUM(products.price * order_items.quantity) AS amount, COUNT(order_items.id) AS items
        FROM orders
        INNER JOIN order_items
        ON orders.id = order_items.order_id
        INNER JOIN products
        ON order_items.product_id = products.id
        WHERE orders.id = :id";

        $this->db->prepare($query);

        $this->db->bind("id", $id, \PDO::PARAM_INT);

        return $this->db->single();

    }
}