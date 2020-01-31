<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{$reporte_encabezado->getTitle()}}</title>
<link rel="stylesheet" href="{{asset('css/pdf.css')}}" media="all">
<style>
    .title {

        font-size: 18px;
        width: 500px;
    }

    .field {
        text-align: left;
        font-weight: bold;
        border-right: none;
        width: 50px !important;
    }

    .value {
        text-align: left;

    }

    .table-headers:last-of-type,  .table-headers:first-of-type {
        width: 40%;

    }
    .table-headers:last-of-type{
        margin-top: -425px;
        margin-left: 300px;
        width: 68%;
    }
    .table-headers td, .table-headers th{
        text-align: left;
        height: auto;
    }
    .table-headers td{
        width: 10px;
    }


</style>
