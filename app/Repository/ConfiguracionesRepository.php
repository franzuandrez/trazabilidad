<?php


namespace App\Repository;


use App\ConfiguracionesGenerales;
use App\Http\tools\GeneradorCodigos;

class ConfiguracionesRepository
{


    public function configuraciones_de_impresion()
    {


        $configuraciones = collect([]);
        $configuraciones->push($this->getConfiguracionFromDatabase($this->getIpImpresora()));
        $configuraciones->push($this->getCorrelativoCorrugado());
        $configuraciones->push($this->getCorrelativoColaborador());

        return $configuraciones;


    }

    public function storeFromRequest($configuraciones)
    {


        foreach ($configuraciones as $key => $configuracion) {

            $conf = ConfiguracionesGenerales::whereConfiguracion($key)->first();
            if ($conf != null) {
                $conf->valor = $configuracion;
                $conf->save();
            }
        }
    }

    private function getCorrelativoCorrugado()
    {
        return $this->getConfiguracionFromCalculo(
            'CORCORRU',
            'Correlativo corrugado',
            GeneradorCodigos::getCodigoCorrugado(),
            '1',
            [
                'Codigo aplicación' => GeneradorCodigos::CODIGO_SSCC,
                'Codigo indicador' => GeneradorCodigos::getDigitoIndicador(),
                'Codigo empresa' => GeneradorCodigos::CODIGO_EMPRESA,
                'Correlativo' => GeneradorCodigos::getNumeroSerial(),
                'Codigo verificador' => GeneradorCodigos::getDigitoVerificador()
            ]
        );
    }

    private function getCorrelativoColaborador()
    {
        return $this->getConfiguracionFromCalculo(
            'CORCOL',
            'Correlativo Colaborador',
            GeneradorCodigos::getCodigoColaborador(),
            '1',
            [
                'Codigo aplicación' => GeneradorCodigos::CODIGO_RELACION_EMPRESA_COLABORADOR,
                'Codigo indicador' => GeneradorCodigos::getDigitoIndicador(),
                'Codigo empresa' => GeneradorCodigos::CODIGO_EMPRESA,
                'Correlativo' => GeneradorCodigos::getNumeroSerial(),
                'Codigo verificador' => GeneradorCodigos::getDigitoVerificador()
            ]
        );
    }

    public function getIpImpresora()
    {

        return ConfiguracionesGenerales::whereConfiguracion('IPIMP')->first();
    }

    public function getConfiguracionFromCalculo($configuracion, $descripcion, $valor, $readonly, $extras = [])
    {
        return [
            'configuracion' => $configuracion,
            'descripcion' => $descripcion,
            'valor' => $valor,
            'readonly' => $readonly,
            'extras' => $extras
        ];
    }

    public function getConfiguracionFromDatabase(ConfiguracionesGenerales $configuracion)
    {

        return $this->getConfiguracionFromCalculo($configuracion->configuracion, $configuracion->descripcion, $configuracion->valor, $configuracion->readonly);
    }

}

