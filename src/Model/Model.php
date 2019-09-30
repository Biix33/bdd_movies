<?php


namespace DBMOVIE\Model;


use Exception;

abstract class Model
{
    /** @var int|string $id */
    protected $id;

    /** @var string $title */
    protected $title;

    /** @var int|string $code */
    protected $code;

    /** @var string $updatedAt */
    protected $updatedAt;

    /** @var string $deletedAt */
    protected $deletedAt;

    /** @var string $describeLink*/
    protected $describeLink;

    /** @var string $genre */
    protected $genre;

    /** @var string|null $synopsis */
    protected $synopsis;

    /** @var string|null $imageUrl */
    protected $imageUrl;

    public static function hydrate(array $data)
    {
        $model = static::class;
        $object = new $model();
        foreach ($data as $field => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
            $object->$method($value);
        }
        return $object;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|string $id
     * @return Model
     */
    public function setId($id)
    {
        $id = intval($id);
        $this->id = intval($id);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return ucwords(trim($this->title));
    }

    /**
     * @param string $title
     * @return static Model
     * @throws Exception
     */
    public function setTitle(string $title)
    {
        if (empty($title)) {
            throw new Exception("Title can't be empty");
        }
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescribeLink(): string
    {
        return $this->describeLink;
    }

    /**
     * @param string $describeLink
     * @return Model
     */
    public function setLinkAllocine(string $describeLink): Model
    {
        $this->describeLink = $describeLink;
        return $this;
    }

    /**
     * @return int|string
     */
    public function getMovieCode()
    {
        return $this->code;
    }

    /**
     * @param int|string $code
     * @return Model
     */
    public function setMovieCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     * @return Model
     */
    public function setUpdatedAt(?string $updatedAt): Model
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deletedAt;
    }

    /**
     * @param string|null $deletedAt
     * @return Model
     */
    public function setDeletedAt(?string $deletedAt): Model
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     * @return Model
     */
    public function setGenre(string $genre): Model
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    /**
     * @param string|null $synopsis
     * @return Model
     */
    public function setSynopsis(?string $synopsis): Model
    {
        $this->synopsis = $synopsis;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     * @return Model
     */
    public function setImageUrl(?string $imageUrl): Model
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }
}