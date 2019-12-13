<?php


namespace App\Http\tools;


class TipoProducto
{


    private static $tipos_producto;


    public static function getTipos()
    {
        self::$tipos_producto = collect(
            [
                'MP' => [
                    'DESCRIPCION' => 'MATERIA PRIMA',
                    'CLAVES' => [
                        'MATERIA',
                        'PRIMA',
                        'PRIMAS',
                        'MP'
                    ]
                ],
                'ME' => [
                    'DESCRIPCION' => 'MATERIAL EMPAQUE',
                    'CLAVES' => [
                        'EMPAQUE',
                        'ME',
                    ]
                ],
                'PP' => [
                    'DESCRIPCION' => 'PRODUCTO PROCESO',
                    'CLAVES' => [
                        'PROCESO',
                        'PP'
                    ]
                ],
                'IN' => [
                    'DESCRIPCION' => 'INSUMOS',
                    'CLAVES' => [
                        'INSUMOS',
                        'INSUMO',
                        'IN'
                    ]
                ],
                'PT' => [
                    'DESCRIPCION' => 'PRODUCTO TERMINADO',
                    'CLAVES' => [
                        'PT',
                        'TERMINADO',
                        'FINAL',
                        'ULTIMO'
                    ]
                ]
            ]
        );

        return self::$tipos_producto;


    }

    public static function getTipoProductoByClave($clave)
    {

        $clave = strtoupper($clave);
        $claves = explode(" ", $clave);

        $tipo = self::getTipos()
            ->filter(function ($value, $key) use ($claves) {
                foreach ($claves as $clave) {
                    if (in_array($clave, $value['CLAVES'])) return 1;
                }
            })
            ->keys()
            ->first();

        return $tipo;


    }

    public function getDescripcion($tipo)
    {

        $descripcion = self::getTipos()
            ->filter(function ($item, $key) use ($tipo) {
                return $key == $tipo;
            })
            ->first()['DESCRIPCION'];

        return $descripcion;

    }
}
