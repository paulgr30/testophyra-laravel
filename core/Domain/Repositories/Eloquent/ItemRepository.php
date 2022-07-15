<?php

namespace Core\Domain\Repositories\Eloquent;

use Core\Domain\Models\Item;
use Core\Domain\Contracts\BaseContract;

class ItemRepository implements BaseContract
{
    private $model;

    function __construct(Item $item)
    {
        $this->model = $item;
    }

    public function all()
    {
        return $this->model->oldest('title')->get();
    }

    public function get(int $id)
    {
        return $this->model->find($id);
    }

    public function findByCriteria(string $title, int $perPage)
    {
        return $this->model
            ->ofTitle($title)
            ->latest()
            ->paginate($perPage);
    }

    public function save($data)
    {
        // Rellenamos el model
        $this->model->fill($data);
        // Guardamos el usuario
        $this->model->saveOrFail();
        // Retornamos el usuario creado
        return $this->model;
    }

    public function update(int $id, $data)
    {
        // Obtenemos el item
        $item = $this->get($id);
        // Verificamos si existe el item
        if ($item) {
            // Actualizamos el item
            $item->update($data);
        }
        // Retornamos el item modificado
        return $item;
    }

    public function destroy(int $id)
    {
        $item = $this->get($id);
        return $item ? $item->delete() : null;
    }
}
