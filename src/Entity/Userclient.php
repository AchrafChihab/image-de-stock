<?php

namespace App\Entity;

use App\Repository\UserclientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserclientRepository::class)
 */
class Userclient extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="usersclients")
     */
    private $client;

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
