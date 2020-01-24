<?php


namespace App\Http\tools;


use DB;
use Illuminate\Database\Eloquent\Model;

class RealTimeService
{


    public static function actualizar_modelo(Model $model, $fields)
    {

        DB::enableQueryLog();

        $nuevos_registro = collect($fields)
            ->filter(function ($item) use ($model) {
                $value = $model->getAttributes()[$item[0]];
                return $value != $item[1];
            })
            ->mapWithKeys(function ($item) {

                return [$item[0] => $item[1]];
            })->toArray();


        try {

            $nothing_to_update = count($nuevos_registro) == 0;

            if ($nothing_to_update) {
                $response = [
                    'status' => 1,
                    'message' => 'Insertado correctamente',
                    'query' => DB::getQueryLog(),
                ];
            } else {
                $rows = DB::table($model->getTable())
                    ->where($model->getKeyName(), $model->getKey())
                    ->update($nuevos_registro);
                if ($rows > 0) {
                    $response = [
                        'status' => 1,
                        'message' => 'Insertado correctamente',
                        'query' => DB::getQueryLog(),
                    ];
                } else {
                    $response = [
                        'status' => 0,
                        'message' => 'No se ha podido insertar el registro',
                        'query' => DB::getQueryLog(),
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


}
