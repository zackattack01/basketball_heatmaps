<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="name", message="This name is already being used")
 */
class Pro
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $team;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $gender;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $age;

    /**
     * @ORM\Column(type="integer")
     */
    protected $player_type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ProDataSet", mappedBy="pro", fetch="EAGER")
     * @ORM\OrderBy({"created" = "ASC"})
     **/
    private $proDataSets;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTeam($team)
    {
        $this->team = $team;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setPlayerType($player_type)
    {
        $this->player_type = $player_type;
    }

    public function getPlayerType()
    {
        return $this->player_type;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function __construct()
    {
       $this->proDataSets = new ArrayCollection();
    }

    public function getProDataSets() {
         return $this->proDataSets;
    }

}