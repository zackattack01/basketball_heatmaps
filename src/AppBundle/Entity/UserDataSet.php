<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDataSet
 *
 * @ORM\Table(name="user_data_set")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserDataSetRepository")
 */
class UserDataSet
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
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userDataSets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * @return UserDataSet
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserDataSet
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
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

