<?php
// Database connection using PDO
include 'components/connect.php';

// Initialize an array to store user inputs
$conditions = [];
$params = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Collect form inputs and add to conditions if not empty
    if (!empty($_GET['user_id'])) {
        $conditions[] = "user_id = :user_id";
        $params[':user_id'] = $_GET['user_id'];
    }
    if (!empty($_GET['name'])) {
        $conditions[] = "name LIKE :name";
        $params[':name'] = "%" . $_GET['name'] . "%";
    }
    if (!empty($_GET['email'])) {
        $conditions[] = "email LIKE :email";
        $params[':email'] = "%" . $_GET['email'] . "%";
    }
    if (!empty($_GET['number'])) {
        $conditions[] = "number = :number";
        $params[':number'] = $_GET['number'];
    }
    if (!empty($_GET['method'])) {
        $conditions[] = "method = :method";
        $params[':method'] = $_GET['method'];
    }
    if (!empty($_GET['payment_status'])) {
        $conditions[] = "payment_status = :payment_status";
        $params[':payment_status'] = $_GET['payment_status'];
    }
    if (!empty($_GET['price_min']) && !empty($_GET['price_max'])) {
        $conditions[] = "total_price BETWEEN :price_min AND :price_max";
        $params[':price_min'] = $_GET['price_min'];
        $params[':price_max'] = $_GET['price_max'];
    }
    if (!empty($_GET['order_date_start']) && !empty($_GET['order_date_end'])) {
        $conditions[] = "placed_on BETWEEN :order_date_start AND :order_date_end";
        $params[':order_date_start'] = $_GET['order_date_start'];
        $params[':order_date_end'] = $_GET['order_date_end'];
    }
    /*if (!empty($_GET['response_date_start']) && !empty($_GET['response_date_end'])) {
        $conditions[] = "response_date BETWEEN :response_date_start AND :response_date_end";
        $params[':response_date_start'] = $_GET['response_date_start'];
        $params[':response_date_end'] = $_GET['response_date_end'];
    }*/

    // Build the SQL query dynamically
    $query = "SELECT * FROM orders";
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    /*echo $query;
    echo "<br>";
    print_r($params);
    echo "<br>";*/

    // Execute the query
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Order Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Search Orders</h1>
    <div class="form-container">
        <form method="get">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id"><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br><br>
            
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br><br>
            
            <label for="number">Phone Number:</label>
            <input type="text" id="number" name="number"><br><br>

            <label for="method">Payment Method:</label>
            <select id ="method" name="method">
               <option value="" disabled selected>select payment method --</option>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paytm">paytm</option>
               <option value="paypal">paypal</option>
            </select>
            
            <label for="payment_status">Payment Status:</label>
            <select id="payment_status" name="payment_status">
                <option value="">--Select--</option>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Failed">Failed</option>
            </select><br><br>
            
            <label for="price_min">Price Range:</label>
            <input type="number" id="price_min" name="price_min" placeholder="Min" min="1">
            <input type="number" id="price_max" name="price_max" placeholder="Max"><br><br>
            
            <label for="order_date_start">Order Date Range:</label>
            <input type="date" id="order_date_start" name="order_date_start">
            <input type="date" id="order_date_end" name="order_date_end"><br><br>
            
            <!--<label for="response_date_start">Response Date Range:</label>
            <input type="date" id="response_date_start" name="response_date_start">
            <input type="date" id="response_date_end" name="response_date_end"><br><br>-->
            
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if (isset($results)): ?>
        <h2>Search Results</h2>
        <?php if (count($results) > 0): ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Method</th>
                    <th>Price</th>
                    <th>Order Date</th>
                    <th>Payment Status</th>
                </tr>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['user_id']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['number']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['method']) ?></td>
                        <td><?= htmlspecialchars($row['total_price']) ?></td>
                        <td><?= htmlspecialchars($row['placed_on']) ?></td>
                        <td><?= htmlspecialchars($row['payment_status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
