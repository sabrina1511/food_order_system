<!-- Connecting DB & Retrieving Data -->
<?php 
include 'db_connect.php';
$order = $conn->query("SELECT * FROM orders where id = {$_GET['id']}");
foreach($order->fetch_array() as $k => $v){
	$$k= $v;
}
$items = $conn->query("SELECT o.*,p.name FROM order_items o inner join foods p on p.id = o.food_id where o.order_id = $id ");
?>

<!-- Internal CSS -->
<style>
	.flex{
		display: inline-flex;
		width: 100%;
	}
	.w-50{
		width: 50%;
	}
	.text-center{
		text-align:center;
	}
	.text-right{
		text-align:right;
	}
	table.wborder{
		width: 100%;
		border-collapse: collapse;
	}
	table.wborder>tbody>tr, table.wborder>tbody>tr>td{
		border:1px solid;
	}
	p{
		margin:unset;
	}
</style>

<!-- Container -->
<div class="container-fluid">
	<div class="text-center">
		<h4><b>Tasty Shop</b></h4>
		<p class="text-center"><b><?php echo $amount_tendered > 0 ? "Billing Receipt" : "Unpaid Billing Receipt" ?></b></p>
	</div>
	<hr style="border-top: dashed 1px;" />
	<div class="flex">
		<div class="w-100">
			<!-- <p>Order No. <b><?php echo $order_number ?></b></p>-->
			<?php if($amount_tendered > 0): ?>
			<p>Invoice Number: <b><?php echo $ref_no ?></b></p>
			<?php endif; ?>
			<p>Date: <b><?php echo date("M d, Y",strtotime($date_created)) ?></b></p>			
		</div>
	</div>
	<table width="100%">
		<thead>
			<tr>
				<td><b>Sl.</b></td>
				<td><b>Order</b></td>
				<td><b>Qty</b></td>
				<td class="text-right"><b>Amount</b></td>
			</tr>			
		</thead>
		<hr style="border-top: dashed 1px;" />
		<tbody>
			<!-- Fetching Ordered Items for Billing -->
			<?php 
			$i = 1;
			while($row = $items->fetch_assoc()):	
			?>
			<tr>
				<td><p><?php echo $i++ ?></p>
				<td><p><?php echo $row['name'] ?></p><?php if($row['qty'] > 0): ?><small>(<?php echo number_format($row['price'],2) ?>)</small> <?php endif; ?></td>
				<td><?php echo $row['qty'] ?></td>
				<td class="text-right"><?php echo number_format($row['amount'],2) ?></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
	<hr style="border-top: dashed 1px;" />
	<table width="100%">
		<tbody>
			<tr>
				<td><b>Total Amount</b></td>
				<td class="text-right"><b><?php echo number_format($total_amount,2) ?></b></td>
			</tr>
			<?php if($amount_tendered > 0): ?>
			<tr>
				<td><b>Amount Tendered</b></td>
				<td class="text-right"><b><?php echo number_format($amount_tendered,2) ?></b></td>
			</tr>
			<tr>
				<td><b>Change</b></td>
				<td class="text-right"><b><?php echo number_format($amount_tendered - $total_amount,2) ?></b></td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<hr style="border-top: dashed 1px;" />
	<p>**15% VAT inlcuded</p>
</div>