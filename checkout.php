<?php include 'navbar.php'; ?>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="checkout-container">
    <h2>Checkout</h2>

    <?php
    session_start();
    
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>No items in the cart.</p>";
        echo "<a href='products.php' class='btn'>Start Shopping</a>";
        exit();
    }

    $ids = implode(',', $_SESSION['cart']);
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);

    $total = 0;

    echo "<h3>Order Summary:</h3>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='images/" . $row['image'] . "' width='100'>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Price: ₹" . $row['price'] . "</p>";
        $total += $row['price'];
        echo "</div><hr>";
    }

    echo "<h3>Total Amount: ₹" . $total . "</h3>";
    echo "<p>Order placed successfully!</p>";

    // Clear the cart after successful checkout
    $_SESSION['cart'] = [];
    ?>
    
    <a href="products.php" class="btn">Start Shopping</a>
</div>

</body>
</html>

