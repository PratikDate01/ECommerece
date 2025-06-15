<?php 
include 'db.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = 1;  // Replace this with the current logged-in user's ID

    // Check if the product is already in the cart
    $checkQuery = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // If the product already exists in the cart, update the quantity
        $updateQuery = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
        $conn->query($updateQuery);
    } else {
        // If the product is not in the cart, insert it
        $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
        $conn->query($insertQuery);
    }

    // Add product to session cart for display
    $_SESSION['cart'][] = $product_id;
}

?>
<?php include 'navbar.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<h2>Shopping Cart</h2>

<!-- Back to Products Button -->
<a href="products.php" class="btn" style="display: inline-block; padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">← Back to Products</a>

<?php
// Display Cart
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', $_SESSION['cart']);
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);

    $total = 0;

    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='images/" . $row['image'] . "' width='150' alt='" . $row['name'] . "'>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Price: ₹" . $row['price'] . "</p>";
        $total += $row['price'];
        echo "</div>";
    }

    echo "<h3>Total: ₹" . $total . "</h3>";
    echo "<a href='checkout.php' class='btn'>Proceed to Checkout</a>";
} else {
    echo "<p>Cart is empty.</p>";
}

$conn->close();
?>

</body>
</html>
