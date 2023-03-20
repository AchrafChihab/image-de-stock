<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Doctrine\ORM\EntityManagerInterface;

use Twig\Environment;

use App\Entity\Page;
use App\Entity\BlockPage;


class PageExtension extends AbstractExtension
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
            'page'        => new TwigFunction('page', array($this, 'getVeleurkey')),
            'layout_page' => new TwigFunction('layout_page', array($this, 'getLayoutPage'))
        );
    }


    public function getVeleurkey($slug="")
    {
       $page_selected = $this->em->getRepository(Page::class)->findOneBy(array('slug'=>$slug,'publier'=>1));
        if($page_selected){
            return $page_selected;
        }
        return null;
    }


    public function getLayoutPage($slug="")
    {
       $page_selected = $this->em->getRepository(Page::class)->findOneBy(array('slug'=>$slug,'publier'=>1));

        if($page_selected){
            return $this->twig->render('Frontend/Render/_layout_page.html.twig',['page_selected'=>$page_selected]);
        }

        return null;
    }


}