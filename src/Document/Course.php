<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @MongoDB\ReferenceMany(targetDocument=Grade::class, inversedBy="courses")
     */
    private $grades;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Grade::class, inversedBy="courses")
     */
    private $streams;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Classe::class, inversedBy="courses")
     */
    private $classes;

    /**
     * @MongoDB\ReferenceOne(targetDocument=User::class, mappedBy="courses")
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
        $this->grades = new ArrayCollection();
        $this->streams = new ArrayCollection();
        $this->classes = new ArrayCollection();
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

    public function getStartDate()
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

    public function getGrades()
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade)
    {
        $this->grades[] = $grade;
    }

    public function removeGrade(Grade $grade)
    {
        $this->grades->removeElement($grade);
    }

    public function getStreams()
    {
        return $this->streams;
    }

    public function addStream(Stream $stream)
    {
        $this->streams[] = $stream;
    }

    public function removeStream(Stream $stream)
    {
        $this->streams->removeElement($stream);
    }

    public function getClasses()
    {
        return $this->classes;
    }

    public function addClasse(Classe $classe)
    {
        $this->classes[] = $classe;
    }

    public function removeClasse(Classe $classe)
    {
        $this->classes->removeElement($classe);
    }


    public function getSupervisor()
    {
        return $this->supervisor;
    }

    public function setSupervisor(User $supervisor): self
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    public function getHoursPerWeek(): ?int
    {
        return $this->hoursPerWeek;
    }

    public function setHoursPerWeek($hoursPerWeek): self
    {
        $this->hoursPerWeek = $hoursPerWeek;

        return $this;
    }

    public function getTotalWeek(): ?int
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