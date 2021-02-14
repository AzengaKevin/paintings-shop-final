<?php namespace App\Models;

use App\Core\Database;

class Order{

    private ?Database $db = null;
    
    public function __construct() {

        $this->db = Database::init();

    }

    public function findUserOrders($userId)
    {
        $query = "SELECT orders.id, orders.user_id, orders.paid, paypal_order_id,  SUM(products.price * order_items.quantity) AS amount, COUNT(order_items.id) AS items
        FROM orders
        INNER JOIN order_items
        ON orders.id = order_items.order_id
        INNER JOIN products
        ON order_items.product_id = products.id
        WHERE orders.user_id = :user_id
        GROUP BY orders.id";

        $this->db->prepare($query);

        $this->db->bind("user_id", $userId, \PDO::PARAM_INT);

        return $this->db->resultSet();

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

    /**
     * Update an order
     * 
     * @param array $data of payment and id
     * 
     * @return bool of whether the order was update of not
     * 
     */
    public function update($data)
    {
        $query = "UPDATE orders 
        SET payment = :payment, paypal_order_id = :paypal_order_id
        WHERE id = :id";

        $this->db->prepare($query);

        $this->db->bind('payment', $data['payment']);
        $this->db->bind('paypal_order_id', $data['paypal_order_id']);
        $this->db->bind('id', $data['id']);

        return $this->db->execute();
    }

    /**
     * Update an order
     * 
     * @param array $data of payment and id
     * 
     * @return bool of whether the order was update of not
     * 
     */
    public function setPaid($orderId)
    {
        $query = "UPDATE orders 
        SET paid = :paid
        WHERE id = :id";

        $this->db->prepare($query);

        $this->db->bind('paid', true);
        $this->db->bind('id', $orderId);

        return $this->db->execute();
    }
}