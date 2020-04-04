<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcritureRepository")
 * @ORM\Table(name="Ecriture")
 */
class Ecriture
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="ecritures")
     * @ORM\JoinColumn(nullable=false)
    */
    private $categorie;
    
    
    /**
     * @ORM\Column(type="float",nullable=false)
    */
    private $montant;
    
    /**
     * @ORM\Column(type="date",nullable=false)
    */
    private $date;
    
    /**
     * @ORM\Column(type="string",nullable=true)
    */
    private $description;
    
    /**
     * @ORM\Column(type="boolean",nullable=false)
    */
    private $sensflux;
    
    /**
     * @ORM\Column(type="boolean",nullable=false)
    */
    private $partageable;
    
     /**
     * @ORM\Column(type="boolean",nullable=false)
    */
    private $imposable;
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getCategorie() {
        return $this->categorie;
    }

    function getSousCategorie() {
        return $this->sousCategorie;
    }

    function getMontant() {
        return $this->montant;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    function setSousCategorie($sousCategorie) {
        $this->sousCategorie = $sousCategorie;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getPartageable() {
        return $this->partageable;
    }

    function setPartageable($partageable) {
        $this->partageable = $partageable;
    }

    function getSensflux() {
        return $this->sensflux;
    }

    function setSensflux($sensflux) {
        $this->sensflux = $sensflux;
    }

    function getImposable() {
        return $this->imposable;
    }

    function setImposable($imposable) {
        $this->imposable = $imposable;
    }



    
 


   




}
