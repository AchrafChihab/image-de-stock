<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("articles")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("articles")
     */
    private $nom;
 

    /**
     * @ORM\OneToMany(targetEntity=Magasin::class, mappedBy="fournisseur")
     */
    private $magasins;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="fournisseur")
     */
    private $clients;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="fournisseur")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=UserFournisseur::class, mappedBy="fournisseur")
     */
    private $usersfournisseurs;

 

    public function __construct()
    {
        $this->magasins = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->usersfournisseurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(){
        return $this->nom;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
 

    /**
     * @return Collection|Magasin[]
     */
    public function getMagasins(): Collection
    {
        return $this->magasins;
    }

    public function addMagasin(Magasin $magasin): self
    {
        if (!$this->magasins->contains($magasin)) {
            $this->magasins[] = $magasin;
            $magasin->setFournisseur($this);
        }

        return $this;
    }

    public function removeMagasin(Magasin $magasin): self
    {
        if ($this->magasins->removeElement($magasin)) {
            // set the owning side to null (unless already changed)
            if ($magasin->getFournisseur() === $this) {
                $magasin->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setFournisseur($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getFournisseur() === $this) {
                $client->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setFournisseur($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getFournisseur() === $this) {
                $article->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserFournisseur[]
     */
    public function getUsersfournisseurs(): Collection
    {
        return $this->usersfournisseurs;
    }

    public function addUsersfournisseur(UserFournisseur $usersfournisseur): self
    {
        if (!$this->usersfournisseurs->contains($usersfournisseur)) {
            $this->usersfournisseurs[] = $usersfournisseur;
            $usersfournisseur->setFournisseur($this);
        }

        return $this;
    }

    public function removeUsersfournisseur(UserFournisseur $usersfournisseur): self
    {
        if ($this->usersfournisseurs->removeElement($usersfournisseur)) {
            // set the owning side to null (unless already changed)
            if ($usersfournisseur->getFournisseur() === $this) {
                $usersfournisseur->setFournisseur(null);
            }
        }

        return $this;
    }


}
