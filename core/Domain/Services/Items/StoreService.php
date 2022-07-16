<?php

declare(strict_types=1);

namespace Core\Domain\Services\Items;

use Core\Domain\Contracts\BaseContract;
use Core\Domain\Validators\ItemValidator;
use Core\Domain\Payloads\{ValidationPayload, NotFoundPayload, GenericPayload};
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile as File;

final class StoreService
{
    private $repository;

    public function __construct(BaseContract $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Collection $data, File $image)
    {
        $data = $data->all();
        $data['image'] = $image; //->getClientOriginalName(); //getRealPath();

        if (! ItemValidator::validate($data)) {
            //dd(ItemValidator::getMessage());
            return new ValidationPayload(ItemValidator::getMessage());
        }
        $resource = $this->repository->save(ItemValidator::validatedData());
        if (is_null($resource)) return new NotFoundPayload();
        return new GenericPayload($resource);
    }
}