function descomponerInput(input) {

    let codigoBarras = input.value.trim();


    return descomponerString(codigoBarras);

}
function descomponerString(input) {

    let  codigoBarras = input.trim();
    let codigo, fecha_vencimiento, lote;

    if (codigoBarras.length <= 13) {
        codigo = codigoBarras;
        fecha_vencimiento = "";
        lote = "";
    } else {
        codigo = codigoBarras.substring(2, 15);
        fecha_vencimiento = codigoBarras.substring(17, 23);
        lote = codigoBarras.substring(25, codigoBarras.length);
    }
    return ["", codigo, fecha_vencimiento, lote];
}
