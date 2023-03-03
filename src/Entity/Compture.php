<?php

namespace App\Entity;

use App\Repository\ComptureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComptureRepository::class)]
class Compture
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $Mac = null;

    #[ORM\Column(length: 255)]
    private ?string $pros = null;

    #[ORM\Column(length: 255)]
    private ?string $ram = null;

    #[ORM\ManyToOne(inversedBy: 'comptures')]
    private ?Departement $dep = null;

    public function getmac(): ?int
    {
        return $this->Mac;
    }

    public function getPros(): ?string
    {
        return $this->pros;
    }
    public function setMac(string $Mac): self
    {
        $this->Mac = $Mac;

        return $this;
    }

    public function setPros(string $pros): self
    {
        $this->pros = $pros;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getDep(): ?Departement
    {
        return $this->dep;
    }

    public function setDep(?Departement $dep): self
    {
        $this->dep = $dep;

        return $this;
    }
}
