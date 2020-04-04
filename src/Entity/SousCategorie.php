<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\SousCategorieRepository")
 * @ORM\Table(name="SousCategorie")
 */
class SousCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
    */
    private $id;
    
    /**
     * @ORM\Column(type="string")
    */
    private $nom;
   
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }



}