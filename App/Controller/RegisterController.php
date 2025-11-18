<?php

namespace App\Controller;

use App\Model\Grant;
use App\Model\Account;
use App\Utils\Tools;

class RegisterController
{
    private Account $accountModel;

    public function __construct()
    {
        $this->accountModel = new Account();
    }

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

    public function addAccount()
    {
        //Verifier si le formulaire est submit
        if (isset($_POST["submit"])) {
            $firstname = $_POST["firstname"] ?? "";
            $lastname = $_POST["lastname"] ?? "";
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";
            $confirmPassword = $_POST["confirm-password"] ?? "";

            //vérifier si les champs sont remplis
            if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && !empty($confirmPassword)) {

                //Si ok on continu  
                //Sinon on affiche un message d'erreur
                //vérifier si les 2 password sont identiques
                if ($password === $confirmPassword) {
                    //Si identique on continu
                    //Si différent on affiche un message d'erreur  
                    if ($password !== $confirmPassword) {
                        $data["error"] = "Les deux mots de passe ne sont pas identiques.";
                    }
                    //vérifier si le compte n'existe pas
                    if (!$this->accountModel->isAccountExistsByEmail($email)) {
                        //si il n'existe pas -> 
                        $grant = new Grant(null);
                        $grant->setId(1);
                        //créer un objet Account
                        $account = new Account();
                        //setter les valeurs
                        $account->setFirstname($firstname);
                        $account->setLastname($lastname);
                        $account->setEmail($email);
                        //setter grant_id = 1
                        $account->setGrant($grant);
                        //hasher le password password_hash(mot de passe en clair, PASSWORD_DEFAULT)
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $account->setPassword($hashedPassword);
                        //Afficher une message qui indique que le compte à été ajouté en BDD
                        $this->accountModel->saveAccount($account);
                        $data["valid"] = "Le compte a été ajouté en BDD.";
                        //Si il existe 
                        //Afficher un message d'erreur qui indique que le compte existe déja

                    }
                }
            }
        }














        return $this->render("register_account", "Inscription");
    }
}
