<?php

namespace App\Document;

use App\Document\Classe;
use App\Document\Course;
use App\Repository\ScheduleRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="App\Repository\ScheduleRepository")
 */
class Schedule
{
    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    private $id;

    /**
     * @MongoDB\Field(type="date")
     */
    private $created;

    /**
     * @MongoDB\Field(type="string")
     */
    private $description;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $semester;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $enabled;

    /**
     * @MongoDB\Field(type="string")
     */
    private $name;

    /**
     * @MongoDB\ReferenceOne(targetDocument=Classe::class)
     */
    private $classe;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Course::class)
     */
    private $course;

    /**
     * @MongoDB\ReferenceOne(targetDocument=User::class)
     */
    private $teacher;

    /**
     * @MongoDB\ReferenceOne(targetDocument="GlobalSchedule::class")
     */
    private $globalSchedule;

    /**
     * @MongoDB\Field(type="date")
     */
    private $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getSemester(): ?bool
    {
        return $this->semester;
    }

    public function setSemester(bool $semester): self
    {
        $this->semester = $semester;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getTeacher(): ?User
    {
        return $this->teacher;
    }

    public function setTeacher(User $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getGlobalSchedule(): ?GlobalSchedule
    {
        return $this->globalSchedule;
    }

    public function setGlobalSchedule(GlobalSchedule $globalSchedule): self
    {
        $this->globalSchedule = $globalSchedule;

        return $this;
    }
}
