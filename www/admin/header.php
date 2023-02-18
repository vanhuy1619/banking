<header class="header">
            <div class="grid">
                <a class="logo" href="./admin.php">
                    <!-- <i class="fas fa-shopping-basket header__logo"></i>
                    MOMOPEE -->
                    <img src="../assets/img/Logo_signature.webp" alt="">
                </a>
                <nav class="navbar" id="navbar" style="margin-bottom:0px; margin-left: 10px">
                    <a href="./admin.php" class="navbar__item" style="margin-right:10px">Quản lý tài khoản</a>
                    <a href="./pheduyet.php" class="navbar__item">Phê duyệt dòng tiền</a>
                </nav>
                <div class="header__search__user__cash">
                    <div class="mobile-menu header-item-info" id="mobile-menu">
                        <i class="fa fa-bars menu-icon header-icon"></i>
                    </div>
                    <div class="header-item-info header__user">
                        <i class="header-icon fas fa-user"></i>
                        <div class="login">
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