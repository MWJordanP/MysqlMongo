<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact
 *
 * @ORM\Entity()
 * @ORM\Table(name="cast_info")
 */
class CastInfo
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
     * @var RoleType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RoleType")
     * @ORM\JoinColumn(name="role_id")
     */
    protected $roleType;

    /**
     * @var Name
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Name", inversedBy="castsInfos")
     * @ORM\JoinColumn(name="person_id")
     */
    protected $name;

    /**
     * @var Title
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Title", inversedBy="castsInfos")
     * @ORM\JoinColumn(name="movie_id")
     */
    protected $title;

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
     * @return RoleType
     */
    public function getRoleType()
    {
        return $this->roleType;
    }

    /**
     * @param RoleType $roleType
     *
     * @return CastInfo
     */
    public function setRoleType($roleType)
    {
        $this->roleType = $roleType;

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
     * @return CastInfo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param Title $title
     *
     * @return CastInfo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
