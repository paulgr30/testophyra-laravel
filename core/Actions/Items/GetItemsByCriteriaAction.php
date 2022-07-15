<?php

namespace Core\Actions\Items;

use Core\Domain\Services\Items\GetByCriteriaService;
use Core\Responders\ResourceResponder;
use Illuminate\Http\Request;

class GetItemsByCriteriaAction
{
    private $service;
    private $responder;


    public function __construct(GetByCriteriaService $service, ResourceResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        $items = $this->service->execute((string) $request->searchValue, (int) $request->perPage);
        return $this->responder->withData($items)->respond();
    }
}