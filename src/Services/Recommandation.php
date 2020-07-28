<?php

namespace App\Services;

use App\Entity\Borrowing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Document;


class Recommandation extends AbstractController
{


    public function recommandation($doc)
    {

        // $tabdoc = [];

        //liste des membres qui ont emprunté le document "$doc"
        $members = $this->getDoctrine()->getRepository(Borrowing::class)->membersForOneDoc($doc->getId());
        
        //on récupère le nom de la classe pour savoir de quel élément il s'agit (dvd, livre, cd...)
        $entity = get_class($doc);

        // on créé le tableau qui renverra le résultat final
        $tabdoc = [];

        //on boucle sur la liste des membres qui ont emprunté un même livre 
        foreach ($members as $member) {

            // pour chaque membre, on récupère la liste des documents total emprunté
            $documents = $this->getDoctrine()->getRepository(Borrowing::class)->docsForOneMember($member->getMember()->getId());

            // pour chaque document récupéré j'enlève le document actuel + les documents qui ne sont pas de la même class
            // j'enlève également la colonne count() (en récupérant seulement la première clé) qui m'a servit à trier les données par importance
            foreach ($documents as $document){

                if ($document[0]->getDocument() !== $doc && is_a($document[0]->getDocument(), $entity)) {

                    // je créé mon tableau de retour, qui possèdera seulement les objets documents
                    $tabdoc[] = $document[0]->getDocument();
                }
                if(isset($tabdoc[4])){return $tabdoc;}
            }
        }


        return $tabdoc;
    }
}
