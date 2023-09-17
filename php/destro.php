<?php
    session_unset();
    session_destroy();

    header('../index.php')
?>