<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $catid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'cat', targetEntity: Article::class)]
    private Collection $art;

    public function __construct()
    {
        $this->art = new ArrayCollection();
    }

    public function getcatid(): ?int
    {
        return $this->catid;
    }
    public function setCatid(string $catid): self
    {
        $this->catid = $catid;

        return $this;
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

    /**
     * @return Collection<int, Article>
     */
    public function getArt(): Collection
    {
        return $this->art;
    }

    public function addArt(Article $art): self
    {
        if (!$this->art->contains($art)) {
            $this->art->add($art);
            $art->setCat($this);
        }

        return $this;
    }

    public function removeArt(Article $art): self
    {
        if ($this->art->removeElement($art)) {
            // set the owning side to null (unless already changed)
            if ($art->getCat() === $this) {
                $art->setCat(null);
            }
        }

        return $this;
    }

   /* public function __toString()
    {
        return $this->name;
    }*/
}
