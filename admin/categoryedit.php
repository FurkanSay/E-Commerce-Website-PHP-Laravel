<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
if (!isset($_GET['categoryid']) || $_GET['categoryid'] == null) {
    echo "<script>window.location = 'catlist.php';</script>";
} else {
    $categoryid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['categoryid']);
}
$category = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryName = $_POST['categoryName'];
    
    $updatetCategory= $category->categoryUpdate($categoryName, $categoryid);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">
               <?php 
               if (isset($updatetCategory)) {
                   echo $updatetCategory;
               }
                ?>
                <?php 
                $getCategory = $category->getCategoryById($categoryid);
                if ($getCategory) {
                    while ($result = $getCategory->fetch_assoc()) {
                        ?> 
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name="categoryName" value="<?php echo $result['categoryName'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                    }
                } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
