<?php include 'inc/header.php';?>
<?php include 'classes/contact.php';  ?>
<?php 
$contact = new contact();
// Nếu phương thức là Post
// Nếu phương thức là Post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
     
     $insertcontact = $contact->insert_contact($_POST);
}


?>
<div class="main">
    <div class="content">
        <div class="support">
            <div class="support_desc">
                <h3>Live Support</h3>
                <p><span><?php
  				if(isset($insertcontact))
  					echo $insertcontact ;
  				 ?></span></p>
            </div>
            <img src="web/images/contact.png" alt="" />
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="col span_2_of_3">
                <div class="contact-form">
                    <h2>Gửi thông tin liên hệ</h2>
                    <form method="POST">
                        <div>
                            <span><label>Họ và tên</label></span>
                            <span><input type="text" name="contactName" placeholder="Nhập họ tên"></span>
                        </div>
                        <div>
                            <span><label>Email</label></span>
                            <span><input type="text" name="contactEmail" placeholder="Nhập Email"></span>
                        </div>
                        <div>
                            <span><label>Số điện thoại</label></span>
                            <span><input type="text" name="contactSdt" placeholder="Nhập số điện thoại"></span>
                        </div>
                        <div>
                            <span><label>Tiêu đề</label></span>
                            <span><input type="text" name="contactTieude" placeholder="Nhập tiêu đề"></span>
                        </div>
                        <div>
                            <span><label>Nội dung</label></span>
                            <span><textarea name="contactNoidung" placeholder="Nhập nội dung"></textarea></span>
                        </div>
                        <div>
                            <span><input type="submit" name="submit" value="Gửi thông tin"></span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col span_1_of_3">
                <div class="company_address">
                    <h2>Thông tin liên hệ :</h2>
                    <p>Lưu Văn Nhật</p>
                    <p>0989898989</p>
                    <p> Hà Nội</p>
                    <p>Chuyên đề công nghệ phần mềm</p>
                    <p>CNTT6-K60</p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include 'inc/footer.php';


?>