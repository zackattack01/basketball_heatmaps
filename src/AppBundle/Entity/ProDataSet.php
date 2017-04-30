<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProDataSet
 *
 * @ORM\Table(name="pro_data_set")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProDataSetRepository")
 */
class ProDataSet
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
     * @var \Date
     *
     * @ORM\Column(name="created", type="date")
     */
    private $created;

    /**
     * @var int
     *
     * @ORM\Column(name="pro_id", type="integer")
     */
    private $proId;

    /**
     * @var \Pro
     *
     * @ORM\ManyToOne(targetEntity="Pro", inversedBy="proDataSets")
     * @ORM\JoinColumn(name="pro_id", referencedColumnName="id")
     */
    private $pro;

    /**
     * @var array
     *
     * @ORM\Column(name="efficiency_data", type="json_array")
     */
    private $efficiencyData;

    /**
     * @var array
     *
     * @ORM\Column(name="accuracy_data", type="json_array")
     */
    private $accuracyData;


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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ProDataSet
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set proId
     *
     * @param integer $userId
     *
     * @return UserDataSet
     */
    public function setProId($proId)
    {
        $this->proId = $proId;

        return $this;
    }

    public function setPro($pro)
    {
        $this->pro = $pro;

        return $this;
    }

    /**
     * Get proId
     *
     * @return int
     */
    public function getProId()
    {
        return $this->proId;
    }

    /**
     * Set efficiencyData
     *
     * @param array $efficiencyData
     *
     * @return UserDataSet
     */
    public function setEfficiencyData($efficiencyData)
    {
        $this->efficiencyData = $efficiencyData;

        return $this;
    }

    /**
     * Get efficiencyData
     *
     * @return array
     */
    public function getEfficiencyData()
    {
        return $this->efficiencyData;
    }

    /**
     * Set accuracyData
     *
     * @param array $accuracyData
     *
     * @return UserDataSet
     */
    public function setAccuracyData($accuracyData)
    {
        $this->accuracyData = $accuracyData;

        return $this;
    }

    /**
     * Get accuracyData
     *
     * @return array
     */
    public function getAccuracyData()
    {
        return $this->accuracyData;
    }

}

