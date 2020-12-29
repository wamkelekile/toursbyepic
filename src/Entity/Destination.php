<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 */
class Destination
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
     * @ORM\OneToMany(targetEntity=Amenity::class, mappedBy="destination", orphanRemoval=true)
     */
    private $amenities;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $excerpt;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="destinations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Day::class, mappedBy="destination", orphanRemoval=true)
     */
    private $days;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_name;

    public function __construct()
    {
        $this->amenities = new ArrayCollection();
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
     * @return Collection|Amenity[]
     */
    public function getAmenities(): Collection
    {
        return $this->amenities;
    }

    public function addAmenity(Amenity $amenity): self
    {
        if (!$this->amenities->contains($amenity)) {
            $this->amenities[] = $amenity;
            $amenity->setDestination($this);
        }

        return $this;
    }

    public function removeAmenity(Amenity $amenity): self
    {
        if ($this->amenities->removeElement($amenity)) {
            // set the owning side to null (unless already changed)
            if ($amenity->getDestination() === $this) {
                $amenity->setDestination(null);
            }
        }

        return $this;
    }

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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
            $day->setDestination($this);
        }

        return $this;
    }

    public function removeDay(Day $day): self
    {
        if ($this->days->removeElement($day)) {
            // set the owning side to null (unless already changed)
            if ($day->getDestination() === $this) {
                $day->setDestination(null);
            }
        }

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): self
    {
        $this->short_name = $short_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTours(): array
    {
        $tours = [];
        foreach ($this->days as $day)
        {
            if(!in_array($day->getTour(), $tours))
            {
                $tours[] = $day->getTour();
            }
        }

        return $tours;
    }
}
