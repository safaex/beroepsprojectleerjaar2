<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:inloggen.php');
}

if (isset($_GET['logout'])) {
   unset($_SESSION['user_id']);
   session_destroy();
   header('location:inloggen.php');
}

if (isset($_POST['add_to_cart'])) {
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE name = :product_name AND user_id = :user_id");
   $select_cart->bindParam(':product_name', $product_name);
   $select_cart->bindParam(':user_id', $user_id);
   $select_cart->execute();

   if ($select_cart->rowCount() > 0) {
      $message[] = 'Product already added to cart!';
   } else {
      $insert_cart = $conn->prepare("INSERT INTO `cart` (user_id, name, price, image, quantity) VALUES (:user_id, :product_name, :product_price, :product_image, :product_quantity)");
      $insert_cart->bindParam(':user_id', $user_id);
      $insert_cart->bindParam(':product_name', $product_name);
      $insert_cart->bindParam(':product_price', $product_price);
      $insert_cart->bindParam(':product_image', $product_image);
      $insert_cart->bindParam(':product_quantity', $product_quantity);

      if ($insert_cart->execute()) {
         $message[] = 'Product added to cart!';
      } else {
         $message[] = 'Failed to add product to cart!';
      }
   }
}

if (isset($_POST['update_cart'])) {
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];

   $update_cart = $conn->prepare("UPDATE `cart` SET quantity = :update_quantity WHERE id = :update_id");
   $update_cart->bindParam(':update_quantity', $update_quantity);
   $update_cart->bindParam(':update_id', $update_id);

   if ($update_cart->execute()) {
      $message[] = 'Cart quantity updated successfully!';
   } else {
      $message[] = 'Failed to update cart quantity!';
   }
}

if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];

   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id = :remove_id");
   $delete_cart->bindParam(':remove_id', $remove_id);

   if ($delete_cart->execute()) {
      header('location:index.php');
   } else {
      $message[] = 'Failed to remove item from cart!';
   }
}

if (isset($_GET['delete_all'])) {
   $delete_all_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = :user_id");
   $delete_all_cart->bindParam(':user_id', $user_id);

   if ($delete_all_cart->execute()) {
      header('location:index.php');
   } else {
      $message[] = 'Failed to delete all items from cart!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
   <link rel="stylesheet" href="index.css">
</head>
<body>
   
<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
   }
}
?>

<div class="container">

<div class="user-profile">

   <?php
      $select_user = $conn->prepare("SELECT * FROM `user_form` WHERE id = :user_id");
      $select_user->bindParam(':user_id', $user_id);
      $select_user->execute();

      if ($select_user->rowCount() > 0) {
         $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
      }
   ?>

   <p> username : <span><?php echo $fetch_user['username']; ?></span> </p>
   <p> email : <span><?php echo $fetch_user['email']; ?></span> </p>
   <div class="flex">
      <a href="inloggen.php" class="btn">Login</a>
      <a href="Home.php" class="option-btn">Home</a>
      <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to logout?');" class="delete-btn">Logout</a>
   </div>

</div>

<div class="products">

   <h1 class="heading">Latest Products</h1>

   <div class="box-container">

   <?php
      $select_product = $conn->prepare("SELECT * FROM `products`");
      $select_product->execute();

      if ($select_product->rowCount() > 0) {
         while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
   ?>
      <form method="post" class="box" action="">
         <img src="../images/12.jpg"<?php echo $fetch_product['image']; ?> alt="image">
         <img src="../images/12 PRO MAX.jpg" alt="" srcset="">
         <img src="../images/13-PRO-MAX.jpg" alt="" srcset="">

         <div class="name"><?php echo $fetch_product['name']; ?></div>
         <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
         <input type="number" min="1" name="product_quantity" value="1">
         <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
         <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
      </form>
   <?php
      }
   }
   ?>

   </div>

</div>

<div class="shopping-cart">

   <h1 class="heading">Shopping Cart</h1>

   <table>
      <thead>
         <th>Image</th>
         <th>Name</th>
         <th>Price</th>
         <th>Quantity</th>
         <th>Total Price</th>
         <th>Action</th>
      </thead>
      <tbody>
      <?php
         $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
         $cart_query->bindParam(':user_id', $user_id);
         $cart_query->execute();

         $grand_total = 0;

         if ($cart_query->rowCount() > 0) {
            while ($fetch_cart = $cart_query->fetch(PDO::FETCH_ASSOC)) {
      ?>
         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>$<?php echo $fetch_cart['price']; ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="Update" class="option-btn">
               </form>
            </td>
            <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Remove item from cart?');">Remove</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         } else {
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">No items added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Grand Total:</td>
         <td>$<?php echo $grand_total; ?>/-</td>
         <td><a href="index.php?delete_all" onclick="return confirm('Delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Delete All</a></td>
      </tr>
   </tbody>
   </table>

   <div class="cart-btn">  
      <a href="#" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
   </div>

</div>

</div>
</body>
</html>
