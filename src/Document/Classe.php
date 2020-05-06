<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class Classe
 * @MongoDB\Document(repositoryClass="App\Repository\ClasseRepository")
 * @ApiResource()
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
     * @MongoDB\Field(type="integer")
     */
    private $absenceLimit;

    /**
     * @MongoDB\ReferenceOne(targetDocument=Grade::class, inversedBy="classes")
     */
    private $grade;

    /**
     * @MongoDB\ReferenceOne(targetDocument=Stream::class, inversedBy="classes")
     */
    private $stream;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Classroom::class, mappedBy="classes")
     */
    private $classrooms;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Course::class, mappedBy="classes")
     */
    private $courses;

    /**
     * @MongoDB\ReferenceMany(targetDocument=User::class, mappedBy="studentClasses")
     */
    private $students;

    /**
     * @MongoDB\ReferenceMany(targetDocument=User::class, mappedBy="teacherClasses")
     */
    private $teachers;

    /**
     * @MongoDB\ReferenceOne(targetDocument=User::class, inversedBy="classes")
     */
    private $supervisor;

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
        $this->classrooms = new ArrayCollection();
        $this->courses = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->teachers = new ArrayCollection();
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

    public function getAbsenceLimit(): ?int
    {
        return $this->studentLimit;
    }

    public function setAbsenceLimit($absenceLimit): self
    {
        $this->absenceLimit = $absenceLimit;

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

    public function getGrade(): ?Grade
    {
        return $this->grade;
    }

    public function setGrade(Grade $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getStream(): ?Stream
    {
        return $this->stream;
    }

    public function setStream(Stream $stream): self
    {
        $this->stream = $stream;

        return $this;
    }

    public function getClassrooms()
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom)
    {
        $this->classrooms[] = $classroom;
    }

    public function removeClassroom(Classroom $classroom)
    {
        $this->classrooms->removeElement($classroom);
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

    public function getStudents()
    {
        return $this->students;
    }

    public function addStudent(User $student)
    {
        if (count($this->getStudents()) < $this->getStudentLimit()) {
            $this->students[] = $student;
        }else {
            throw new Exception("student's limit was achieved !");
        }
    }

    public function removeStudent(User $student)
    {
        $this->students->removeElement($student);
    }

    public function getTeachers()
    {
        return $this->teachers;
    }

    public function addTeacher(User $teacher)
    {
        $this->teachers[] = $teacher;
    }

    public function removeTeacher(User $teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    public function getSupervisor()
    {
        return $this->supervisor;
    }
    public function setSupervisor(User $supervisor)
    {
        $this->supervisor = $supervisor;

        return $this;
    }
}