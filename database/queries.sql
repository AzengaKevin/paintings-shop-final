SELECT * FROM orders
INNER JOIN order_items
ON orders.id = order_items.order_id;

-- SELECT * ORDERS
SELECT orders.id, orders.user_id, orders.paid, orders.created_at, order_items.product_id, order_items.quantity
FROM orders
INNER JOIN order_items
ON orders.id = order_items.order_id;

-- SELECT SINGLE ORDER
SELECT orders.*,  SUM(products.price * order_items.quantity) AS amount, COUNT(order_items.id) AS items
FROM orders
INNER JOIN order_items
ON orders.id = order_items.order_id
INNER JOIN products
ON order_items.product_id = products.id
WHERE orders.id = 20;

UPDATE orders 
SET paid = false, payment = '"{"amount":1000,"tax":null,"date":1613310919}"'
WHERE id = 21;

ALTER TABLE orders ADD paypal_order_id VARCHAR(255);

SELECT orders.id, orders.user_id, orders.paid, paypal_order_id,  SUM(products.price * order_items.quantity) AS amount, COUNT(order_items.id) AS items
FROM orders
INNER JOIN order_items
ON orders.id = order_items.order_id
INNER JOIN products
ON order_items.product_id = products.id
WHERE orders.user_id = 25
GROUP BY orders.id; 

SELECT orders.id, orders.user_id, orders.paid, orders.paypal_order_id, users.name AS user, SUM(products.price * order_items.quantity) AS amount, COUNT(order_items.id) AS items
FROM orders
INNER JOIN users
ON orders.user_id = users.id
INNER JOIN order_items
ON orders.id = order_items.order_id
INNER JOIN products
ON order_items.product_id = products.id
GROUP BY orders.id; 


DELETE FROM orders
WHERE id = 19;