<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="clients")
     */
    private $fournisseur;
 

    /**
     * @ORM\ManyToMany(targetEntity=Magasin::class, inversedBy="clients")
     */
    private $magasins;

    /**
     * @ORM\OneToMany(targetEntity=Userclient::class, mappedBy="client")
     */
    private $usersclients;


    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="clients")
     */
    private $articles;
 
    public function __construct()
    { 
        $this->magasins = new ArrayCollection();
        $this->usersclients = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }
    public function __toString(){
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

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
        }

        return $this;
    }

    public function removeMagasin(Magasin $magasin): self
    {
        $this->magasins->removeElement($magasin);

        return $this;
    }

    /**
     * @return Collection|Userclient[]
     */
    public function getUsersclients(): Collection
    {
        return $this->usersclients;
    }

    public function addUsersclient(Userclient $usersclient): self
    {
        if (!$this->usersclients->contains($usersclient)) {
            $this->usersclients[] = $usersclient;
            $usersclient->setClient($this);
        }

        return $this;
    }

    public function removeUsersclient(Userclient $usersclient): self
    {
        if ($this->usersclients->removeElement($usersclient)) {
            // set the owning side to null (unless already changed)
            if ($usersclient->getClient() === $this) {
                $usersclient->setClient(null);
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
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        $this->articles->removeElement($article);

        return $this;
    }


}
