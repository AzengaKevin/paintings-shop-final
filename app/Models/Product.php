<?php namespace App\Models;

use App\Core\Database;

class Product{

    private ?Database $db = null;

    public function __construct() {

        $this->db = Database::init();

    }

    /**
     * Gets all the products from the database
     * 
     * @return array
     */
    public function findAll($pageItems = 8)
    {
        //Get the search parameter or null
        $needle = $_GET['s'] ?? null;

        $query = 'SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?';

        if(!empty($needle)){

            $query = 'SELECT * FROM products WHERE name LIKE ? OR proddesc LIKE ? ORDER BY date_added DESC LIMIT ?,?';

        }

        $page = isset($_GET['p']) && is_numeric($_GET['p']) ? intval($_GET['p']) : 1;

        $this->db->prepare($query);


        if(empty($needle)){

            $this->db->bind(1, ($page - 1) * $pageItems, \PDO::PARAM_INT);
            $this->db->bind(2, $pageItems, \PDO::PARAM_INT);

        }else{

            $this->db->bind(1, "%$needle%" , \PDO::PARAM_STR);
            $this->db->bind(2, "%$needle%", \PDO::PARAM_STR);
            $this->db->bind(3, ($page - 1) * $pageItems, \PDO::PARAM_INT);
            $this->db->bind(4, $pageItems, \PDO::PARAM_INT);

        }
        
        return $this->db->resultSet();
    }


    /**
     * Returns a single product
     * 
     * @param int id for the product requests
     * 
     * @return object of product from the database
     */
    public function find($id)
    {
        // Prepare statement and execute, prevents SQL injection
        $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $this->db->bind('id', $id, \PDO::PARAM_INT);

        return $this->db->single();
        
    }

    /**
     * Finds products whose id is in the array in quaetions
     * 
     * @param array $ids, the array containing the ids
     * 
     * @return array of the products
     */
    public function findIn(array $ids) : array
    {

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
            
        $sql = "SELECT * FROM products WHERE id IN ($placeholders)";

        $this->db->prepare($sql);

        foreach ($ids as $key => $value) {
            $this->db->bind(($key + 1), $value, \PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }

    /**
     * Count products in the database
     */
    public function count()
    {
        $query = "SELECT * FROM products";

        $this->db->prepare($query);

        $this->db->execute();

        return $this->db->rowCount();
    }

    /**
     * Persists a product to the database
     * 
     * @param array $data of the product to create
     * 
     * @return bool of whether the record was inserted successufully
     */
    public function create(array $data) : bool
    {
        
        $query = "INSERT INTO products(name, proddesc, price, quantity, img) VALUES(:name, :proddesc, :price, :quantity, :img)";

        $this->db->prepare($query);

        $this->db->bind('name', $data['name']);
        $this->db->bind('proddesc', $data['description']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('img', $data['img']);

        return $this->db->execute();
  
    }
}