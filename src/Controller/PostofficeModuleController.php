<?php

namespace AthenaPostoffice\Controller;

use Application\Controller\ModuleController;
use AthenaPostoffice\Service\PostofficeService;

class PostofficeModuleController extends ModuleController
{
    public function postofficeService(): PostofficeService
    {
        return $this -> invokeService();
    }
}