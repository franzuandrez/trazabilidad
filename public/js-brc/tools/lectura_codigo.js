function descomponerInput(input, es_dun_13 = true) {

    let codigoBarras = input.value.trim();


    return descomponerString(codigoBarras, es_dun_13);

}

function descomponerString(input, es_dun_13 = true) {

    let codigoBarras = input.trim();
    let codigo, fecha_vencimiento, lote;

    let max_length = es_dun_13 ? 13 : 14;

    if (codigoBarras.length <= max_length) {
        codigo = codigoBarras;
        fecha_vencimiento = "";
        lote = "";
    } else {

        const start = 2;
        codigo = codigoBarras.substring(start, max_length + start);
        fecha_vencimiento = codigoBarras.substring(max_length +4, max_length + 10);
        lote = codigoBarras.substring(max_length + 12, codigoBarras.length);
    }
    return ["", codigo, fecha_vencimiento, lote];
}
