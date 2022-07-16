<?php

namespace Core\Domain\Validators;

final class ItemValidator
{
    private static $validator;

    static function validate($data)
    {
        $id = empty($data['id']) ? 0 : $data['id'];


        $attributes = [
            'title'      => 'Titulo',
            'descripction'  => 'Descripcion',
            'price'     => 'Precio',
            'image'     => 'Imagen',
        ];

        $rules = [
            'title' => [
                'required',
                'unique:items,title,' . $id . ',id',
            ],
            'description' => [
                'required',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'image' => [
                'required',
            ],
        ];

        if ($data['image'] != false) {
            $rules = array_merge($rules, [
                'image' => [
                    'image'
                ],
            ]);
        }



        self::$validator = validator($data, $rules, [], $attributes);
        return self::$validator->fails() ? false : true;
    }

    static function validatedData()
    {
        return self::$validator->validated();
    }

    static function getMessage()
    {
        if (self::$validator->fails()) {
            return self::$validator->messages();
        }
    }
}