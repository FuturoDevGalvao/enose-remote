<header>
    <div class="logo-contain">
        <img src="../public/assets/logo.png" alt="logo">
        <span class="separator">
            /
        </span>
        <span id="user">
            <?= "Olá, {$user->getName()} " ?>
        </span>
    </div>
    <div class="services-contain">
        <div class="notification">
            <a href="/notifications">
                <i class="fa-solid fa-bell"></i>
            </a>
        </div>
        <div class="about">
            <a href="">
                <i class="fa-solid fa-circle-info"></i>
            </a>
        </div>
        <div class="user">
            <a href="/user">
                <img src="<?= $pahtToProfileImage ?>" alt="user">
            </a>
        </div>
    </div>

    <i class="fa-solid fa-bars" id="btn-menu-mobile"></i>
</header>