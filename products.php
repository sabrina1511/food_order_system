<!-- Connecting Database -->
<?php include('db_connect.php');?>

<style>	
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
</style>

<!-- Main Container -->
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- Adding Food Item Form -->
			<div class="col-md-4">
				<form action="" id="manage-food">
					<div class="card">
						<div class="card-header">Add Food Item</div>
						<div class="card-body">
								<input type="hidden" name="id">
								<div class="form-group">
									<label class="control-label">Category</label>
									<select name="category_id" id="category_id" class="custom-select select2">
										<option value=""></option>
										<!-- Fetching Category from DB -->
										<?php
										$qry = $conn->query("SELECT * FROM categories order by name asc");
										while($row=$qry->fetch_assoc()):
											$cname[$row['id']] = ucwords($row['name']);
										?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
									<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Name</label>
									<input type="text" class="form-control" name="name">
								</div>
								<div class="form-group">
									<label class="control-label">Price</label>
									<input type="number" class="form-control text-right" name="price">
								</div>
						</div>	
						<div class="card-footer">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
									<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-food').get(0).reset()"> Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Ending of Adding Food Item Form -->

			<!-- View Food Items -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Food Items List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Sl.</th>
									<th class="text-center">Category</th>
									<th class="text-center">Food Items</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<!-- Fetching Food Items from Database -->
								<?php 
								$i = 1;
								$food = $conn->query("SELECT * FROM foods order by id asc");
								while($row=$food->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p><b><?php echo $cname[$row['category_id']] ?></b></p>
									</td>
									<td class="">
										<p>Name: <b><?php echo $row['name'] ?></b></p>
										<p><small>Price: <b><?php echo number_format($row['price'],2) ?></b></small></p>
									</td>

									<!-- Edit/Delete Action Buttons -->
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_food" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"  data-price="<?php echo $row['price'] ?>" data-category_id="<?php echo $row['category_id'] ?>">Edit</button>
										<button class="btn btn-sm btn-danger delete_food" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Ending of View Food Items -->
		</div>
	</div>	

</div>

<script>

	/* Reset All Fields */
	$('#manage-food').on('reset',function(){
		$('input:hidden').val('')
		$('.select2').val('').trigger('change')
	})
	
	/* Saving Food Item */
	$('#manage-food').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_food',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})

	/* Editing Food Item */
	$('.edit_food').click(function(){
		start_load()
		var cat = $('#manage-food')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id')).trigger('change')
		end_load()
	})

	/* Deleting Food Item */
	$('.delete_food').click(function(){
		_conf("Are you sure to delete this food?","delete_food",[$(this).attr('data-id')])
	})
	function delete_food($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_food',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>