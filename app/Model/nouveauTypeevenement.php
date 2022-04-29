<?php

namespace Model;

use Librairy\personnaliser;

class nouveauTypeevenement extends personnaliser
{
    private $db; // déclaration de la variable de connexion
    public array $post;
    public int $idclient;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function setIdclient($idclient)
    {
        $this->idclient = $idclient;
    }

    public function getPost(): array
    {
        return $this->post;

    }

    public function getIdclient(): int
    {

        return $this->idclient;

    }

    public function getFormtypeeve(): bool
    {
        if (!empty($this->getPost())) {
            $post = $this->getPost();
            $couleur = $post['couleur'];
            $type = $post['type'];
            $typeEve = $this->db->prepare('insert into typeevenement (Nom_TypeEvenement, Couleur_TypeEvenement, Id_Client) VALUES (?,?,?)');

            if($typeEve->execute(array($type, $couleur, $this->getIdclient()))){
                $this->redirect('/jour');
            }
        }
        return false;
    }

}