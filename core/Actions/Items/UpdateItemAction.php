<?php

namespace Core\Actions\Items;

use Core\Domain\Services\Items\UpdateService;
use Core\Responders\{ExceptionResponder, ResourceResponder};
use Illuminate\Http\Request;

final class UpdateItemAction
{
    private $service;
    private $resourceResponder;
    private $exceptionResponder;


    public function __construct(UpdateService $service)
    {
        $this->service            = $service;
        $this->resourceResponder  = new resourceResponder();
        $this->exceptionResponder = new ExceptionResponder();
    }

    public function __invoke($id, Request $request)
    {
        //try {
            $item = $this->service->execute((int) $id, $request->collect(), $request->file('image'));
        /*} catch (\Exception $e) {
            return $this->exceptionResponder->respond($e);
        }*/
        return $this->resourceResponder->withData($item)->respond();
    }
}