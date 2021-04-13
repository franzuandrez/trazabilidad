<?php


namespace App\Http\tools;


use App\Colaborador;
use App\ImpresionCorrugado;
use phpDocumentor\Reflection\Types\Self_;

class GeneradorCodigos
{


    public const CODIGO_EMPRESA = '754842';
    const CODIGO_RELACION_EMPRESA_COLABORADOR = '8018';
    const CODIGO_SSCC = '00';
    const MAX_SERIAL_PERMITIDO = 9999999999;
    const START_SERIAL = 1;
    const START_DIGITO_INDICADOR = 0;
    const MAX_DIGITO_INDICADOR = 9;

    private static $digito_indicador = '';
    private static $numero_serial = '';
    private static $digito_verificador = '';
    private static $codigo_generado = '';

    public static function getCodigoGenerado()
    {

        return self::$codigo_generado;

    }

    public static function getDigitoIndicador()
    {

        return self::$digito_indicador;

    }

    public static function getNumeroSerial()
    {

        return self::$numero_serial;

    }

    public static function getDigitoVerificador()
    {

        return self::$digito_verificador;

    }


    private static function calcular_codigo_verificador($correlativo, $digito_indicador = '0')
    {

        $codigo = $digito_indicador . self::CODIGO_EMPRESA . $correlativo;

        $sum = collect(str_split($codigo))
            ->map(function ($item, $key) {
                if ($key % 2 == 0) {
                    $factor = 3;
                } else {
                    $factor = 1;
                }
                return $item * $factor;
            })->sum();

        $decena_mas_cercana = ceil($sum / 10) * 10;
        $codigo_verificador = intval($decena_mas_cercana - $sum);

        return $codigo_verificador;
    }


    public static function getCodigoColaborador()
    {

        self::calcularCodigoColaborador();
        return self::getCodigoGenerado();
    }

    private static function calcularCodigoColaborador()
    {
        $correlativo_serial = Colaborador::count() + 1;

        $correlativo = self::getSerialConCerosALaIZquierda($correlativo_serial);
        $digito_indicador = SELF::START_DIGITO_INDICADOR;
        $codigo_verificador = self::calcular_codigo_verificador($correlativo);
        $codigo_colaborador = self::CODIGO_RELACION_EMPRESA_COLABORADOR . $digito_indicador . self::CODIGO_EMPRESA . $correlativo . $codigo_verificador;


        self::$codigo_generado = $codigo_colaborador;
        self::$numero_serial = $correlativo;
        self::$digito_verificador = $codigo_verificador;
        self::$digito_indicador = $digito_indicador;
        return $codigo_colaborador;
    }


    private static function calcularCodigoCorrugado()
    {
        $ultimo_impreso = ImpresionCorrugado::orderBy('correlativo', 'desc')->first();
        $digito_indicador = self::START_DIGITO_INDICADOR;
        $numero_serial = self::START_SERIAL;;

        if ($ultimo_impreso != null) {
            $ultimo_digito_indicador = $ultimo_impreso->digito_indicador;
            $ultimo_numero_serial = $ultimo_impreso->numerio_serial;
            if (self::esNumeroSerialMaximo($ultimo_numero_serial)) {
                $digito_indicador = self::getNuevoDigitoIndicador($ultimo_digito_indicador);
            } else {
                $digito_indicador = $ultimo_digito_indicador;
                $numero_serial = $ultimo_impreso->numerio_serial + 1;
            }
        }


        $numero_serial = self::getSerialConCerosALaIZquierda($numero_serial);
        $codigo_verificador = self::calcular_codigo_verificador($numero_serial, $digito_indicador);
        $codigo_SSCC = self::CODIGO_SSCC . $digito_indicador . self::CODIGO_EMPRESA . $numero_serial . $codigo_verificador;


        self::$numero_serial = $numero_serial;
        self::$digito_verificador = $codigo_verificador;
        self::$codigo_generado = $codigo_SSCC;
        self::$digito_indicador = $digito_indicador;
        return $codigo_SSCC;
    }

    public static function getCodigoCorrugado()
    {

        self::calcularCodigoCorrugado();
        return self::getCodigoGenerado();

    }

    private static function esNumeroSerialMaximo($ultimo_numero_serial)
    {
        return $ultimo_numero_serial == self::MAX_SERIAL_PERMITIDO;
    }

    private static function esDigitoIndicadorMaximo($ultimo_digito_indicador)
    {
        return $ultimo_digito_indicador == self::MAX_DIGITO_INDICADOR;
    }

    private static function getNuevoDigitoIndicador($ultimo_digito_indicador)
    {
        $digito_indicador = self::START_DIGITO_INDICADOR;

        if (!self::esDigitoIndicadorMaximo($ultimo_digito_indicador)) {
            $digito_indicador = $ultimo_digito_indicador + 1;
        }
        return $digito_indicador;
    }

    private static function getSerialConCerosALaIZquierda($codigo)
    {
        $numero_serial = str_pad($codigo, 10, '0', STR_PAD_LEFT);

        return $numero_serial;
    }


    public static function searchSSCCPallet($sscc)
    {

        $sscc = ImpresionCorrugado::where(\DB::raw(
            'concat(identificador_aplicacion,digito_indicador,prefijo_compania,numerio_serial,codigo_verificador)'), $sscc)
            ->where('es_pallet', 1)
            ->first();

        return $sscc;


    }
    public static function searchSSCCCaja($sscc)
    {

        $sscc = ImpresionCorrugado::where(\DB::raw(
            'concat(identificador_aplicacion,digito_indicador,prefijo_compania,numerio_serial,codigo_verificador)'), $sscc)
            ->where('es_pallet', 0)
            ->first();

        return $sscc;


    }

}
