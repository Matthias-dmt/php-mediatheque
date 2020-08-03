<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Controller\AdminController;


class ControllerListener {

    public function onKernelRequest(RequestEvent $event)
    {
        $controller = $event->getRequest();

        // if (is_array($controller)) {
        //     $function = $controller[1];
        //     $controller = $controller[0];

        // }

       var_dump(get_class_methods($controller));
    //    die;
      
        // if($controller instanceof AdminController && $function === 'login'){
        //     if($event->getRequest()->getMethod() == 'POST'){
        //     var_dump('ça marche!');
        //     // die;
            
        //     }
            
        // }

        // if($controller == "")
    }

}