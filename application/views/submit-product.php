

<?php include('includes/views-config.php'); ?>

	<div class="row">
		<div class="col-sm-8">
				<form name="submit-product" id="submit-product" action='<?php echo $action; ?>' method='POST'>
				<table class="boxed-table <?php echo $table_class; ?>">
					<thead class="<?php echo $head_color; ?>">
						<tr>
							<th id="test-title" colspan="2"><?php echo $title; ?></th>
						</tr>
						
					</thead>
					<tbody>
						<tr>
							<td>Product Name</td>
							<td>
								<input type="text" value="<?php echo $product_name; ?>" name="product_name" />
							</td>
						</tr>
						<tr>
							<td>Price</td>
							<td>
								<input type="text" value="<?php echo $price; ?>" name="price" />
							</td>
						</tr>
						<tr>
							<td>Stocks</td>
							<td>
								<input type="text" value="<?php echo $stocks; ?>" name="stocks" />
							</td>
						</tr>
						<tr>
							<td>
								Category
								<a id="new-category-link" class="category-question-box pull-right boxed-dark-blue" href="#">New Category ?</a>
								<a id="select-category-link" class="category-question-box pull-right boxed-dark-green" href="#">Select Category ?</a>
							</td>
							<td>
								<select id="category-select" name="category" class="">
									<?php echo $categories_select; ?>
								</select>
								<input id="category-new" type="text" value="" name="category_new" />
							</td>
						</tr>
						<tr>
							<td>
								Subcategory
								<a id="new-subcategory-link" class="category-question-box pull-right boxed-dark-blue" href="#">New Subcategory ?</a>
								<a id="select-subcategory-link" class="category-question-box pull-right boxed-dark-green" href="#">Select Subcategory ?</a>
							</td>
							<td>
								<select id="subcategory-select" name="subcategory" class="">
									<?php echo $subcategory; ?>
								</select>
								<input id="subcategory-new"  type="text" value="" name="subcategory_new" />
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