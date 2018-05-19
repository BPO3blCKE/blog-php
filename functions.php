<?php

use Classes\Article;
use Classes\ConnectDb;

session_start();

spl_autoload_register(function ($class) {
print_r($class);
    // project-specific namespace prefix
    $prefix = 'Classes\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/Classes/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});


$articleManager = new Article(ConnectDb::getConnect());







function viewTitle()
{
    $arr = explode('.', $_SERVER['REQUEST_URI']);
    $str = substr($arr[0], 1);
    if ($str) {
        echo 'Custom Blog - '. ucfirst($str);
    } else {
        echo 'Custom Blog';
    }

//    $arr = [
//        '/' => 'Custom Blog',
//        '/about.php' => 'Custom Blog - About',
//        '/post.php' => 'Custom Blog - Post',
//        '/contact.php' => 'Custom Blog - Contact',
//    ];
//
//    if (isset($arr[$_SERVER['REQUEST_URI']])) {
//        echo $arr[$_SERVER['REQUEST_URI']];
//    } else {
//        echo 'Custom Blog';
//    }




//    if ($_SERVER['REQUEST_URI'] === '/') {
//        echo 'Custom Blog';
//    } elseif (strpos($_SERVER['REQUEST_URI'], 'about')) {
//        echo 'Custom Blog - About';
//    } elseif (strpos($_SERVER['REQUEST_URI'], 'post')) {
//        echo 'Custom Blog - Post';
//    } elseif (strpos($_SERVER['REQUEST_URI'], 'contact')) {
//        echo 'Custom Blog - Contact';
//    } else {
//        echo 'Custom Blog';
//    }
}










function insertUser($userData)
{
    $db = connectDb();
    if ($db) {
        $password = md5($userData['password']);
        $sql = "INSERT INTO users(name, last_name, login, email, password)
              VALUES ( :name,  :lastName, :login, :email, :password)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name', $userData['firstName'], PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $userData['lastName'], PDO::PARAM_STR);
        $stmt->bindParam(':login', $userData['login'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $userData['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        return $stmt->execute();
    }
}

function registerUser(array $userData)
{
    if ($userData['password'] !== $userData['passwordConfirm']) {
        $_SESSION['error_message'] = 'Inputted passwords not confirm!';
        return;
    }

    if (!isset($userData['login']) || empty($userData['login'])) {
        $_SESSION['error_message'] = 'Login can not be empty!';
        return;
    }

    if (!isset($userData['email']) || empty($userData['email'])) {
        $_SESSION['error_message'] = 'Email can not be empty!';
        return;
    }

    //TODO validation data before send to DB

    if (insertUser($userData)) {
        $_SESSION['error_message'] = false;
    } else {
        $_SESSION['error_message'] = 'Register user not complete';
    }
}

function getErrorMessage()
{
    return isset($_SESSION['error_message']) ? $_SESSION['error_message'] : false;
}