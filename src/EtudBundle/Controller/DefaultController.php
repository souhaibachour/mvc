<?php

namespace EtudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use EtudBundle\Entity\Professeur;
use EtudBundle\Entity\Clase;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/etud")
     * @Template("@EtudBundle/Resources/views/Default/index.html.twig")
     */
    public function indexAction()
    {

    }

    /**
     * @Route("/etudjocond")
     * @Template("@EtudBundle/Resources/views/Default/joconde.html.twig")
     */
     

     

    public function jocondeProfAction()
    {
        $clase = new clase();
        $clase->setNomClasse('JocandeJumelle');

        $professeur = new Professeur();
        $professeur->setNomprofesseur('MarwenMarsa');
       


        // relates this etudiant to the clase
        $professeur->addClase($clase);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($clase);
        $entityManager->persist($professeur);
        $entityManager->flush(); 
        
        return new Response(
            'Saved new professeur with name: '.$professeur->getNomprofesseur()
            .' and new clase with name: '.$clase->getNomClasse()
        ); 
    }
    
     /*public function jocondeEtudiantAction()
    {
        $clase = new clase();
        $clase->setNomClasse('halfaouine');

        $etudiant = new Etudiant();
        $etudiant->setUsername('marwen');
        $etudiant->setNom('marwen');
        $etudiant->setPrenom('bttt');
        $etudiant->setEmail('souhaib@gmail.com');
        $etudiant->setAge(20);
        $etudiant->setSexe('M');


        // relates this etudiant to the clase
        $etudiant->setClase($clase);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($clase);
        $entityManager->persist($etudiant);
        $entityManager->flush();

        return new Response(
            'Saved new etudiant with id: '.$etudiant->getNom()
            .' and new clase with id: '.$clase->getNomClasse()
        );
    }*/

    

    /**
     * @Route("corres/{etudiantId}")
     * @Template("@EtudBundle/Resources/views/Default/showclasecorrespondante.html.twig")
     * @Method("GET")
     */

    public function showAction($etudiantId)
{
    $etudiant = $this->getDoctrine()
        ->getRepository(Etudiant::class)
        ->find($etudiantId);

    $classeName = $etudiant->getClase()->getNomClasse();

   return new Response(
            'classe correspondante a letudiant: '.$classeName
        );
}

    /**
     * @Route("etudiants/{claseId}")
     * @Template("@EtudBundle/Resources/views/Default/etudiants.html.twig")
     * @Method("GET")
     */
public function showEtudiantsAction($claseId)
{
    $clase = $this->getDoctrine()
        ->getRepository(Clase::class)
        ->find($claseId);

    $etudiants = $clase->getEtudiants();

/* return $this->render('Default/etudiants.html.twig', array(
            'etudiants' => $etudiants,
        )); */ 

        return $this->render('@EtudBundle/Resources/views/Default/etudiants.html.twig', array(
            'etudiants' => $etudiants,
        ));

   
}


/**
     * @Route("clasecorres/{etudiantId}")
     * @Template("@EtudBundle/Resources/views/Default/editclasecorrespondante.html.twig")
     * @Method("GET")
     */

public function showClaseAction($etudiantId)
{
    $etudiant = $this->getDoctrine()
        ->getRepository(Etudiant::class)
        ->findOneByIdJoinedToClase($etudiantId);

    $clase = $etudiant->getClase();

     return new Response(
            'classe correspondante a letudiant: '.$clase->__toString()
        );
}
}
