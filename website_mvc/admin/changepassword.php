<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/profileadmin.php';  ?>
<?php 
       $profileadmin = new profileadmin();
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
        $id = Session:: get('adminId');
        $update_profile = $profileadmin ->update_profileadmin($_POST, $id);
        

    } 
 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>ĐỔI MẬT KHẨU</h2>
        <div class="block">
        <?php 
        if(isset($update_profile))
        {
            echo $update_profile;
        }

        ?>               
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Mật khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu cũ..."  name="passold" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu mới..." name="passnew" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="update" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>