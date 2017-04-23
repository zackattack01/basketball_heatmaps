<?php

namespace AppBundle\Repository;

use AppBundle\Entity\UserDataSet;
use Doctrine\ORM\EntityManager;

/**
 * UserDataSetRepository
 */
class UserDataSetRepository extends \Doctrine\ORM\EntityRepository
{

  private $dbHookUp;

  public function __construct(EntityManager $entityManager)
  {
      $this->dbHookUp = $entityManager;
  }

  public function persistUserDataSet($user, $accuracyDataSet, $efficiencyDataSet, $createdAt)
  {   
      $dataSet = new UserDataSet();
      $dataSet->setUser($user);
      $dataSet->setAccuracyData($accuracyDataSet);
      $dataSet->setEfficiencyData($efficiencyDataSet);
      $dataSet->setCreated($createdAt);

      $this->dbHookUp->persist($dataSet);
      $this->dbHookUp->flush();
  }
}
