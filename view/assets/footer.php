</div>
<footer class="py-3 my-4 mt-auto">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <?php if (!isset($_SESSION['user_id'])) {
            ?>
            <li class="nav-item"><a href="../../login.php" class="nav-link px-2 text-muted">Login</a></li>
            <?php
        }
        ?>
    </ul>
    <p class="text-center text-muted">
        <a href="https://goo.gl/maps/wd7hkSa1TCqmPjWJ9">
            <i class="fas fa-map-marked-alt"></i>
            <?= utf8_encode(" R. de São Bento 329, 1250-220 Lisboa") ?>
        </a>
    </p>
    <p class="text-center text-muted"><i class="fas fa-terminal"></i> Developed by <a href="https://github.com/Alkss">Alex
            Oliveira</a></p>
</footer>
</body>
</html>