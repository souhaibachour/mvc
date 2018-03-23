<?php

namespace EtudBundle\Controller;

use EtudBundle\Entity\Professeur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use EtudBundle\Entity\Clase;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Professeur controller.
 *
 * @Route("professeur")
 */
class ProfesseurController extends Controller
{
    /**
     * Lists all professeur entities.
     *
     * @Route("/", name="professeur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $professeurs = $em->getRepository('EtudBundle:Professeur')->findAll();

        return $this->render('professeur/index.html.twig', array(
            'professeurs' => $professeurs,
        ));
    }

    /**
     * Creates a new professeur entity.
     *
     * @Route("/new", name="professeur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $professeur = new Professeur();
        $form = $this->createForm('EtudBundle\Form\ProfesseurType', $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($professeur);
            $em->flush();

            return $this->redirectToRoute('professeur_show', array('id' => $professeur->getId()));
        }

        return $this->render('professeur/new.html.twig', array(
            'professeur' => $professeur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a professeur entity.
     *
     * @Route("/{id}", name="professeur_show")
     * @Method("GET")
     */
    public function showAction(Professeur $professeur)
    {
        $deleteForm = $this->createDeleteForm($professeur);

        return $this->render('professeur/show.html.twig', array(
            'professeur' => $professeur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing professeur entity.
     *
     * @Route("/{id}/edit", name="professeur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Professeur $professeur)
    {
        $deleteForm = $this->createDeleteForm($professeur);
        $editForm = $this->createForm('EtudBundle\Form\ProfesseurType', $professeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('professeur_edit', array('id' => $professeur->getId()));
        }

        return $this->render('professeur/edit.html.twig', array(
            'professeur' => $professeur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a professeur entity.
     *
     * @Route("/{id}", name="professeur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Professeur $professeur)
    {
        $form = $this->createDeleteForm($professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($professeur);
            $em->flush();
        }

        return $this->redirectToRoute('professeur_index');
    }

    /**
     * Creates a form to delete a professeur entity.
     *
     * @param Professeur $professeur The professeur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Professeur $professeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('professeur_delete', array('id' => $professeur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


/**
     * @Route("/etudjocond")
     * @Template("@EtudBundle/Resources/views/Default/joconde.html.twig")
     */
     

     

    public function jocondeProfAction()
    {
        $clase = new clase();
        $clase->setNomClasse('mimi');

        $professeur = new Professeur();
        $professeur->setNomprofesseur('mimi');
       


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
    
    

}
