<?php
require_once 'header.php';
use Classes\Article;
use Classes\ConnectDb;
$articleDb = new Article(ConnectDb::getConnect());

if(!$_GET['id']) {
    die("Article not found!");
}
$article = $articleDb->getArticleById($_GET['id']);
;
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

               $articleDb->updateArticle($_POST, $_GET['id']);
            }
        ?>

        <!-- Example DataTables Card-->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="edit_article.php">
                    <label>
                        Title: <br>
                        <input name="title" type="text" value="<?=$article->title?>" placeholder="" />
                    </label>
                    <br>
                    <label>
                        Sub Title: <br>
                        <textarea rows="10" cols="40" name="sub_title"><?=$article->sub_title?></textarea>
                    </label>
                    <br>
                    <label>
                        Content: <br>
                        <textarea rows="10" cols="40" name="content"><?=$article->content?></textarea>
                    </label>
                    <br>
                    <button>Send</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->


<?php require_once 'footer.php' ?>