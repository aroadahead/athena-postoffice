<?php

namespace AthenaPostoffice\Controller;

class IndexController extends PostofficeModuleController
{
    public function testAction(): void
    {
        $this -> postofficeService() -> send([
            'to' => ['jkushner1019@gmail.com', 'jonathan.r.kushner@gmail.com', 'yonatonreid@gmail.com'],
            'from' => 'jkushner1019+from@gmail.com',
            'template' => 'email/test',
            'subject' => 'helloooo from yonaton',
            'args' => [
                'fName' => 'Jonathan',
                'lName' => 'Reid',
                'module' => __NAMESPACE__
            ]
        ]);
    }
}