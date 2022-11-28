<?php


namespace App\Controllers;


use App\Models\Article;
use jcobhams\NewsApi\NewsApi;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class ApiController
{

    public array $articles;


    public function __construct($method, $dotenv)
    {
        $newsapi = new NewsApi($dotenv->load()["SECRET_KEY"]);
        $articlesApi = $newsapi->getEverything($method);


        $articles = [];

        foreach ($articlesApi->articles as $article) {
            $articles [] = new Article(
                $article->title,
                $article->url,
                $article->description,
                $article->urlToImage
            );


            $this->articles = $articles;
        }
        return $this->getInformation($articles);
    }

        public function getInformation($articles)
    {
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        echo $twig->render('index.html.php', ['article' => $articles]);
        return $this->articles;
    }


}

