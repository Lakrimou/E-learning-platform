<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Course
 * @MongoDB\Document(repositoryClass="App\Repository\CourseRepository")
 * @ApiResource()
 */
class Course
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

    /**
     * @MongoDB\Field(type="string")
     */
    private $type;

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

    /**
     * @MongoDB\Field(type="string")
     */
    private $category;

    /**
     * @MongoDB\Field(type="string")
     */
    private $grade;

    /**
     * @MongoDB\Field(type="string")
     */
    private $stream;

    /**
     * @MongoDB\Field(type="string")
     */
    private $supervisor;

    /**
     * @MongoDB\Field(type="integer")
     */
    private $hoursPerWeek;

    /**
     * @MongoDB\Field(type="integer")
     */
    private $totalWeek;

    /**
     * @MongoDB\Field(type="string")
     */
    private $note;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

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

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled($enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }


    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory($category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade($grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getStream(): ?string
    {
        return $this->stream;
    }

    public function setStream($stream): self
    {
        $this->stream = $stream;

        return $this;
    }


    public function getSupervisor(): ?string
    {
        return $this->supervisor;
    }

    public function setSupervisor($supervisor): self
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    public function getHoursPerWeek(): int
    {
        return $this->hoursPerWeek;
    }

    public function setHoursPerWeek($hoursPerWeek): self
    {
        $this->hoursPerWeek = $hoursPerWeek;

        return $this;
    }

    public function getTotalWeek(): int
    {
        return $this->totalWeek;
    }

    public function setTotalWeek($totalWeek): self
    {
        $this->totalWeek = $totalWeek;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote($note): self
    {
        $this->note = $note;

        return $this;
    }



}