    // Check if clear cart button was clicked
    if (isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = []; // Clear the cart
        // Redirect to the same page to update the cart state
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;

                            Clear Cart Button
                    <?php if ($cartItemCount > 0): ?>
                        <form method="POST" action="" style="margin-top: 10px;">
                            <button type="submit" name="clear_cart" style="background: none; border: 1px solid #ccc; padding: 5px 10px; cursor: pointer;">Clear Cart</button>
                        </form>
                    <?php endif; ?>