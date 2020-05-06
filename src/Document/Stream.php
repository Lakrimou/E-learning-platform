<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Stream
 * @MongoDB\Document(repositoryClass="App\Repository\StreamRepository")
 * @ApiResource()
 */
class Stream
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
    private $created;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $enabled;

    /**
     * @MongoDB\Field(type="string")
     */
    private $supervisor;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Grade::class, mappedBy="streams")
     */
    private $grades;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Course::class, mappedBy="streams")
     */
    private $courses;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Classe::class, mappedBy="classes")
     */
    private $classes;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
        $this->courses = new ArrayCollection();
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

    public function getSupervisor(): ?string
    {
        return $this->supervisor;
    }

    public function setSupervisor($supervisor): self
    {
        $this->supervisor = $supervisor;

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