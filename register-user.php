<?php require_once 'header.php' ?>
<?php
if ($_POST) {
    registerUser($_POST);
}
?>

    <!-- Page Header -->
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
                <?php if(getErrorMessage()): ?>
                    <p style="color: red"><?= getErrorMessage(); ?></p>
                <?php endif; ?>
                <form method="POST" action="/register-user.php">
                    <label>
                        First name:<br>
                        <input name="firstName" value="" type="text"/>
                    </label>
                    <label>
                        Last name:<br>
                        <input name="lastName" value="" type="text"/>
                    </label>
                    <label>
                        Email *:<br>
                        <input name="email" value="" type="email" required/>
                    </label>
                    <label>
                        login *:<br>
                        <input name="login" value="" type="text" required/>
                    </label>
                    <label>
                        Password *:<br>
                        <input name="password" value="" type="password" required/>
                    </label>
                    <label>
                        Password confirm*:<br>
                        <input name="passwordConfirm" value="" type="password"/>
                    </label>
                    <button>Register</button>
                </form>
            </div>
        </div>
    </div>

<?php require_once 'footer.php' ?>