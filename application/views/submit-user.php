<?php include('includes/views-config.php'); ?>

	<div class="row">
		<div class="col-sm-8">
				<form name="submit-user" id="submit-user" action='<?php echo $action; ?>' method='POST'>
				<table class="boxed-table">
					<thead class="boxed-red">
						<tr>
							<th id="test-title" colspan="2"><?php echo $title; ?></th>
						</tr>
						
					</thead>
					<tbody>
						<tr>
							<td>Username</td>
							<td>
								<input type="text" value="<?php echo $uname; ?>" name="username" />
							</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>
								<input type="password" value="<?php echo $password; ?>" name="password" />
							</td>
						</tr>
						<tr>
							<td>Firstname</td>
							<td>
								<input type="text" value="<?php echo $firstname; ?>" name="firstname" />
							</td>
						</tr>
						<tr>
							<td>Lastname</td>
							<td>
								<input type="text" value="<?php echo $lastname; ?>" name="lastname" />
							</td>
						</tr>
						<tr>
							<td>Type</td>
							<td>
								<select name="type">
									<?php echo select_role_simple($type); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<?php echo validation_errors('<p class="text-warning">', '</p>'); ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<a class="btn-submit boxed-green" href="<?php echo $reset; ?>">Reset</a>
								<input type="submit" class="btn-submit boxed-turquoise" value="<?php echo $submit_value; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
				</form>

		</div>

		<div class="col-sm-4">
			<?php include('widgets/widget-2.php'); ?>
		</div>
	</div>