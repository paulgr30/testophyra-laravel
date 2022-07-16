<?php

namespace Core\Actions\Items;

use Core\Domain\Services\Items\DestroyService;
use Core\Responders\ResourceResponder;

class DestroyItemAction
{
    private $service;
    private $responder;


    public function __construct(DestroyService $service, resourceResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke($id)
    {
        $item = $this->service->execute((int) $id);
        return $this->responder->withData($item)->respond();
    }
}