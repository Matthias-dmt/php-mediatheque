<?php

namespace App\Services;

use App\Entity\Borrowing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Document;


class Recommandation extends AbstractController
{

    
    public function recommandation($doc){

        // $tabdoc = [];

        //liste des membres qui ont emprunté le document $doc
        $members = $this->getDoctrine()->getRepository(Borrowing::class)->membersForOneDoc($doc->getId());
        $entity = get_class($doc);

        $tabdoc = [];

        foreach($members as $member ){
            
        $documents = $this->getDoctrine()->getRepository(Borrowing::class)->docsForOneMember($member->getMember()->getId());
        
        foreach($documents as $document)

        if($document[0]->getDocument() !== $doc && is_a($document[0]->getDocument(), $entity)){


        
        $tabdoc[] = $document[0]->getDocument();
            // $documents = $this->getDoctrine()->getRepository(Borrowing::class)->memberForOneDoc($document->getId());
            // $tabdoc[] = $document;
        }

    }


        return $tabdoc;
            
        }
        



    
}