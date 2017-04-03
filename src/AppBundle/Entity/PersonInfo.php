<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact
 *
 * @ORM\Entity()
 * @ORM\Table(name="person_info")
 */
class PersonInfo
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
    protected $info;

    /**
     * @var InfoType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\InfoType")
     * @ORM\JoinColumn(name="info_type_id")
     */
    protected $infoType;

    /**
     * @var Name
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Name", inversedBy="personsInfos")
     * @ORM\JoinColumn(name="person_id")
     */
    protected $name;

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
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     *
     * @return PersonInfo
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return InfoType
     */
    public function getInfoType()
    {
        return $this->infoType;
    }

    /**
     * @param InfoType $infoType
     *
     * @return PersonInfo
     */
    public function setInfoType($infoType)
    {
        $this->infoType = $infoType;

        return $this;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Name $name
     *
     * @return PersonInfo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
