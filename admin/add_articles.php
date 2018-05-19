<?php
require_once 'header.php';
use Classes\Article;
use Classes\ConnectDb;
$article = new Article(ConnectDb::getConnect());


?>


    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin/main.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add new</li>
        </ol>
        <?php
            if ($_POST) {

                $article->insertArticle($_POST);
            }
        ?>

        <!-- Example DataTables Card-->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="add_articles.php">
                    <label>
                        Title: <br>
                        <input name="title" type="text" value="" placeholder="" />
                    </label>
                    <br>
                    <label>
                        Sub Title: <br>
                        <textarea rows="10" cols="40" name="sub_title"></textarea>
                    </label>
                    <br>
                    <label>
                        Content: <br>
                        <textarea rows="10" cols="40" name="content"></textarea>
                    </label>
                    <br>
                    <button>Send</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->

<?php require_once 'footer.php' ?>