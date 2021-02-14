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