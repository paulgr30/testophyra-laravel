<?php
declare(strict_types=1);

namespace Core\Domain\Services\Items;

use Core\Domain\Contracts\BaseContract;
use Core\Domain\Payloads\GenericPayload;


final class GetByCriteriaService
{
    private $repository;

    public function __construct(BaseContract $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $title, int $perPage)
    {
        $resources = $this->repository->findByCriteria($title, $perPage);
        return new GenericPayload($resources);
    }
}