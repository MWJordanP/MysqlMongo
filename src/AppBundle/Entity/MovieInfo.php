<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact
 *
 * @ORM\Entity()
 * @ORM\Table(name="movie_info")
 */
class MovieInfo
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
     * @var Title
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Title", inversedBy="moviesInfos")
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
     * @return MovieInfo
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
     * @return MovieInfo
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
     * @return MovieInfo
     */
    public function setInfoType($infoType)
    {
        $this->infoType = $infoType;

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
     * @return MovieInfo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
