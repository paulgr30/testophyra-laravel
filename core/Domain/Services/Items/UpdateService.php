<?php

declare(strict_types=1);

namespace Core\Domain\Services\Items;

use Core\Domain\Contracts\BaseContract;
use Core\Domain\Validators\ItemValidator;
use Core\Domain\Payloads\{GenericPayload, NotFoundPayload, ValidationPayload};
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile as File;

final class UpdateService
{
    private $repository;

    public function __construct(BaseContract $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id, Collection $data, ?File $image)
    {
        $data = $data->all();
        $data['image'] =  (is_null($image) or !$image->isFile()) ? false : $image;
        // Validamos la data a actualizar
        if (!ItemValidator::validate($data)) {
            return new ValidationPayload(ItemValidator::getMessage());
        }
        // Actualizamos y obtenemos el recurso actualizado
        $resource = $this->repository->update($id, ItemValidator::validatedData());
        // Comprobamos el recurso y retornamos el payload respectivo
        return $resource ? new GenericPayload($resource) : new NotFoundPayload();
    }
}