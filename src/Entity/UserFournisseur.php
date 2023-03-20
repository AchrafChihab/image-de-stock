<?php

namespace App\Entity;

use App\Repository\UserFournisseurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserFournisseurRepository::class)
 */
class UserFournisseur extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="usersfournisseurs")
     */
    private $fournisseur;

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }
}
