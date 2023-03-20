<?php
namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Config;

class HistoryExtension extends AbstractExtension
{
 
	private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getUpdatedAtFilters()
    {
        return [
            new TwigFunction('datetime', [$this, 'getUpdatedAt']),
        ];
    }

    public function getUpdatedAt()
    {
        $date = $this->em->getRepository(History::class)->find(1);

        return $date;
    }
}