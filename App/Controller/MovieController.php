<?php

namespace App\Controller;

use App\Model\Movie;
use App\Model\Category;
use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use App\Utils\Tools;

class MovieController
{
    //Attributs
    private MovieRepository $movieRepository;
    private CategoryRepository $categoryRepository;

    //Constructeur
    public function __construct()
    {
        $this->movieRepository = new MovieRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    //Méthodes
    /**
     * Méthode pour rendre une vue avec un template
     * @param string $template Le nom du template à inclure
     * @param string|null $title Le titre de la page
     * @param array $data Les données à passer au template
     * @return void
     */
    public function render(string $template, ?string $title, array $data = []): void
    {
        include __DIR__ . "/../../template/template_" . $template . ".php";
    }

    //Méthode pour ajouter un film (Movie)
    public function addMovie()
    {
        //Tableau avec les messages pour la vue
        $data = [];
        //Tester si le formulaire est soumis
        if (isset($_POST["submit"])) {
            //Test les champs obligatoires sont renseignés
            if (
                !empty($_POST["title"]) &&
                !empty($_POST["description"]) &&
                !empty($_POST["publish_at"]) &&
                !empty($_POST["cover"])
            )
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des champs du formulaire
        $title       = htmlspecialchars(trim($_POST['title'] ?? ''));
        $description = htmlspecialchars(trim($_POST['description'] ?? ''));
        $publishAt   = htmlspecialchars(trim($_POST['publish_at'] ?? ''));

        // Création de l'objet Movie
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->setDescription($description);
        $movie->setPublishAt($publishAt);

        // --- Gestion de l'image ---
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            // Extension du fichier
            $ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);

            // Générer un nom unique : titre + uuid + extension
            $uuid = uniqid();
            $safeTitle = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($title));
            $fileName = $safeTitle . "_" . $uuid . "." . $ext;

            // Destination
            $destination = __DIR__ . "/../../public/asset/" . $fileName;

            // Vérifier si le fichier existe déjà
            if (file_exists($destination)) {
                $fileName = $safeTitle . "_" . uniqid() . "." . $ext;
                $destination = __DIR__ . "/../../public/asset/" . $fileName;
            }

            // Déplacer le fichier
            if (move_uploaded_file($_FILES['cover']['tmp_name'], $destination)) {
                $movie->setCover($fileName);
            } else {
                $movie->setCover("default.png");
            }
        } else {
            // Aucun fichier uploadé
            $movie->setCover("default.png");
        }

        // Sauvegarde en BDD
        $this->movieRepository->saveMovie($movie);

        // Rendu avec message de succès
        $this->render("add_movie", "Ajouter un film", [
            "success" => "Film ajouté avec succès !"
        ]);
    } else {
        // Afficher le formulaire
        $this->render("add_movie", "Ajouter un film");
    }
            {

                //Nettoyer les entrées utilsiateur ($_POST du formulaire)
                $title = Tools::sanitize($_POST["title"]);
                $description = Tools::sanitize($_POST["description"]);
                $publishAt = Tools::sanitize($_POST["publish_at"]);
                $cover = Tools::sanitize($_POST["cover"]);

                //Créer un objet Movie
                $movie = new Movie();
                //Setter les valeurs
                $movie->setTitle($title);
                $movie->setDescription($description);
                $movie->setPublishAt(new \DateTime($publishAt));
                //Setter les categories à $movie
                foreach ($_POST["categories"] as $category) {
                    //Créer un objet Category
                    $newCategory = new Category("");
                    //Setter l'ID
                    $newCategory->setId((int) $category);
                    //Ajouter la categorie à la liste des Category de Movie
                    $movie->addCategory($newCategory);
                }
                //Appeler la méthode saveMovie du MovieRepository
                $this->movieRepository->saveMovie($movie);
                $data["valid"] = "Le film : " . $movie->getTitle() . " a été ajouté en BDD";
            }
            //Afficher un message d'erreur
            else {
                $data["error"] = "Veuillez renseigner les champs du formulaire";
            }
        }
        //Récupération des catégories
        $categories = $this->categoryRepository->findAllCategories();
        //Ajout au tableau $data
        $data["categories"] = $categories;

        return $this->render("add_movie", "Add Category", $data);
    }
    public function showAllMovies()
    {
        $movies = $this->movieRepository->findAllMovies();
        $data["movies"] = $movies;
        //afficher le template avec render
        return $this->render("all_movies", "Movies", $movies);
    }
}
