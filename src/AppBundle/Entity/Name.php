<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact
 *
 * @ORM\Entity()
 * @ORM\Table(name="name")
 */
class Name
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $gender;

    /**
     * @var CastInfo[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CastInfo", mappedBy="name")
     * @ORM\JoinColumn(name="person_id")
     */
    protected $castsInfos;

    /**
     * @var PersonInfo[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonInfo", mappedBy="name")
     * @ORM\JoinColumn(name="person_id")
     */
    protected $personsInfos;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Name
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     *
     * @return Name
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return CastInfo[]
     */
    public function getCastsInfos()
    {
        return $this->castsInfos;
    }

    /**
     * @param CastInfo[] $castsInfos
     *
     * @return Name
     */
    public function setCastsInfos($castsInfos)
    {
        $this->castsInfos = $castsInfos;

        return $this;
    }

    /**
     * @return PersonInfo[]
     */
    public function getPersonsInfos()
    {
        return $this->personsInfos;
    }

    /**
     * @param PersonInfo[] $personsInfos
     *
     * @return Name
     */
    public function setPersonsInfos($personsInfos)
    {
        $this->personsInfos = $personsInfos;

        return $this;
    }
}
