<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Model\Movie;

class MovieRepository
{
    private \PDO $connect;

    public function __construct()
    {
        $this->connect = (new Mysql())->connectBDD();
    }

    public function saveMovie(Movie $movie): int
    {
        try {
            $sql = "INSERT INTO movie(title, description, publish_at, duration, cover, categories)
                    VALUE(?,?,?,?,?,?)";

            $req = $this->connect->prepare($sql);

            $req->bindValue(1, $movie->getTitle());
            $req->bindValue(2, $movie->getDescription());
            $req->bindValue(3, $movie->getPublishAt());
            $req->bindValue(4, $movie->getDuration(), \PDO::PARAM_INT);
            $req->bindValue(5, $movie->getCover());

            $req->execute();

            return $this->connect->lastInsertId();
        } catch (\Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function saveMovieCategories(int $movieId, array $categories): void
    {
        try {
            $sql = "INSERT INTO movie_category(id_movie, id_category) VALUE(?,?)";
            $req = $this->connect->prepare($sql);

            foreach ($categories as $categoryId) {
                $req->bindValue(1, $movieId, \PDO::PARAM_INT);
                $req->bindValue(2, $categoryId, \PDO::PARAM_INT);
                $req->execute();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
