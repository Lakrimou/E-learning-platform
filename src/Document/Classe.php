<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class Classe
 * @MongoDB\Document(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $name;

    /**
     * @MongoDB\Field(type="string")
     */
    private $description;

    /**
     * @MongoDB\Field(type="date")
     */
    private $startDate;

    /**
     * @MongoDB\Field(type="date")
     */
    private $endDate;


    private $classType;

    /**
     * @MongoDB\Field(type="integer")
     */
    private $studentLimit;

    /**
     * @MongoDB\Field(type="date")
     */
    private $created;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $enabled;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->enabled = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate($startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate($endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getClassType(): ?string
    {
        return $this->classType;
    }

    public function setClassType($classType): self
    {
        $this->classType = $classType;

        return $this;
    }

    public function getStudentLimit(): ?int
    {
        return $this->studentLimit;
    }

    public function setStudentLimit($studentLimit): self
    {
        $this->studentLimit = $studentLimit;

        return $this;
    }

    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    public function setCreated($created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getEnabled(): ?Boolean
    {
        return $this->enabled;
    }

    public function setEnabled($enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }


}