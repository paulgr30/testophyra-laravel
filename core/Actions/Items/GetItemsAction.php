<?php

namespace Core\Actions\Items;

use Core\Domain\Services\Items\GetAllService;
use Core\Responders\ResourceResponder;

class GetItemsAction
{
    private $service;
    private $responder;


    public function __construct(GetAllService $service, ResourceResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $items = $this->service->execute();
        return $this->responder->withData($items)->respond();
    }
}