<?php

namespace MongoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Actor
{
    /**
     * @MongoDB\Id()
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string", nullable=true)
     */
    protected $name;

    /**
     * @MongoDB\Field(type="string", nullable=true)
     */
    protected $birthDay;

    /**
     * @MongoDB\Field(type="string", nullable=true)
     */
    protected $deathDay;

    /**
     * @MongoDB\Field(type="collection")
     */
    protected $movies = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Actor
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return Actor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param mixed $birthDay
     *
     * @return Actor
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeathDay()
    {
        return $this->deathDay;
    }

    /**
     * @param mixed $deathDay
     *
     * @return Actor
     */
    public function setDeathDay($deathDay)
    {
        $this->deathDay = $deathDay;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * @param mixed $movies
     *
     * @return Actor
     */
    public function setMovies($movies)
    {
        $this->movies = $movies;

        return $this;
    }

    /**
     * @param string $movie
     *
     * @return $this
     */
    public function addMovie($movie)
    {
        $this->movies[] = $movie;

        return $this;
    }
}
