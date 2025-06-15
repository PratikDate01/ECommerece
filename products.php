<?php include 'navbar.php'; ?>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
    <link rel="stylesheet" href="style.css">  <!-- Link external CSS -->
</head>
<body>

<h2>Products</h2>

<!-- Header with Buttons -->
<div class="header-buttons">
    <a href="cart.php" class="btn">🛒 View Cart</a>
    
</div>

<div class="products-container">
    <?php
    $result = $conn->query("SELECT * FROM products");

    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>₹" . $row['price'] . "</p>";
        echo "<a href='cart.php?id=" . $row['id'] . "' class='btn'>Add to Cart</a>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>

