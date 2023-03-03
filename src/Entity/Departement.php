<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $domaine = null;

    #[ORM\OneToMany(mappedBy: 'dep', targetEntity: Compture::class)]
    private Collection $comptures;

    public function __construct()
    {
        $this->comptures = new ArrayCollection();
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

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * @return Collection<int, Compture>
     */
    public function getComptures(): Collection
    {
        return $this->comptures;
    }

    public function addCompture(Compture $compture): self
    {
        if (!$this->comptures->contains($compture)) {
            $this->comptures->add($compture);
            $compture->setDep($this);
        }

        return $this;
    }

    public function removeCompture(Compture $compture): self
    {
        if ($this->comptures->removeElement($compture)) {
            // set the owning side to null (unless already changed)
            if ($compture->getDep() === $this) {
                $compture->setDep(null);
            }
        }

        return $this;
    }
}
