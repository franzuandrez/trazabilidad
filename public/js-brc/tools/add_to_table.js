function add_to_table(fields, id_table) {


    let row = '<tr> <td> <button onclick=remove_from_table(this) type="button" class="btn btn-warning">x</button></td> ';

    fields.forEach(function (e) {


        let text = "";
        let value = e[1].value;
        if (e[1].tagName == "INPUT") {
            text = value;
        } else {
            text = $('#' + e[1].id + ' option:selected').text();
        }
        row += `
                <td> <input  type="hidden"  name="${e[0]}[]" value="${value}"  > ${text}</td>
       `;
    });
    row += '</tr>';

    $('#' + id_table).append(row);
}

function remove_from_table(element) {
    let td = $(element).parent();
    td.parent().remove();

}

