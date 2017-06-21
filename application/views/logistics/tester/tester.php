<h1>TESTER</h1>
<div class="portlet-body">
	<table class="table table-bordered table-hover" id="brandDataTable">
		<thead>
			<tr>
				<th>ID</th>
				<th>Detail</th>
				<th>Brand</th>
				<th>Store</th>
				<th>Quantity</th>
				<th>Unitprice</th>
				<th>Total Price</th>
				<th>Shelf</th>
			</tr>
		</thead>
		<tbody>
    <?php if(!empty($stock)): ?>  
		<?php foreach ($stock as $s):?>
			<tr>
				<td><?= $s->stockid; ?></td>
				<td><?= $s->detail; ?></td>
				<td><?= $s->brand; ?></td>
				<td><?= $s->store; ?></td>
				<td><?= $s->quantity; ?></td>
				<td><?= $s->unitprice; ?></td>
				<td><?= $s->quantity * $s->unitprice; ?></td>
				<td><?= $s->shelf; ?></td>
				<td>
					<button 
                        class="btn yellow btn-outline"
                        onclick="edit('<?= $s->stockid; ?>');"
                    >
								<i class="fa fa-edit"></i>
					</button>
					<button 
                        class="btn red btn-outline"
                        onclick="destroy('<?= $s->stockid; ?>');"
                    >
								<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
		<?php endforeach; ?>
    <?php endif; ?>
		</tbody>
	</table>
</div>

<tr class="selected" id="grow'+counter+'">
	<td><button type="button" class="btn btn-warning" onclick="deletetab('+counter+');">
			<i class="fa fa-times-circle-o"></i>
		</button>
	</td>
	<td>
		<input type="hidden" name="product[]" value"'+idproduct+'" class="form-control" readonly>
		'+product+'
	</td>
	<td>
		<input type="text" name="lot[]" value="'+lot+'" class="form-control" readonly>
	</td>
	<td>
		<input type="number" name="quantity[]" value="'+quantity+'" class="form-control" readonly>
	</td>
	<td>
		<input type="number" name="price[]" value="'+price+'" class="form-control" readonly>
	</td>
	<td>
		'+subtotal[counter].toFixed(2)+'
	</td>
</tr>'
