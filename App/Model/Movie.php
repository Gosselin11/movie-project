<?php

namespace App\Model;

use DateTime;

class Movie
{
    //Attributs
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?DateTime $publishAt;
    private ?int $duration;
    private ?int $cover;
    private ?array $category;

    //Constructeur
    public function __construct()
    {
        $this->id = null;
        $this->title = null;
        $this->description = null;
        $this->publishAt = null;
        $this->duration = null;
        $this->cover = null;
        $this->category = null;
    }

    //Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getPublishAt(): ?DateTime
    {
        return $this->publishAt;
    }

    public function setPublishAt(?DateTime $publishAt): void
    {
        $this->publishAt = $publishAt;
    }
    public function getDuration(): ?int
    {
        return $this->duration;
    }
    public function setDuration(?int $duration): void
    {
        $this->duration = $duration;
    }
    public function getCover(): ?int
    {
        return $this->cover;
    }
    public function setCover(?int $cover): void
    {
        $this->cover = $cover;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }
    public function addCategory(string $categoryId): void
    {
        $this->category[] = $categoryId;
    }
    public function deleteCategory(string $categoryId): void
    {
        $this->category = array_filter(
            $this->category,
            fn($c) => $c !== $categoryId
        );
    }
}
