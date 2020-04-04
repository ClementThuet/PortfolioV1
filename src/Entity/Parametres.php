<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParametresRepository")
 * @ORM\Table(name="Parametres")
 */
class Parametres
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
    
    /**
     * @ORM\Column(type="float")
    */
    private $valeur;
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getValeur() {
        return $this->valeur;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setValeur($valeur) {
        $this->valeur = $valeur;
    }


    
    





}
