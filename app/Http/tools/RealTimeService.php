<?php


namespace App\Http\tools;


use DB;
use Illuminate\Database\Eloquent\Model;

class RealTimeService
{


    public static function guardar(Model $model, $nuevos_registro)
    {

        $nuevos_registro = collect($nuevos_registro)
            ->filter(function ($item) {
                return $item != "" && $item != null;
            })->toArray();

        try {
            DB::enableQueryLog();
            $nothing_to_update = count($nuevos_registro) == 0;

            if ($nothing_to_update) {
                $response = [
                    'status' => 1,
                    'message' => 'Insertado correctamente',
                    'query' => DB::getQueryLog(),
                ];
            } else {
                $model = $model
                    ->newQueryWithoutRelationships()
                    ->where($model->getKeyName(), $model->getKey())
                    ->first();
                $model->{array_keys($nuevos_registro)[0]} = array_values($nuevos_registro)[0];
                $rows = $model->save();

                if ($rows) {
                    $response = [
                        'status' => 1,
                        'message' => 'Insertado correctamente',
                        'query' => DB::getQueryLog(),
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'message' => 'No se ha podido insertar el registro',
                        'query' =>  DB::getQueryLog(),
                    ];
                }
            }


        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage(),
            ];
        }

        return $response;

    }

    public static function actualizar_modelo(Model $model, $fields)
    {


        $nuevos_registro = collect($fields)
            ->filter(function ($item) use ($model) {
                $value = $model->getAttributes()[$item[0]];
                return $value != $item[1];
            })
            ->mapWithKeys(function ($item) {

                return [$item[0] => $item[1]];
            })->toArray();

        return self::guardar($model, $nuevos_registro);


    }


    public static function insertar_detalle(Model $model, $fields, $campo_enc, $value_enc)
    {


        $nuevos_registro = collect($fields)
            ->mapWithKeys(function ($item) {
                return [$item[0] => $item[1]];
            })
            ->put($campo_enc, $value_enc)
            ->put('id_usuario', \Auth::user()->id)
            ->toArray();

        $rows = DB::table($model->getTable())
            ->insert($nuevos_registro);


        if ($rows > 0) {
            $response = [
                'status' => 1,
                'message' => 'Insertado correctamente',
                'id' => DB::getPdo()->lastInsertId()
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => 'No se ha podido insertar el registro',
                'id' => ''
            ];
        }

        return $response;

    }


    public static function borrar_detalle(Model $model)
    {

        $rows = $model->delete();

        if ($rows > 0) {

            $response = [
                'status' => 1,
                'message' => 'Eliminado correctamente'
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => 'No ha sido posible eliminar el dato'
            ];
        }

        return $response;
    }


}
