<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM; 

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class) 
 */
class Article
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
    private $reference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("articles")
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("articles")
     */
    private $nserie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("articles")
     */
    private $nlot;

 

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("articles")
     */
    private $qte;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="articles")
     * @Groups("articles")
     */
    private $fournisseur;


    /**
     * @ORM\ManyToMany(targetEntity=Client::class, inversedBy="articles")
     * @Groups("articles")
     */
    private $clients;

    /**
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="articles")
     * @Groups("articles")
     */
    private $magasin;
  

    public function __construct()
    { 
        $this->clients = new ArrayCollection(); 
    }
    public function __toString(){
        return $this->reference;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getNserie(): ?string
    {
        return $this->nserie;
    }

    public function setNserie(?string $nserie): self
    {
        $this->nserie = $nserie;

        return $this;
    }

    public function getNlot(): ?string
    {
        return $this->nlot;
    }

    public function setNlot(?string $nlot): self
    {
        $this->nlot = $nlot;

        return $this;
    }
    
    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(?int $qte): self
    {
        $this->qte = $qte;

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
            $client->addArticle($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            $client->removeArticle($this);
        }

        return $this;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

 
 
}
