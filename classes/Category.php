<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function categoryInsert($categoryName)
    {
        $categoryName = $this->fm->validation($categoryName);
        $categoryName = mysqli_real_escape_string($this->db->link, $categoryName);
        if (empty($categoryName)) {
            $msg = "<span class='error'>Category field must not be empty!</span>";
            return $msg;
        } else {
            $query = "INSERT INTO category(categoryName) VALUES('$categoryName')";
            $categoryinsert = $this->db->insert($query);
            if ($categoryinsert) {
                $msg = "<span class='success'>Category Inserted Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Inserted.</span>";
                return $msg;
            }
        }
    }

    public function getAllCategory()
    {
        $query = "SELECT * FROM category ORDER BY categoryId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCategoryById($categoryid)
    {
        $query = "SELECT * FROM category WHERE categoryId = '$categoryid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function categoryUpdate($categoryName, $categoryid)
    {
        $categoryName = $this->fm->validation($categoryName);
        $categoryName = mysqli_real_escape_string($this->db->link, $categoryName);
        $categoryid = mysqli_real_escape_string($this->db->link, $categoryid);
        if (empty($categoryName)) {
            $msg = "<span class='error'>Category field must not be empty!</span>";
            return $msg;
        } else {
            $query = "UPDATE category
        	SET
        	categoryName = '$categoryName'
        	WHERE categoryId = '$categoryid'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $msg = "<span class='success'>Category Updated Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Updated.</span>";
                return $msg;
            }
        }
    }
    public function delCategoryById($id)
    {
        // $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM category WHERE categoryId = '$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Category Deleted Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Category Not Deleted!</span>";
            return $msg;
        }
    }
}
