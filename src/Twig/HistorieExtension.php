<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Environment;
use Twig\TwigFunction;
use App\Entity\History;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class HistorieExtension extends AbstractExtension
{
    protected $em;
    protected $twig;

    public function __construct(EntityManagerInterface $em, Environment $twig)
    {
        $this->em   = $em;
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        return array(
            'updatedatetime'        => new TwigFunction('updatedatetime', array($this, 'updatedatetime')), 
        );
    }

    public function updatedatetime()
    {
      
        $dates = $this->em->getRepository(History::class)->findBy(array(),array('id'=>'DESC'),1,0);

        foreach($dates as $date){
           return  $date->getDateFormat();
        }
        return "";
        
    }

    
}   