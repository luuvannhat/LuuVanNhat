<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/contact.php';  ?>
<?php
    // gọi class category trong classses
    $contact = new contact();     
        $del_contact = $contact -> del_contact($id); // hàm check delete Name khi submit lên
    
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách góp ý</h2>
                <div class="block">  
                <?php 
                    if(isset($del_contact)){
                        echo $del_contact;
                    }
                 ?>  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Họ và tên</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Tiêu đề</th>
							<th>Nội dung</th>
							<th>Xử lý</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_contact = $contact -> show_contact();
							if($show_contact){
								$i = 0;
								while($result = $show_contact -> fetch_assoc()){
									$i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['contactName']; ?></td>
							<td><?php echo $result['contactEmail']; ?></td>
							<td><?php echo $result['contactSdt']; ?></td>
							<td><?php echo $result['contactTieude']; ?></td>
							<td><?php echo $result['contactNoidung']; ?></td>
							<td><a onclick = "return confirm('Are you want to delete???')" href="?delid=<?php echo $result['contactId'] ?>">Delete</a></td>
						</tr>
						<?php 
							}
						}
						 ?>
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
