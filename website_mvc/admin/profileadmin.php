<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/profileadmin.php';  ?>
<?php 
$profileadmin = new profileadmin();

?>
<style type="text/css">
    table.tblone tr:nth-child(2n+1){background:#fff;height:30px;}
table.tblone tr:nth-child(2n){background:#fdf0f1;height:30px;}
table{
    width: 1245px;
}
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2> Thông tin cá nhân</h2>
                <div class="block">               
                  <table class="tblone">
                    <?php
                    $show_profileadmin = $profileadmin->show_profileadmin();
                    if($show_profileadmin)
                    {
                        while ($result = $show_profileadmin->fetch_assoc()) {
                            
                    ?>
                      <tr>
                          <td>Tên tài khoản</td>
                          <td><?php echo $result['adminUser']; ?></td>
                      </tr>
                      <tr>
                          <td>Họ tên</td>
                          <td><?php echo $result['adminName']; ?></td>
                      </tr>
                      <tr>
                          <td>Email</td>
                          <td><?php echo $result['adminEmail']; ?></td>
                      </tr>
                      <?php 
                  }
              }
                      ?>
                  </table>    
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>