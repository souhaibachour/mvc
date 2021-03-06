<?php

namespace EtudBundle\Repository;

/**
 * EtudiantRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EtudiantRepository extends \Doctrine\ORM\EntityRepository
{
	public function findOneByIdJoinedToClase($etudiantId)
{
    $query = $this->getEntityManager()
        ->createQuery(
        'SELECT e, c FROM EtudBundle:Etudiant e
        JOIN e.clase c
        WHERE e.id = :id'
    )->setParameter('id', $etudiantId);

    try {
        return $query->getSingleResult();
    } catch (\Doctrine\ORM\NoResultException $exception) {
        return null;
    }
}
}
