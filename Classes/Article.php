<?php

namespace Classes;

use PDO;
use DateTime;

class Article
{
    /**
     * @var \PDO $connect
     */
    private $connect;

    /**
     * Article constructor.
     *
     * @param $connect
     */
    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    /**
     * Get Articles
     *
     * @return array|bool
     */
    public function getArticles()
    {
        if ($this->connect) {
            $sql = "SELECT *
                FROM articles
                ";

            return $this->connect->query($sql)->fetchAll(PDO::FETCH_OBJ);
        }

        return false;
    }

    public function getAuthor($id)
    {
        if ($this->connect) {
            $sql = "SELECT *
                FROM users
                WHERE id='$id'
                ";

            return $this->connect->query($sql)->fetch(PDO::FETCH_OBJ);
        }

        return false;
    }

    public function getArticleByUrl($str)
    {
        if ($this->connect) {
            $sql = "SELECT *
                FROM articles
                WHERE url='$str'
                ";

            return $this->connect->query($sql)->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }
    public function getArticleById($id)
    {
        if ($this->connect) {
            $sql = "SELECT *
                FROM articles
                WHERE id='$id'
                ";

            return $this->connect->query($sql)->fetch(PDO::FETCH_OBJ);
        }

        return false;
    }

    public function updateArticle($post, $id)
    {
        if ($this->connect) {
            $sql = "UPDATE article 
              SET title = '" . $post['title'] . "', content = '" . $post['content'] . "' 
              WHERE id = $id";

            return $this->connect->prepare($sql)->execute(PDO::FETCH_OBJ);
        }

        return false;
    }

    public function deleteArticle($id)
    {

        if ($this->connect) {
            $sql = "DELETE FROM article WHERE id=$id";

            return $this->connect->prepare($sql)->execute();
        }

        return false;
    }

    public function insertArticle($userData)
    {
        if ($this->connect) {
            $authorId = 8;
            if (isset($_SESSION['user_login'])) {
                $authorId = $this->getAuthor($_SESSION['user_login']);
            }
            $sql = "INSERT INTO articles(title, sub_title, content, created_at, author, url)
                  VALUES ( :title, :subTitle,  :content, :createdAt, :authorId, :url)";

            $stmt = $this->connect->prepare($sql);

            $datetime = new DateTime();
            $createdAt = $datetime->format('Y-m-d H:i:s');


            $url = $this->getUrl($userData['title']);

            $stmt->bindParam(':title', $userData['title'], PDO::PARAM_STR);
            $stmt->bindParam(':subTitle', $userData['sub_title'], PDO::PARAM_STR);
            $stmt->bindParam(':content', $userData['content'], PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':authorId', $authorId, PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);

            if ($stmt->execute()) {
                header('Location: /admin/articles.php');
            }
        }
    }

    private function getUrl($str)
    {
        $articleUrl = str_replace(' ', '-', $str);
        $articleUrl = $this->transliteration($articleUrl);
        $articleIsset = $this->getArticleByUrl($articleUrl);
        if (!$articleIsset) {
            return $articleUrl;
        } else {
            $url = $articleIsset['url'];
            $exUrl = explode('-', $url);
            if ($exUrl) {
                $temp = (int)end($exUrl);
                $newUrl = $exUrl[0] . '-' . ++$temp;
            } else {
                $temp = 0;
                $newUrl = $articleUrl . '-' . ++$temp;
            }

            return getUrl($newUrl);
        }
    }

    private function transliteration($str)
    {
        $st = strtr($str,
            array(
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
                'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
                'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
                'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
                'ф' => 'ph', 'х' => 'h', 'ы' => 'y', 'э' => 'e', 'ь' => '',
                'ъ' => '', 'й' => 'y', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh',
                'щ' => 'sh', 'ю' => 'yu', 'я' => 'ya', ' ' => '_', '<' => '_',
                '>' => '_', '?' => '_', '"' => '_', '=' => '_', '/' => '_',
                '|' => '_'
            )
        );
        $st2 = strtr($st,
            array(
                'А' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'g', 'Д' => 'd',
                'Е' => 'e', 'Ё' => 'e', 'Ж' => 'zh', 'З' => 'z', 'И' => 'i',
                'К' => 'k', 'Л' => 'l', 'М' => 'm', 'Н' => 'n', 'О' => 'o',
                'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't', 'У' => 'u',
                'Ф' => 'ph', 'Х' => 'h', 'Ы' => 'y', 'Э' => 'e', 'Ь' => '',
                'Ъ' => '', 'Й' => 'y', 'Ц' => 'c', 'Ч' => 'ch', 'Ш' => 'sh',
                'Щ' => 'sh', 'Ю' => 'yu', 'Я' => 'ya'
            )
        );
        $translit = $st2;

        return $translit;
    }
}

