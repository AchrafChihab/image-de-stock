<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\page;


class SousMenuExtension extends AbstractExtension
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('sous_menu_list', [$this, 'getListe']),
        ];
    }

    public function getListe($slug)
    { 
        $resulta =  $this->em->getRepository(page::class)->getAllPublicWithCategorie($slug);
        if ($resulta) {
            return $resulta;
        }
        return "";
    }
}
