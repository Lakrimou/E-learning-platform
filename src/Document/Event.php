<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Event
 * @MongoDB\Document(repositoryClass="App\Repository\EventRepository")
 * @ApiResource()
 */
class Event
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
     * @MongoDB\Field(type="date")
     */
    private $created;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $visible;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $enabled;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $isAnnouncement;

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

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible($visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getIsAnnouncement(): ?bool
    {
        return $this->isAnnouncement;
    }

    public function setIsAnnouncement($isAnnouncement): self
    {
        $this->isAnnouncement = $isAnnouncement;

        return $this;
    }

}