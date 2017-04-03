<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Title
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TitleRepository")
 * @ORM\Table(name="title")
 */
class Title
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
    protected $title;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="production_year")
     */
    protected $productionYear;

    /**
     * @var KindType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\KindType")
     * @ORM\JoinColumn(name="kind_id")
     */
    protected $kind;

    /**
     * @var Keyword[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Keyword")
     * @ORM\JoinTable(name="movie_keyword",
     *      joinColumns={@ORM\JoinColumn(name="movie_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="keyword_id", referencedColumnName="id")}
     * )
     */
    protected $keywords;

    /**
     * @var MovieInfo[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MovieInfo", mappedBy="title")
     */
    protected $moviesInfos;

    /**
     * @var CastInfo[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CastInfo", mappedBy="title")
     */
    protected $castsInfos;

    /**
     * Title constructor.
     */
    public function __construct()
    {
        $this->keywords    = new ArrayCollection();
        $this->moviesInfos = new ArrayCollection();
        $this->castsInfos  = new ArrayCollection();
    }

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
     * @return Title
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getProductionYear()
    {
        return $this->productionYear;
    }

    /**
     * @param int $productionYear
     *
     * @return Title
     */
    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    /**
     * @return KindType
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param KindType $kind
     *
     * @return Title
     */
    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * @return Keyword[]
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param Keyword[] $keywords
     *
     * @return Title
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return MovieInfo[]
     */
    public function getMoviesInfos()
    {
        return $this->moviesInfos;
    }

    /**
     * @param MovieInfo[] $moviesInfos
     *
     * @return Title
     */
    public function setMoviesInfos($moviesInfos)
    {
        $this->moviesInfos = $moviesInfos;

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
     * @return Title
     */
    public function setCastsInfos($castsInfos)
    {
        $this->castsInfos = $castsInfos;

        return $this;
    }
}
