<?php

namespace App\Entity;

use App\Repository\TourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TourRepository::class)
 */
class Tour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Day::class, mappedBy="tour", orphanRemoval=true)
     */
    private $days;

    public function __construct()
    {
        $this->days = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Day[]
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(Day $day): self
    {
        if (!$this->days->contains($day)) {
            $this->days[] = $day;
            $day->setTour($this);
        }

        return $this;
    }

    public function removeDay(Day $day): self
    {
        if ($this->days->removeElement($day)) {
            // set the owning side to null (unless already changed)
            if ($day->getTour() === $this) {
                $day->setTour(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestinations(): array
    {
        $destinations = [];
        foreach ($this->days as $day)
        {
            if(!in_array($day->getDestination(), $destinations))
            {
                $destinations[] = $day->getDestination();
            }
        }

        return $destinations;
    }

    /**
     * @return mixed
     */
    public function getAmenities(): array
    {
        $amenities = [];
        foreach ($this->days as $day)
        {
            if(!in_array($day->getAmenity(), $amenities))
            {
                $amenities[] = $day->getAmenity();
            }
        }

        return $amenities;
    }
}
