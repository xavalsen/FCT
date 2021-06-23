
    <?php
        session_start();
        session_destroy();
        header("location: http://localhost/practicas/auth/login.html");
    ?>
