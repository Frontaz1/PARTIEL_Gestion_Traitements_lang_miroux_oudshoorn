<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementRepository::class)]
class Traitement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\ManyToOne(inversedBy: 'traitements')]
    private ?Consultation $consultation = null;

    #[ORM\OneToMany(mappedBy: 'traitement', targetEntity: Indication::class)]
    private Collection $indication;

    public function __construct()
    {
        $this->indication = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getConsultation(): ?Consultation
    {
        return $this->consultation;
    }

    public function setConsultation(?Consultation $consultation): self
    {
        $this->consultation = $consultation;

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
            $indication->setTraitement($this);
        }

        return $this;
    }

    public function removeIndication(Indication $indication): self
    {
        if ($this->indication->removeElement($indication)) {
            // set the owning side to null (unless already changed)
            if ($indication->getTraitement() === $this) {
                $indication->setTraitement(null);
            }
        }

        return $this;
    }
}
