<?php 
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php
	$login_check = Session::get('customer_login');
	if($login_check)
	{
	header('Location: order.php');
	}
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	     //gọi hàm login admin bên class category , truyền vào catName
	     $insertCustomer = $cs->insert_customer($_POST);
	}
	?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
     //gọi hàm login admin bên class category , truyền vào catName
     $login_Customer = $cs->login_customer($_POST);
}
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <?php 
        	if(isset($login_Customer))
    		{
    			echo $login_Customer;
    		}
        	?>
            <form action="" method="POST">
                <input type="text" name="email" class="field" placeholder="Enter E-Mail">
                <input type="password" name="password" class="field" placeholder="Enter Password">

                <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                <div class="search">
                    <div><input type="submit" name="login" class="grey" value="Sign In" style="font-size: 20px"></div>
                </div>
        </div>
        </form>
        <div class="register_account">
            <h3>Register New Account</h3>
            <?php 
    		if(isset($insertCustomer))
    		{
    			echo $insertCustomer;
    		}
    		?>
            <form action="" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Enter Name">
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="Enter City">
                                </div>

                                <div>
                                    <input type="text" name="zipcode" placeholder="Enter Zip-Code">
                                </div>
                                <div data-validate="Valid email is: a@b.c">
                                    <input type="text" name="email" placeholder="Enter E-Mail">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Enter Address">
                                </div>
                                <div>
                                    <select id="country" name="country" onchange="change_country(this.value)"
                                        class="frm-field required">
                                        <option value="null">Select a Country</option>
                                        <option value="VN">Việt Nam</option>
                                        <option value="P">Pháp</option>
                                        <option value="HL">Hy Lạp</option>
                                        <option value="BL">Ba Lan</option>


                                    </select>
                                </div>

                                <div>
                                    <input type="text" name="phone" placeholder="Enter Phone">
                                </div>

                                <div>
                                    <input type="text" name="password" placeholder="Enter Password" ">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class=" search">
                                    <div><input type="submit" name="submit" class="grey" value="Create Account"
                                            style="font-size: 20px"></div>
                                </div>
                                <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp;
                                        Conditions</a>.</p>
                                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>


<?php 
include 'inc/footer.php';


?>