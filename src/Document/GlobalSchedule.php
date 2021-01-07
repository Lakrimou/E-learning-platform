<?php

namespace App\Document;

use App\Repository\GlobalScheduleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class GlobalSchedule
 * @package App\Document
 * @MongoDB\Document(repositoryClass="App\Repository\GlobalScheduleRepository")
 */
class GlobalSchedule
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
     * @MongoDB\ReferenceMany(targetDocument=Schedule::class)
     */
    private $schedules;

    /**
     * @MongoDB\Field(type="date")
     */
    private $created;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->created = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule)
    {
        $this->schedules[] = $schedule;
    }

    public function removeSchedule(Schedule $schedule)
    {
        $this->schedules->removeElement($schedule);
    }
}