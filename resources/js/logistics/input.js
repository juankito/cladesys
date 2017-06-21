$(document).ready(function() {

    $(".select-2-single").select2({
        placeholder: "Busque y seleccione",
        allowClear: true
    });

	$('#new-input').tooltip({
	    title: 'Compra'
	});

   $('#inputDataTable').DataTable( {
        language: {
            zeroRecords: "No se encontraron resultados",
            info: "",
            infoEmpty: "",
            infoFiltered: "",
            search:"Buscar "
        },
        order: [[ 0, "desc" ]],
        bLengthChange: false,
        buttons: [{
            extend: "print",
            className: "btn purple-plum",
            exportOptions: { columns: [ 0, 1, 2, 3, 4, 5]},
            text: '<i class="icon-printer"></i>',
            titleAttr: 'Imprimir',
            title: 'Lista de compras'
        }, {
            extend: "pdf",
            className: "btn red-sunglo",
            exportOptions: { columns: [ 0, 1, 2, 3, 4, 5]},
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            title: 'Lista de compras'
        }, {
            extend: "excel",
            className: "btn green-meadow",
            exportOptions: { columns: [ 0, 1, 2, 3, 4, 5]},
            text: '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            title: 'Lista de compras'
        },{
            extend: "colvis",
            className: "btn grey-cascade",
            text: '<i class="fa fa-th-list"></i>'
        }],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    });

    $('#btn_add').click(function(){
        addelement();
    });

    $("#savetab").hide();
});

//This part introduces in the document the rows where the products are detailed.

var counter = 0;
    total = 0;
    subtotal = [];

function addelement(){
    idproduct   = $("#askitem").val();
    product     = $("#askitem option:selected").text();
    quantity    = $("#iquantity").val();
    price       = $("#iunitprice").val();
    expire      = $("#expiredate").val();
    lot         = $("#inslot").val();

    alert('It works. id'+idproduct+' prod '+product+' quantity '+quantity+' price '+' expire '+expire+' lot '+lot);

    if (idproduct != "" && quantity != "" && quantity > 0 && price != "" && product != ""){

        subtotal[counter] = (quantity * price);
        total = total + subtotal;

        var tabrow = '<tr class="selected" id="tabrow'+counter+'"><td><button type="button" class="btn btn-warning" onclick="deletetab('+counter+');"><i class="fa fa-times-circle-o"></i></button></td><td><input type="hidden" name="product[]" value"'+idproduct+'" class="form-control" readonly>'+product+'</td><td><input type="text" name="lot[]" value="'+lot+                    '" class="form-control" readonly></td><td><input type="number" name="quantity[]" value="'+quantity+'" class="form-control" readonly></td><td><input type="number" name="price[]" value="'+price+'" class="form-control" readonly></td><td>'+subtotal[counter].toFixed(2)+'</td></tr>';

        counter++;
        cleantab();

        $("#total").html("S/. " + total);
        evaluate();
        $("#details").append(tabrow);
    }
    else{
        alert("Error al ingresar datos. Por favor, revise los datos del producto.");
    }
}

function cleantab(){
    $("#quantity").val("");
    $("#price").val("");
}

function evaluate(){
    if (total > 0){
        $("#savetab").show();
    }
    else{
        $("#savetab").hide();
    }
}

function deletetab(index){
    total = total - subtotal[index];
    $("#total").html("S/. " + total);
    $('#tabrow' + index).remove();
    evaluate();
}