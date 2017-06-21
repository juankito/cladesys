<div class="col-md-8 col-sm-6 col-xs-12">
    <table class="table table-bordered table-hover">
        <tbody>
            <tr>
                <th>ID</th>
                <td><?= $product->id; ?></td>
            </tr>
            <tr>
                <th>Categoría</th>
                <td><?= $product->category ?></td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td><?= $product->detail; ?></td>
            </tr>
            <tr>
                <th>Brand</th>
                <td><?= $product->brand; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= $product->status; ?></td>
            </tr>
        </tbody>
    </table>
</div>