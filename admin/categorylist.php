<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php 
$category = new Category();
if (isset($_GET['delcategory'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcategory']);
    $delCategory = $category->delCategoryById($id);
}
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
                <?php 
                if (isset($delCategory)) {
                    echo $delCategory;
                }
                 ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        $getCategory = $category->getAllCategory();
                        if ($getCategory) {
                            $i=0;
                            while ($result = $getCategory->fetch_assoc()) {
                                $i++; ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['categoryName']; ?></td>
							<td><a href="categoryedit.php?categoryid=<?php echo $result['categoryId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this?')" href="?delcategory=<?php echo $result['categoryId']; ?>">Delete</a></td>
						</tr>
						<?php
                            }
                        } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

