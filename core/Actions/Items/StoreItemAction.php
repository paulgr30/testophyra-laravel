<?php

namespace Core\Actions\Items;

use Core\Domain\Services\Items\StoreService;
use Core\Responders\{ExceptionResponder, ResourceResponder};
use Illuminate\Http\Request;

class StoreItemAction
{
    private $service;
    private $resourceResponder;
    private $exceptionResponder;


    public function __construct(StoreService $service)
    {
        $this->service = $service;
        $this->resourceResponder  = new ResourceResponder();
        $this->exceptionResponder = new ExceptionResponder();
    }

    public function __invoke(Request $request)
    {
        try {
            $item = $this->service->execute($request->collect(), $request->file('image'));
        } catch (\Exception $e) {
            return $this->exceptionResponder->respond($e);
        }
        return $this->resourceResponder->withData($item)->respond();
    }
}