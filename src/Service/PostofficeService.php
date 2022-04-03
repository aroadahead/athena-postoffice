<?php

namespace AthenaPostoffice\Service;

use Application\Service\ApplicationService;
use AthenaBridge\Aws\Ses\SesClient;
use AthenaBridge\Laminas\View\Model\ViewModel;
use Poseidon\Poseidon;
use Psr\Container\ContainerInterface;
use function array_walk;

class PostofficeService extends ApplicationService
{
    public function __construct(ContainerInterface $container)
    {
        parent ::__construct($container);
    }

    public function send(array $args): array
    {
        $client = new SesClient($this -> container -> get('conf')
            -> facade()
            -> getApisConfig('aws.ses')
            -> toArray());
        $client -> setHtmlBody($this -> renderTemplate($args));
        $client -> setSubject($args['subject']);
        $client -> setSource($args['from']);
        array_walk($args['to'], function ($item, $k) use ($client) {
            $client -> addToAddress($item);
        });
        return $client -> sendEmail() -> toArray();
    }

    private function renderTemplate(array $args = []): string
    {
        $view = new ViewModel();
        $view -> setTemplate($args['template']);
        $view -> setVariables($args['args']);
        return Poseidon ::getCore()
            -> getDesignManager()
            -> renderer()
            -> render($view);
    }
}