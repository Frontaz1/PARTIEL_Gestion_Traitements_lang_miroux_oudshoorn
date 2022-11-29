<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementRepository::class)]
class Traitement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\OneToOne(mappedBy: 'traitement', cascade: ['persist', 'remove'])]
    private ?Indication $indication = null;

    #[ORM\OneToOne(inversedBy: 'traitement', cascade: ['persist', 'remove'])]
    private ?Consultation $consultation = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getIndication(): ?Indication
    {
        return $this->indication;
    }

    public function setIndication(?Indication $indication): self
    {
        // unset the owning side of the relation if necessary
        if ($indication === null && $this->indication !== null) {
            $this->indication->setTraitement(null);
        }

        // set the owning side of the relation if necessary
        if ($indication !== null && $indication->getTraitement() !== $this) {
            $indication->setTraitement($this);
        }

        $this->indication = $indication;

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
}
