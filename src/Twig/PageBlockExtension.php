<?php
namespace App\Twig;

use App\Entity\Page;
use App\Entity\BlockPage;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;



class PageBlockExtension extends AbstractExtension
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
            'block_page' => new TwigFunction('block_page', array($this, 'getLayoutBlock'))
        );
    }


    public function getLayoutBlock($id)
    {
       $block = $this->em->getRepository(BlockPage::class)->findOneBy(array('id'=>$id,'publier'=>1));
       if($block){
	       	if ($block->getStyleBlock() == 'Image en droit') {
	       		return $this->twig->render('Frontend/Render/_block_image_droit.html.twig',['block'=>$block]);
	       	}elseif ($block->getStyleBlock() == 'Image en gauche') {
	       		return $this->twig->render('Frontend/Render/_block_image_gauche.html.twig',['block'=>$block]);
	       	}elseif ($block->getStyleBlock() == 'Sans image') {
	       		return $this->twig->render('Frontend/Render/_block_sans_image.html.twig',['block'=>$block]);
	       	}else {
 	   			return $this->twig->render('Frontend/Render/_block_personalisee.html.twig',['block'=>$block]);
	       	}
       }  
       return null;
    }


}