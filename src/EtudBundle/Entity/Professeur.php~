<?php

namespace EtudBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Professeur
 *
 * @ORM\Table(name="professeur")
 * @ORM\Entity(repositoryClass="EtudBundle\Repository\ProfesseurRepository")
 */
class Professeur
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
     * @ORM\Column(name="nomprofesseur", type="string", length=255)
     */
    private $nomprofesseur;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomprofesseur
     *
     * @param string $nomprofesseur
     *
     * @return Professeur
     */
    public function setNomprofesseur($nomprofesseur)
    {
        $this->nomprofesseur = $nomprofesseur;

        return $this;
    }

    /**
     * Get nomprofesseur
     *
     * @return string
     */
    public function getNomprofesseur()
    {
        return $this->nomprofesseur;
    }
    
    /**
     * Many Professeurs have Many Clases.
     * @ORM\ManyToMany(targetEntity="Clase", inversedBy="professeurs")
     * @ORM\JoinTable(name="professeurs_clases")
     */
    private $clases;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clases = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add clase
     *
     * @param \EtudBundle\Entity\Clase $clase
     *
     * @return Professeur
     */
    public function addClase(\EtudBundle\Entity\Clase $clase)
    {
        // On lie le professeur a la clase
        $clase->addProfesseur($this);
        $this->clases[] = $clase;
        
    }

    /**
     * Remove clase
     *
     * @param \EtudBundle\Entity\Clase $clase
     */
    public function removeClase(\EtudBundle\Entity\Clase $clase)
    {
        $this->clases->removeElement($clase);
    }

    /**
     * Get clases
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClases()
    {
        return $this->clases;
    }

     public function __toString()
    {
        return $this->nomprofesseur;
    }
}
