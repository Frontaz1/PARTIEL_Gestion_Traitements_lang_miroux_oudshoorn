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

    #[ORM\ManyToMany(targetEntity: EffetSnd::class, mappedBy: 'medicaments')]
    private Collection $effetSnds;

    public function __construct()
    {
        $this->indication = new ArrayCollection();
        $this->effetSnds = new ArrayCollection();
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

    /**
     * @return Collection<int, EffetSnd>
     */
    public function getEffetSnds(): Collection
    {
        return $this->effetSnds;
    }

    public function addEffetSnd(EffetSnd $effetSnd): self
    {
        if (!$this->effetSnds->contains($effetSnd)) {
            $this->effetSnds->add($effetSnd);
            $effetSnd->addMedicament($this);
        }

        return $this;
    }

    public function removeEffetSnd(EffetSnd $effetSnd): self
    {
        if ($this->effetSnds->removeElement($effetSnd)) {
            $effetSnd->removeMedicament($this);
        }

        return $this;
    }
}
