<?php
if(!isset($_SESSION['admin']) or $_SESSION['admin']==0)
{
    echo"<script>alert('You are not administration')</script>";
    echo'<meta http-equiv="refresh" content="0;URL=index.php">';
}
else
{
?>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <script language="javascript">
    function deleteConfirm(){
        if(confirm("Are you sure to delete?")){
            return true;
        }
        else{
            return false;
        }
    }
    </script>
    <?php
    include_once("connection.php");
    if(isset($_GET["function"])=="del"){
        if(isset($_GET["id"])){
            $id=$_GET["id"];
            pg_query($conn,"DELETE FROM category Where Cat_ID='$id'");
        }
    }
    ?>
        <form name="frm" method="post" action="">
        <h1>Product Category</h1>
        <p>
        <img src="image/add.png" alt="Add new" width="16" height="16" border="0" /> <a href="?page=add_category"> Add</a>
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                     <th><strong>Description</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
            $No=1;
            $result=pg_query($conn,"SELECT * FROM category");
            while($row=pgsql_fetch_array($result,Null, PGSQL_ASSOC))
            {
            ?>
			<tr>
              <td class="CheckBox"><?php echo $No;?></td>
              <td><?php echo $row["cat_name"];?></td>
              <td><?php echo $row["cat_des"];?></td>
              
              <td style='text-align:center'><a href="?page=update_category&&id=<?php echo $row["cat_id"];?>"><img src='image/edit.png' border='0'/></a></td>
              <td style='text-align:center'>
              <a href="?page=category_management&&function=del&&id=<?php echo $row["cat_id"];?>" onclick="return deleteConfirm()">
              <img src='image/delete.png' border='0' /></a></td>
            </tr>
            <?php 
            $No++;
            }
            ?>
			</tbody>
        </table>  
        
        
        <!--Nút Thêm mới , xóa tất cả-->
        <div class="row" style="background-color:#FFF"><!--Nút chức nang-->
            <div class="col-md-12">
            	
            </div>
        </div><!--Nút chức nang-->
 </form>
<?php
}
?>