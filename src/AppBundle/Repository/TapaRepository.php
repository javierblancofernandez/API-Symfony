<?php

namespace AppBundle\Repository;

/**
 * TapaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TapaRepository extends \Doctrine\ORM\EntityRepository
{
    //Funcion que devuelve las tapas para una pagina con un número de elementos
    public function paginaTapas($numTapas=3,$pagina=1)
    {
        $query = $this->createQueryBuilder('t')
        ->where('t.top = 1')
        ->setFirstResult($numTapas*($pagina-1))
        ->setMaxResults($numTapas)
        ->getQuery();
        return $query->getResult();
    }
}
