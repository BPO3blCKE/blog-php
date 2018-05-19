<?php require_once 'header.php' ?>


<?php
var_dump($_SESSION);
//var_dump ($_POST);
var_dump(getUser($_POST));

//if (isset($_POST) && !empty($_POST)) {
//    loginAdmin($_POST);
//}


//if (isset($_SESSION['access']) && $_SESSION['access']) {
//    header('Location: /index.php');
//    exit;
//}

if (isset($_POST) && !empty($_POST)){
loginUser($_POST);
}

?>

    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-10 mx-auto">
                <form method="POST" action="">
                    <label> Login  : <br>
                        <input name="login" value="" type="text" required>
                    </label>
                    <label> Password : <br>
                        <input name="password" value="" type="password" required>
                    </label><br>
                    <button type="submit">Enter</button>
                </form>
            </div>
            <hr>
<?php require_once 'footer.php' ?>


