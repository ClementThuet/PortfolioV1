<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @ORM\Table(name="Categorie")
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity="App\Entity\Ecriture", mappedBy="categorie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
    */
    private $ecritures;
   
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
    function getEcritures() {
        return $this->ecritures;
    }

    function setEcritures($ecritures) {
        $this->ecritures = $ecritures;
    }

    public function addEcriture(Ecriture $ecriture)
    {
        if ($this->ecritures->contains($ecriture)) {
            return;
        }

        $this->ecritures[] = $ecriture;
        // set the *owning* side!
        $ecriture->setCategorie($this);
    }





}
