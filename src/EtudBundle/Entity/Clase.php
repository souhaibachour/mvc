<?php

namespace EtudBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Clase
 *
 * @ORM\Table(name="clase")
 * @ORM\Entity(repositoryClass="EtudBundle\Repository\ClaseRepository")
 */
class Clase
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClasse", type="string", length=255)
     */
    private $nomClasse;


    /**
     * @ORM\OneToMany(targetEntity="Etudiant", mappedBy="clase")
     */
    private $etudiants;



    /**
     * Many Clases have Many Professeurs.
     * @ORM\ManyToMany(targetEntity="Professeur", mappedBy="clases")
     */
    private $professeurs;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etudiants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->professeurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomClasse
     *
     * @param string $nomClasse
     *
     * @return Clase
     */
    public function setNomClasse($nomClasse)
    {
        $this->nomClasse = $nomClasse;

        return $this;
    }

    /**
     * Get nomClasse
     *
     * @return string
     */
    public function getNomClasse()
    {
        return $this->nomClasse;
    }

    /**
     * Add etudiant
     *
     * @param \EtudBundle\Entity\Etudiant $etudiant
     *
     * @return Clase
     */
    public function addEtudiant(\EtudBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants[] = $etudiant;

        return $this;
    }

    /**
     * Remove etudiant
     *
     * @param \EtudBundle\Entity\Etudiant $etudiant
     */
    public function removeEtudiant(\EtudBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants->removeElement($etudiant);
    }

    /**
     * Get etudiants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtudiants()
    {
        return $this->etudiants;
    }

    /**
     * Add professeur
     *
     * @param \EtudBundle\Entity\Professeur $professeur
     *
     * @return Clase
     */
    public function addProfesseur(\EtudBundle\Entity\Professeur $professeur)
    {
        $this->professeurs[] = $professeur;
        
    }

    /**
     * Remove professeur
     *
     * @param \EtudBundle\Entity\Professeur $professeur
     */
    public function removeProfesseur(\EtudBundle\Entity\Professeur $professeur)
    {
        $this->professeurs->removeElement($professeur);
    }

    /**
     * Get professeurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfesseurs()
    {
        return $this->professeurs;
    }

    public function __toString()
    {
        return $this->nomClasse;
    }

}
