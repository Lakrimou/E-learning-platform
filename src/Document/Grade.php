<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Grade
 * @MongoDB\Document(repositoryClass="App\Repository\GradeRepository")
 * @ApiResource()
 */
class Grade
{
    const REQUIRED = 'required';
    const OPTIONAL = 'optional';
    const ENTRANCE_EXAM = 'entrance exam';

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
     * @MongoDB\Field(type="date")
     */
    private $created;

    /**
     * @MongoDB\Field(type="string")
     */
    private $language;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Grade::class, inversedBy="grades")
     */
    private $streams;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $enabled;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Course::class, mappedBy="grades")
     */
    private $courses;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Classe::class, mappedBy="classes")
     */
    private $classes;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->streams = new ArrayCollection();
        $this->courses = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getStartDate(): ?\DateTime
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

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage($language): self
    {
        $this->language = $language;

        return $this;
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

    public function getCourses()
    {
        return $this->courses;
    }

    public function addCourse(Course $course)
    {
        $this->courses[] = $course;
    }

    public function removeCourse(Course $course)
    {
        $this->courses->removeElement($course);
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

}