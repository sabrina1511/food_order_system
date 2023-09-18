<div class="container-fluid">
	<br>
	<div class="col-lg-12">
		<div class="card ">
			<div class="card-header"><b>User List</b><button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button></div>
			<div class="card-body">
				<table class="table-striped table-bordered">
					<!-- Table Header -->
					<thead>
						<tr>
							<th class="text-center">Sl.</th>
							<th class="text-center">Name</th>
							<th class="text-center">User</th>
							<th class="text-center">Type</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<!-- Table Body -->
					<tbody>
						<!-- Retrieving User Infos -->
						<?php
							include 'db_connect.php';
							$type = array("","Admin","Staff");
							$users = $conn->query("SELECT * FROM users order by name asc");
							$i = 1;
							while($row= $users->fetch_assoc()):
						?>
						<!-- Retrieving User Infos as a Row -->
						<tr>
							<td class="text-center"><?php echo $i++ ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['username'] ?></td>
							<td><?php echo $type[$row['type']] ?></td>
							<td>
								<center>
									<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm">Action</button>
									<button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
									</div>
									</div>
								</center>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	/* Creating New User */
	$('table').dataTable();
	$('#new_user').click(function(){
		uni_modal('New User','manage_user.php')
	})
	/* Editing User Infos */
	$('.edit_user').click(function(){
		uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
	})
	/* Deleting User Infos */
	$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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
</script>