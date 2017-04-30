<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ProDataSet;
use Doctrine\ORM\EntityManager;

/**
 * ProDataSetRepository
 */
class ProDataSetRepository extends \Doctrine\ORM\EntityRepository
{

  private $dbHookUp;

  public function __construct(EntityManager $entityManager)
  {
      $this->dbHookUp = $entityManager;
  }

  public function persistProDataSet($pro, $accuracyDataSet, $efficiencyDataSet, $createdAt)
  {   
      $dataSet = new ProDataSet();
      $dataSet->setPro($pro);
      $dataSet->setAccuracyData($accuracyDataSet);
      $dataSet->setEfficiencyData($efficiencyDataSet);
      $dataSet->setCreated($createdAt);

      $this->dbHookUp->persist($dataSet);
      $this->dbHookUp->flush();
  }

  public function getLatestPlayerStats($proId)
  {
    return $this->dbHookUp->createQueryBuilder()->
      select('pro_data_set.accuracyData, pro_data_set.efficiencyData')->
      from('AppBundle:ProDataSet', 'pro_data_set')->
      where("pro_data_set.proId = ".$proId)->
      orderBy('pro_data_set.created', 'DESC')->
      setMaxResults(1)->
      getQuery()->
      getOneOrNullResult();
  }
}
