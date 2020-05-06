<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class User
 * @MongoDB\Document(repositoryClass="App\Repository\UserRepository")
 * @ApiResource()
 */
class User implements UserInterface
{
    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $email;

    /**
     * @MongoDB\Field(type="collection")
     */
    private $roles = [];

    /**
     * @MongoDB\Field(type="string")
     */
    private $password;

    /**
     * @MongoDB\Field(type="string")
     */
    private $firstName;

    /**
     * @MongoDB\Field(type="string")
     */
    private $lastName;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Classe::class, inversedBy="students")
     */
    private $classesStudent;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Classe::class, inversedBy="teachers")
     */
    private $classesTeacher;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Classe::class, inversedBy="supervisor")
     */
    private $classesSupervisor;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Course::class, inversedBy="supervisor")
     */
    private $courses;

    public function __construct()
    {
        $this->classesStudent = new ArrayCollection();
        $this->classesTeacher = new ArrayCollection();
        $this->classesSupervisor = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getClassesStudent()
    {
        return $this->$classesStudent;
    }

    public function addClasseStudent(Classe $classeStudent)
    {
            $this->classesStudent[] = $classeStudent;
    }

    public function removeClasseStudent(Classe $classeStudent)
    {
        $this->classesStudent->removeElement($classeStudent);
    }

    public function getClassesTeacher()
    {
        return $this->classesTeacher;
    }

    public function addClasseTeacher(Classe $classeTeacher)
    {
        $this->classesTeacher[] = $classeTeacher;
    }

    public function removeClasseTeacher(Classe $classeTeacher)
    {
        $this->classesTeacher->removeElement($classeTeacher);
    }

    public function getClassesSupervisor()
    {
        return $this->classesSupervisor;
    }

    public function addClasseSupervisor(Classe $classeSupervisor)
    {
        $this->classesSupervisor[] = $classeSupervisor;
    }

    public function removeClasseSupervisor(Classe $classeSupervisor)
    {
        $this->classesSupervisor->removeElement($classeSupervisor);
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
}
