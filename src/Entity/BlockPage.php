<?php

namespace App\Entity;

use App\Repository\BlockPageRepository;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BlockPageRepository::class)
 * @Vich\Uploadable
 */
class BlockPage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subTitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $styleBlock;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $direction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $background;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colorTitre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="blockpage_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @Vich\UploadableField(mapping="blockpage_icon", fileNameProperty="icon")
     * @var File
     */
    private $iconFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fichier;

    /**
     * @Vich\UploadableField(mapping="blockpage_fichier", fileNameProperty="fichier")
     * @var File
     */
    private $fichierFile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isTop;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isCercle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publier;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class, inversedBy="blocks")
     */
    private $page;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;



   /* public function __toString(){
        return $this->titre;
    }*/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSubTitre(): ?string
    {
        return $this->subTitre;
    }

    public function setSubTitre(?string $subTitre): self
    {
        $this->subTitre = $subTitre;

        return $this;
    }

    public function getStyleBlock(): ?string
    {
        return $this->styleBlock;
    }

    public function setStyleBlock(?string $styleBlock): self
    {
        $this->styleBlock = $styleBlock;

        return $this;
    }

    public function getDirection(): ?bool
    {
        return $this->direction;
    }

    public function setDirection(?bool $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getColorTitre(): ?string
    {
        return $this->colorTitre;
    }

    public function setColorTitre(?string $colorTitre): self
    {
        $this->colorTitre = $colorTitre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }


    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function setIconFile(File $icon = null)
    {
        $this->iconFile = $icon;
        if ($icon) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getIconFile()
    {
        return $this->iconFile;
    }


    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(?string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function setFichierFile(File $fichier = null)
    {
        $this->fichierFile = $fichier;
        if ($fichier) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getFichierFile()
    {
        return $this->fichierFile;
    }


    public function getIsTop(): ?bool
    {
        return $this->isTop;
    }

    public function setIsTop(?bool $isTop): self
    {
        $this->isTop = $isTop;

        return $this;
    }

    public function getIsCercle(): ?bool
    {
        return $this->isCercle;
    }

    public function setIsCercle(?bool $isCercle): self
    {
        $this->isCercle = $isCercle;

        return $this;
    }

    public function getPublier(): ?bool
    {
        return $this->publier;
    }

    public function setPublier(?bool $publier): self
    {
        $this->publier = $publier;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }


    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
