<?php

namespace App\Entity;

use App\Repository\ModulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModulesRepository::class)]
class Modules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $is_default = null;

    #[ORM\Column]
    private ?bool $is_statistic = null;

    #[ORM\Column]
    private ?bool $is_newsletter = null;

    #[ORM\Column]
    private ?bool $is_planning = null;

    #[ORM\Column]
    private ?bool $is_drinks = null;

    #[ORM\ManyToMany(targetEntity: Partners::class, mappedBy: 'modules')]
    private Collection $partners;

    public function __construct()
    {
        $this->partners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsDefault(): ?bool
    {
        return $this->is_default;
    }

    public function setIsDefault(bool $is_default): self
    {
        $this->is_default = $is_default;

        return $this;
    }

    public function isIsStatistic(): ?bool
    {
        return $this->is_statistic;
    }

    public function setIsStatistic(bool $is_statistic): self
    {
        $this->is_statistic = $is_statistic;

        return $this;
    }

    public function isIsNewsletter(): ?bool
    {
        return $this->is_newsletter;
    }

    public function setIsNewsletter(bool $is_newsletter): self
    {
        $this->is_newsletter = $is_newsletter;

        return $this;
    }

    public function isIsPlanning(): ?bool
    {
        return $this->is_planning;
    }

    public function setIsPlanning(bool $is_planning): self
    {
        $this->is_planning = $is_planning;

        return $this;
    }

    public function isIsDrinks(): ?bool
    {
        return $this->is_drinks;
    }

    public function setIsDrinks(bool $is_drinks): self
    {
        $this->is_drinks = $is_drinks;

        return $this;
    }

    /**
     * @return Collection<int, Partners>
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partners $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners->add($partner);
            $partner->addModule($this);
        }

        return $this;
    }

    public function removePartner(Partners $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            $partner->removeModule($this);
        }

        return $this;
    }
}
