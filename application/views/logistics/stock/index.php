<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Almacenes <small>Almacén general</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/stock');">Almacenes</a>
            <i class="fa fa-angle-right"></i>
            </li>
        <li><span>Lista </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <select id="sellocation" onchange="stable();" class="form-control">
                                        <option value="0">Ver Todos</option>
                                    <?php foreach ($location as $l): ?>
                                        <option value="<?= $l->locationid; ?>"><?= $l->name; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover" id="stockDataTable">
                    <thead>
                        <tr>
                            <th>Item Nº</th>
                            <th>Detalle</th>
                            <th>Marca</th>
                            <th>Stock</th>
                            <th>Precio U.</th>
                            <th>P. Total</th>
                            <th>Ubicación</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody id="details">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/stock.js'); ?>"></script>
<script>
    var products;

    $(document).ready(function() {
        stock = <?php echo json_encode($stock);?>;
        showproducts();
    });

    function cleantable(){
        $('#details').empty();
    }

    function stable(){
        var option = document.getElementById("sellocation").value;
        //alert('esto es el id: ' + option);
        cleantable();
        if (option == 0){
            showproducts();
        }
        showaslocation(option);
        //alert('esto es el location: '+stock[option].detail);
    }

    function showproducts(){
        var tprice = 0;
        for (var i = 0; i < stock.length; i++) {
            unitprice = stock[i].pricetotal / stock[i].totalquantity;
            unitprice = unitprice.toFixed(2);
            tprice = stock[i].quantity * unitprice;
            tprice = tprice.toFixed(2);

            var trow = '<tr><td>'+stock[i].stockid+'</td><td>'+stock[i].detail+
                '</td><td>'+stock[i].brand+'</td><td>'+stock[i].quantity+
                '</td><td> S/.'+unitprice+'</td><td> S/.'+tprice+'</td><td>'+stock[i].shelf+
                '</td><td><button class="btn dark btn-outline"><i class="fa fa-eye"></i></button></td></tr>';
            $('#details').append(trow);
        };
    }

    function showaslocation(id){
        var tprice = 0;
        for (var i = 0; i < stock.length; i++) {
            if(stock[i].local == id){
                unitprice = stock[i].pricetotal / stock[i].totalquantity;
                unitprice = unitprice.toFixed(2);
                tprice = stock[i].quantity * unitprice;
                tprice = tprice.toFixed(2);
                var trow = '<tr><td>'+stock[i].stockid+'</td><td>'+stock[i].detail+
                '</td><td>'+stock[i].brand+'</td><td>'+stock[i].quantity+
                '</td><td> S/.'+unitprice+'</td><td> S/.'+tprice+'</td><td>'+stock[i].shelf+
                '</td><td><button class="btn dark btn-outline"><i class="fa fa-eye"></i></button></td></tr>';
            }
            $('#details').append(trow);
        };
    }
</script>