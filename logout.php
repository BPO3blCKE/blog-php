<?php require_once 'header.php' ?>
<?php
if (isset($_GET) && key_exists('logout', $_GET)) {
    session_destroy();

}

?>
<?php
header('Location: /index.php');
exit;
?>
<?php require_once 'footer.php' ?>


