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
    public function findAllMovies(): array
    {
        $movies = [];
        try {
            //Requête SQL
            $sql = "SELECT m.id, m.title, m.description, m.publish_at 
                    FROM movie AS m 
                    ORDER BY m.publish_at DESC";
            //Préparation
            $req = $this->connect->prepare($sql);
            //Exécution de la requête
            $req->execute();
            //Fetch
            $movieData = $req->fetchAll(\PDO::FETCH_ASSOC);
            //Boucle pour hydrater les objets Movie
            foreach ($movieData as $data) {
                $movie = new Movie();
                $movie->setId((int)$data['id']);
                $movie->setTitle($data['title']);
                $movie->setDescription($data['description']);
                $movie->setPublishAt(new \DateTime($data['publish_at']));
                //Ajouter l'objet Movie au tableau des movies
                $movies[] = $movie;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return $movies;
    }
}
