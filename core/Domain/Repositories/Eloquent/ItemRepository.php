<?php

namespace Core\Domain\Repositories\Eloquent;

use Core\Domain\Models\Item;
use Core\Domain\Contracts\BaseContract;
use Illuminate\Support\Facades\Storage;

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
        // Almacenamos la imagen en el storage y obtenemos su ruta
        $path = Storage::disk('public')->put('images', $data['image']);
        // Rellenamos el model
        $this->model->fill($data);
        $this->model->image = $path;
        // Guardamos el item
        $this->model->saveOrFail();       
        
        // Retornamos el item creado
        return $this->model;
    }

    public function update(int $id, $data)
    {
        // Obtenemos el item
        $item = $this->get($id);
        // Verificamos si existe el item
        if ($item) {
            // Verificamos si hay un archivo(imagen)
            if (!empty($data['image'])) {
                // Almacenamos la imagen en el storage y obtenemos su ruta
                $path = Storage::disk('public')->put('images', $data['image']);
                // Verificamos si el item ya tiene una imagen
                if ($item->image) {
                    //Eliminamos la imagen actual
                    Storage::delete($item->image);
                    // Actualizamos la url de la imagen
                    $item->image = $path;
                }
            }
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
