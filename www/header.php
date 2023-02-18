<header class="header">
            <div class="grid">
                <a class="logo" href="home.php">
                    <!-- <i class="fas fa-shopping-basket header__logo"></i>
                    MOMOPEE -->
                    <img src="../assets/img/Logo_signature.webp" alt="">
                </a>
                <nav class="navbar" id="navbar" style="margin-bottom:0px">
                    <a href="account.php" class="navbar__item">Quản lý tài khoản</a>
                    <a href="naptien.php" class="navbar__item">Nạp tiền</a>
                    <a href="ruttien.php" class="navbar__item">Rút tiền</a>
                    <a href="chuyentien.php" class="navbar__item">Chuyển tiền</a>
                    <a href="home.php" class="navbar__item">Mua thẻ điện thoại</a>
                    <a href="lsgd.php" class="navbar__item">Lịch sử giao dịch</a>
                </nav>
                <div class="header__search__user__cash">
                    <div class="mobile-menu header-item-info" id="mobile-menu">
                        <i class="fa fa-bars menu-icon header-icon"></i>
                    </div>
                
                    
                    <div class="header-item-info header__user">
                        <i class="header-icon fas fa-user"></i>
                        <div class="login">
                           <div class="user-item">
                                <a href="account.php">Tài khoản của tôi</a>
                           </div>
                           <div class="user-item">
                                <a href="../logout.php">Đăng xuất</a>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
</header>
<script>
        var mobileMenu = document.getElementById('mobile-menu');
        var header = document.getElementById('navbar');
        mobileMenu.onclick = function () {
            if (header.style.display != 'block') {
                header.style.display = 'block'
            }
            else
                header.style.display = 'none'

        }

    </script>