<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicamentRepository::class)]
class Medicament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'medicament', targetEntity: Indication::class)]
    private Collection $indication;

    public function __construct()
    {
        $this->indication = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Indication>
     */
    public function getIndication(): Collection
    {
        return $this->indication;
    }

    public function addIndication(Indication $indication): self
    {
        if (!$this->indication->contains($indication)) {
            $this->indication->add($indication);
            $indication->setMedicament($this);
        }

        return $this;
    }

    public function removeIndication(Indication $indication): self
    {
        if ($this->indication->removeElement($indication)) {
            // set the owning side to null (unless already changed)
            if ($indication->getMedicament() === $this) {
                $indication->setMedicament(null);
            }
        }

        return $this;
    }
}
