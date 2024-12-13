<?php
function renderNavbar($sessionData) {
    ?>
    <nav>
        <div class="nav-container">
            <a href="#" class="logo">
                <button class="logo-btn">F</button>
                <span>3arbity</span>
            </a>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="cars.php">Cars</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="hamburger">&#9776;</div>

            <?php if (isset($sessionData['username'])): ?>
                <div class="user-menu">
                    <span><?php echo htmlspecialchars($sessionData['username']); ?></span>
                    <img src="./img/user.png" alt="User Photo">
                    <div class="dropdown">
                        <div>
                            <span><?php echo htmlspecialchars($sessionData['username']); ?></span><br>
                            <small><?php echo htmlspecialchars($sessionData['email']); ?></small>
                        </div>
                        <ul>
                            <?php if (in_array(strtolower($sessionData['role']), ['admin', 'superadmin'])): ?>
                                <li><a href="admin.php">Dashboard</a></li>
                            <?php endif; ?>
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Earnings</a></li>
                            <li>
                                <form action="" method="POST" style="display:inline;">
                                    <button class="signout" type="submit" name="logout">Sign Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                    <a href="login.php">Sign In</a>
                    <a href="signup.php">Sign Up</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <?php
}
