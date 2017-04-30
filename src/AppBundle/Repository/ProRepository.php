<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Pro;
use Doctrine\ORM\EntityManager;

/**
 * ProRepository
 */
class ProRepository extends \Doctrine\ORM\EntityRepository
{

  private $dbHookUp;

  public function __construct(EntityManager $entityManager)
  {
      $this->dbHookUp = $entityManager;
  }

  public function persistPro($formData)
  {   
      $pro = new Pro();
      $pro->setName($formData['name']);
      $pro->setTeam($formData['team']);
      $pro->setGender($formData['gender']);
      $pro->setAge($formData['age']);
      $pro->setPlayerType($formData['player_type']);
      $pro->setPosition($formData['position']);

      $this->dbHookUp->persist($pro);
      $this->dbHookUp->flush();

      return $pro;
  }
}
