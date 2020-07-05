<?php


namespace App\Repository;


use App\Producto;

class ProductoRepository
{


    /**
     * @param $codigo
     * @return Producto
     */
    public function buscarProductoPTorPP($codigo)
    {
        $producto = Producto::where(function ($query) {
            $query->esProductoTerminado()
                ->orWhere
                ->esProductoProceso();
        })
            ->where('codigo_interno', $codigo)
            ->select('id_producto', 'descripcion', 'codigo_interno', 'dias_vencimiento', 'unidad_medida')
            ->first();

        return $producto;
    }

    public function buscarProductoByCodigoBarras($codigo_barras)
    {

        $producto = Producto::where('codigo_barras', $codigo_barras)
            ->first();

        return $producto;


    }

    /**
     * @param $codigo_producto
     * @return Producto|null
     */
    public function buscarProductoPP($codigo_producto)
    {
        $producto = Producto::where('codigo_interno', $codigo_producto)
            ->esProductoProceso()
            ->first();

        return $producto;
    }


}
