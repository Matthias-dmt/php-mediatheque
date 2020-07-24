<?php

namespace App\Twig;

use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;


class MarkdownToHtml extends AbstractExtension
{

    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('htmlFormat', [$this, 'markdownToHtmlFormat']),
        ];
    }

    public function markdownToHtmlFormat()
    {
        

        
    }
}