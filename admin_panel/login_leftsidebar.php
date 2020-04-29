<ul class="login_leftsidebar"> 

	<?php 

		?>
			
			<li <?php if(isset($_GET['p'])) { if( $_GET['p'] == "users" ) {
				echo 'class="active"';
			} } ?> ><a href="dashboard.php?p=users">All Users</a></li>
            <li <?php if(isset($_GET['p'])) { if( $_GET['p'] == "category_list" ) {
                echo 'class="active"';
            } } ?> ><a href="dashboard.php?p=category_list">Category List</a></li>
            <li <?php if(isset($_GET['p'])) { if( $_GET['p'] == "profile_question") {
                echo 'class="active"';
            } } ?> ><a href="dashboard.php?p=profile_question">Profile Question(s)</a></li>

			<li <?php if(isset($_GET['p'])) { if( $_GET['p'] == "notifications" ) {
				echo 'class="active"';
			} } ?> ><a href="dashboard.php?p=notifications">Send Notifications</a></li>

			<li <?php if(isset($_GET['p'])) { if( $_GET['p'] == "change_password" ) {
				echo 'class="active"';
			} } ?> ><a href="dashboard.php?p=change_password">Chanage Password</a></li>

			<li <?php if(isset($_GET['log'])) { if( $_GET['log'] == "out" ) {
				echo 'class="active"';
			} } ?> ><a href="dashboard.php?log=out">Logout</a></li>

			

	
		<?php

		?>

</ul>
