<?php
	if(isset($_GET["p"]))
	{
		if($_GET["p"]=="signup")
		{
			signup();
		}
		else if ($_GET["p"]=="login") {
			login();
		}
		else if ($_GET["p"]=="forgot_password") {
			forgotPassword();
		}
		else if($_GET["p"]=="edit_profile")
		{
			edit_profile();
		}
		else if($_GET["p"]=="getUserInfo")
		{
			getUserProfile();
		}
		else if($_GET["p"]=="editImage") {
			edit_images();
		}
		else if($_GET["p"]=="userNearByMe")
		{
			userNearByMe();
			
		}
		else if($_GET["p"]=="aboutUs")
		{
			about_us();
		}
		else if($_GET["p"]=="helpCenter")
		{
			help_center();
		}
		else if($_GET["p"]=="userFeedback")
		{
			feedback();
		}
		else if($_GET["p"]=="enableNoti")
		{
			enable_notification();
		}
		else if($_GET["p"]=="like_unlike")
		{
			like_unlike();
		}
		else if($_GET["p"]=="favourite")
		{
			favourite();
		}
		else if($_GET["p"]=="getNotiStatus")
		{
			getNotiStatus();
		}
		else if($_GET["p"]=="getProfileInterest")
		{
			getProfileInterest();
		}
		else if($_GET["p"]=="updateProfileInterest")
		{
			updateProfileInterest();
		}
		else if($_GET["p"]=="socialLogin")
		{
			socialLogin();
		}
		else if($_GET["p"]=="nearbyStoryList")
		{
			nearby_story_list();
		}
		else if($_GET["p"]=="nearbyStoryAdd")
		{
			nearby_story_add();
		}
		//admin panel functions
		else
		if($_GET["p"]=="All_Users")
		{
			All_Users();
		}
		else
		if($_GET["p"]=="fake_profiles")
		{
			fake_profiles();
		}
		else
		if($_GET["p"]=="All_ReportedUsers")
		{
			All_ReportedUsers();
		}
		else
		if($_GET["p"]=="Admin_Login")
		{
			Admin_Login();
		}
		else
		if($_GET["p"]=="Update_From_Firebase")
		{
			Update_From_Firebase();
		}
		else
		if($_GET["p"]=="All_Matched_Profile")
		{
			All_Matched_Profile();
		}
	    else
		if($_GET["p"]=="changePassword")
		{
			changePassword();
		}
		else
		if($_GET["p"]=="getProfilePictures")
		{
			getProfilePictures();
		}
		else
		if($_GET["p"]=="getProfilelikes")
		{
			getProfilelikes();
		}
		else
		if($_GET["p"]=="getmatchedprofiles")
		{
			getmatchedprofiles();
		}
		else
		if($_GET["p"]=="get_profiles_nameByID")
		{
			get_profiles_nameByID();
		}
		else
		if($_GET["p"]=="banned_user")
		{
			banned_user();
		}
		else
		if($_GET["p"]=="under_review_new_uploaded_pictures")
		{
			under_review_new_uploaded_pictures();
		}
		else
		if($_GET["p"]=="underReviewPictureStatusChange")
		{
			underReviewPictureStatusChange();
		}
		else
		if($_GET["p"]=="convertProfile")
		{
			convertProfile();
		}
		else if($_GET["p"]=="matchNow")
		{
			matchNow();
		}
	    if($_GET["p"]=="addFakeProfile")
		{
			addFakeProfile();
		}
		else
	    if($_GET["p"]=="sendPushNotification")
		{
			sendPushNotification();
		}
		else
	    if($_GET["p"]=="mylikies")
		{
			mylikies();
		}
	    else
	    if($_GET["p"] =="question_list") {
			questionList();
		}
	
	}
	else
	{
		echo"Not Found";

	}

	function getAge($dob)
	{
	    
	    $birthDate = $dob;
          //explode the date to get month, day and year
          $birthDate = explode("/", $birthDate);
          //get age from date or birthdate
          $age = (date("md", date("U", @mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
	}

	function distance($lat1, $lon1, $lat2, $lon2, $unit) 
	{

	  $theta = $lon1 - $lon2;
	  $dist = sin(@deg2rad($lat1)) * sin(@deg2rad($lat2)) +  cos(@deg2rad($lat1)) * cos(@deg2rad($lat2)) * cos(@deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);
	
	  if ($unit == "K") {
		return ($miles * 1.609344);
	  } else if ($unit == "N") {
		  return ($miles * 0.8684);
		} else {
			return $miles;
		  }
	}
	
	function calculateAge($birthDate)
	{
	    //explode the date to get month, day and year
          $birthDate = explode("/", $birthDate);
          //get age from date or birthdate
          $age = (date("md", date("U", @mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

            return $age;
	}

	function signup()
	{
		require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
        $profile_type = "user";

		if ((isset($event_json['first_name']) && isset($event_json['last_name']) && isset($event_json['email'])))
		{
			$first_name=htmlspecialchars(strip_tags($event_json['first_name'] , ENT_QUOTES));
			$last_name=htmlspecialchars(strip_tags($event_json['last_name'] , ENT_QUOTES));
			$device_token=htmlspecialchars_decode(stripslashes($event_json['device_token']));
			$lat=htmlspecialchars_decode(stripslashes($event_json['lat']));
			$lng=htmlspecialchars_decode(stripslashes($event_json['lng']));
			$device=htmlspecialchars_decode(stripslashes($event_json['device']));
			$email=htmlspecialchars_decode(stripslashes($event_json['email']));
			$password=htmlspecialchars_decode(stripslashes($event_json['password']));

			    $qrry_1="insert into users(`first_name`,`last_name`,`profile_type`,`lat`,`long`,`device`,`device_token`,`email`,`password`)values(";
    			$qrry_1.="'".$first_name."',";
    			$qrry_1.="'".$last_name."',";
    			$qrry_1.="'".$profile_type."',";
    			$qrry_1.="'".$lat."',";
    			$qrry_1.="'".$lng."',";
    			$qrry_1.="'".$device."',";
    			$qrry_1.="'".$device_token."',";
    			$qrry_1.="'".$email."',";
    			$qrry_1.="'".sha1($password)."'";
    			$qrry_1.=")";

//    			var_dump(sha1($password)); die();

    			if($m = mysqli_query($conn,$qrry_1))
    			{
    				 $array_out = array();
    				 $array_out[] =
    					array(
    						"first_name" => $first_name,
    						"last_name" => $last_name,
							"device_token" => $device_token,
							"device" => $device,
							"lat" => $lat,
							"lng" => $lng,
							 "email" => $email,
							 "password" => $password,
						     "token" => 'abcTest',
						     "user_id" => mysqli_insert_id($conn)
    					);
    				$output=array( "code" => "200", "msg" => $array_out);
    				print_r(json_encode($output, true));
    			}
    			else
    			{
					$array_out = array();
					$array_out[] = array("response" =>"problem in signup");

					$output=array( "code" => "201", "msg" => $array_out);
					print_r(json_encode($output, true));
    			}
		} else {
            $array_out = array();

            $array_out[] =
                array(
                    "response" => "Json Param are missing");

            $output = array("code" => "201", "msg" => $array_out);
            print_r(json_encode($output, true));
        }
	}

	function login()
    {
        require_once("config.php");
        $input = @file_get_contents("php://input");
        $event_json = json_decode($input,true);
		if (isset($event_json['email']) && isset($event_json['password'])) {
			$device_token = htmlspecialchars_decode(stripslashes($event_json['device_token']));
			$lat = htmlspecialchars_decode(stripslashes($event_json['lat']));
			$lng = htmlspecialchars_decode(stripslashes($event_json['lng']));
			$device = htmlspecialchars_decode(stripslashes($event_json['device']));
			$email = htmlspecialchars_decode(stripslashes($event_json['email']));
			$password = htmlspecialchars_decode(stripslashes($event_json['password']));

			$log_in = "select * from users where email='" . $email . "' AND  password='" . sha1($password) . "'";
			$log_in_rs = mysqli_query($conn, $log_in);

			if (mysqli_num_rows($log_in_rs)) {
				$rd = mysqli_fetch_object($log_in_rs);
				// update user data

				$updateData = " UPDATE users SET `lat`='".$lat."', `long`='".$lng."', `device_token`='".$device_token."', `device`='".$device."' where id=". $rd->id;
				$update = mysqli_query($conn, $updateData);

				$array_out = array();
				$array_out[] =
					array(
						"user_id" => $rd->id,
						"first_name" => $rd->first_name,
						"last_name" => $rd->last_name,
						"device_token" => $device_token,
						"device" => $device,
						"lat" => $lat,
						"lng" => $lng,
						"email" => $email,
						"token" => 'abcTest'
					);

				$output = array("code" => "200", "msg" => $array_out);
				print_r(json_encode($output, true));
			} else {
				$array_out = array();

				$array_out[] =
					array(
						"response" =>"problem in login");

				$output=array( "code" => "201", "msg" => $array_out);
				print_r(json_encode($output, true));
			}
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" => "Json Param are missing");

			$output = array("code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
    }

	function forgotPassword() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

		if (isset($event_json['email'])) {
			$email = htmlspecialchars_decode(stripslashes($event_json['email']));

			$log_in = "select * from users where email='" . $email . "'";
			$log_in_rs = mysqli_query($conn, $log_in);
			if (mysqli_num_rows($log_in_rs)) {
				$rd = mysqli_fetch_object($log_in_rs);
				// Email Changed Password to user.
				$password = random_strings(8);
				$sentMail = sendEmail($password, $email);

				if($sentMail) {
					$updateData = "UPDATE users SET `password`='".sha1($password)."' where id=". $rd->id;
					$update = mysqli_query($conn, $updateData);

					$array_out = array();

					$array_out[] =
						array(
							"response" =>" An updated passwordword has been sent to your email please check");

					$output=array( "code" => "200", "msg" => $array_out);
					print_r(json_encode($output, true));
				} else {
					$array_out = array();

					$array_out[] =
						array(
							"response" =>"Issue encountered while sendoing a mail");

					$output=array( "code" => "201", "msg" => $array_out);
					print_r(json_encode($output, true));
				}


			} else {
				$array_out = array();

				$array_out[] =
					array(
						"response" =>"problem in forgot password");

				$output=array( "code" => "201", "msg" => $array_out);
				print_r(json_encode($output, true));
			}
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" => "Json Param are missing");

			$output = array("code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function questionList() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

		if(isset($event_json['user_id'])) {
			$quests = "select * from question_list";
			$list = mysqli_query($conn, $quests);
			if (mysqli_num_rows($list)) {
				$rd = mysqli_fetch_all($list);
//				print_r($rd); die();
				$array_out = array();
				foreach($rd as $r) {
//					print_r($r); die();/
					$array_out[] = array (
						'ques_id' => $r[0],
						'question' => $r[1]
					);
				}
				$output=array( "code" => "200", "msg" => $array_out);
				print_r(json_encode($output, true));
			} else {
				$array_out = array();

				$array_out[] =
					array(
						"response" =>"problem in question fetch");

				$output=array( "code" => "201", "msg" => $array_out);
				print_r(json_encode($output, true));
			}
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" => "Json Param are missing");

			$output = array("code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function getUserProfile()
    {
        require_once("config.php");
        $input = @file_get_contents("php://input");
        $event_json = json_decode($input, true);

        if (isset($event_json['user_id'])) {

            $user_id = htmlspecialchars(strip_tags($event_json['user_id'], ENT_QUOTES));

            $qrry_1 = "select * from users WHERE id ='" . $user_id . "' ";
            $log_in_rs = mysqli_query($conn, $qrry_1);

            if (mysqli_num_rows($log_in_rs)) {


                $rd = mysqli_fetch_object($log_in_rs);

                // get profile answers
				$query = "SELECT ua.answer, ql.question, ql.id FROM `user_answer` as ua right join question_list as ql ON ql.id = ua.ques_id AND ua.user_id =".$user_id;
				$query_list = mysqli_query($conn, $query);

//				$answerData = mysqli_fetch_all($query_list,MYSQLI_ASSOC);
				$answerData = array();

				while($m = mysqli_fetch_array($query_list)) {
					$answerData[] = array (
						"ques_id" => $m['id'],
						"question" => $m['question'],
						"answer" => is_null($m['answer'])?'':$m['answer']
					);

				}
                $array_out = array();

                $array_out[] =
                    array(
                        "about_me" => $rd->about_me,
                        "gender" => $rd->gender,
                        "birthday" => $rd->birthday,
                        "age" => $rd->age,
                        "first_name" => $rd->first_name,
                        "last_name" => $rd->last_name,
                        "user_answer" => $answerData,
						"image1" => isset($rd->image1)&& !empty($rd->image1)?'https://clientstagingdev.com/how_about_now/uploads/'.$rd->id.'/'.$rd->image1:'',
						"image2" => isset($rd->image2)&& !empty($rd->image2)?'https://clientstagingdev.com/how_about_now/uploads/'.$rd->id.'/'.$rd->image2:'',
						"image3" => isset($rd->image3)&& !empty($rd->image3)?'https://clientstagingdev.com/how_about_now/uploads/'.$rd->id.'/'.$rd->image3:'',
						"image4" => isset($rd->image4)&& !empty($rd->image4)?'https://clientstagingdev.com/how_about_now/uploads/'.$rd->id.'/'.$rd->image4:'',
						"image5" => isset($rd->image5)&& !empty($rd->image5)?'https://clientstagingdev.com/how_about_now/uploads/'.$rd->id.'/'.$rd->image5:'',
						"image6" => isset($rd->image6)&& !empty($rd->image6)?'https://clientstagingdev.com/how_about_now/uploads/'.$rd->id.'/'.$rd->image6:'',
                    );

                $output = array("code" => "200", "msg" => $array_out);
                print_r(json_encode($output, true));

            } else {
                $array_out = array();
                $array_out[] =
                    array(
                        "response" => "Json Param are missing");

                $output = array("code" => "201", "msg" => $array_out);
                print_r(json_encode($output, true));
            }
        }
    }

    function edit_profile() {
	require_once("config.php");
	$input = @file_get_contents("php://input");
	$event_json = json_decode($input,true);
	//print_r($event_json);
	//0= owner  1= company 2= ind mechanic

	if(isset($event_json['user_id']))
	{
		$user_id=htmlspecialchars(strip_tags($event_json['user_id'] , ENT_QUOTES));
		$about_me=htmlspecialchars(strip_tags($event_json['about_me'] , ENT_QUOTES));
		$gender=htmlspecialchars(strip_tags(strtolower($event_json['gender']) , ENT_QUOTES));
		$birthday=htmlspecialchars(strip_tags($event_json['birthday'] , ENT_QUOTES));
		$question_data=$event_json['question_data'];

		$age=calculateAge($birthday);

		if(count($question_data)) {
			foreach($question_data as $qd) {
//				print_r($qd); die();
				$checkTable = "Select * from user_answer where user_id = ".$user_id." AND ques_id =".$qd['ques_id'];
				$ct = mysqli_query($conn,$checkTable);
				if(mysqli_num_rows($ct)) {
					// update data
					$qrry_up = "UPDATE user_answer SET answer='".$qd['answer']."' WHERE user_id = ".$user_id." AND ques_id =".$qd['ques_id'];
					mysqli_query($conn,$qrry_up);
				} else {
					// insert Data
					$qrry_ins="insert into user_answer(`ques_id`,`user_id`,`answer`)values(";
					$qrry_ins.="'".$qd['ques_id']."',";
					$qrry_ins.="'".$user_id."',";
					$qrry_ins.="'".$qd['answer']."'";
					$qrry_ins.=")";
					mysqli_query($conn,$qrry_ins);
				}
			}
		}

		$qrry_1="update users SET about_me ='".$about_me."' , birthday ='".$birthday."' , age ='".$age."' , gender ='".$gender."'  WHERE id ='".$user_id."' ";

		if(mysqli_query($conn,$qrry_1))
		{
			$array_out = array();
			$array_out[] = array("response" => "Profile updated successfully");
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
		else
		{
			$array_out = array();

			$array_out[] =
				array(
					"response" =>"problem in updating");

			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}

	}
	else
	{
		$array_out = array();

		$array_out[] =
			array(
				"response" =>"Json Parem are missing");

		$output=array( "code" => "201", "msg" => $array_out);
		print_r(json_encode($output, true));
	}

	}

	function edit_images() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

		foreach($_FILES as $k => $f) {
			if ($f['size'] > 0) {
				$target_path = "../uploads/" . $_POST['user_id'] . "/";
				if (!is_dir($target_path)) {
					mkdir($target_path, 0777);
				}
				$target_path = $target_path . basename($f['name']);
				if (move_uploaded_file($f['tmp_name'], $target_path)) {
					$qrry_1 = "UPDATE users SET `$k`='" . $f['name'] . "' Where id = " . $_POST['user_id'];
					mysqli_query($conn, $qrry_1);
				} else {
					$array_out = array();
					$array_out[] = array("response" => "File upload failed");
					$output = array("code" => "201", "msg" => $array_out);
					print_r(json_encode($output, true));
					exit();
				}
			}
		}

		$array_out = array();
		$array_out[] =
			array("response" =>"Successfully uploaded");

		$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	}
//	function flat_user()
//	{
//	    require_once("config.php");
//	    $input = @file_get_contents("php://input");
//	    $event_json = json_decode($input,true);
//		//print_r($event_json);
//		//0= owner  1= company 2= ind mechanic
//
//		if(isset($event_json['fb_id']) && isset($event_json['my_id']))
//		{
//			$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
//			$my_id=htmlspecialchars(strip_tags($event_json['my_id'] , ENT_QUOTES));
//
//			$qrry_1="insert into flag_user(user_id,flag_by)values(";
//			$qrry_1.="'".$fb_id."',";
//			$qrry_1.="'".$my_id."'";
//			$qrry_1.=")";
//			if(mysqli_query($conn,$qrry_1))
//			{
//
//
//				 $array_out = array();
//				 $array_out[] =
//					//array("code" => "200");
//					array(
//        			"response" =>"successful");
//
//				$output=array( "code" => "200", "msg" => $array_out);
//				print_r(json_encode($output, true));
//			}
//			else
//			{
//			    //echo mysqli_error();
//			    $array_out = array();
//
//        		 $array_out[] =
//        			array(
//        			"response" =>"problem in signup");
//
//        		$output=array( "code" => "201", "msg" => $array_out);
//        		print_r(json_encode($output, true));
//			}
//
//
//
//		}
//		else
//		{
//			$array_out = array();
//
//			 $array_out[] =
//				array(
//				"response" =>"Json Parem are missing");
//
//			$output=array( "code" => "201", "msg" => $array_out);
//			print_r(json_encode($output, true));
//		}
//
//	}
//
//	function uploadImages()
//	{
//		require_once("config.php");
//	    $input = @file_get_contents("php://input");
//	    $event_json = json_decode($input,true);
//		//print_r($event_json);
//		//0= owner  1= company 2= ind mechanic
//
//		if(isset($event_json['fb_id']) && isset($event_json['image_link']) )
//		{
//			$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
//			$image_link=stripslashes(strip_tags($event_json['image_link']));
//
//			$qrry_1="select * from users WHERE fb_id ='".$fb_id."' ";
//			$log_in_rs=mysqli_query($conn,$qrry_1);
//
//			if(mysqli_num_rows($log_in_rs))
//			{
//			    $rd=mysqli_fetch_object($log_in_rs);
//
//			    if($rd->image2=="")
//			    {
//			        $colum_name="image2";
//			    }
//			    else
//			    if($rd->image3=="")
//			    {
//			        $colum_name="image3";
//			    }
//			    else
//			    if($rd->image4=="")
//			    {
//			        $colum_name="image4";
//			    }
//			    else
//			    if($rd->image5=="")
//			    {
//			        $colum_name="image5";
//			    }
//			    else
//			    if($rd->image6=="")
//			    {
//			        $colum_name="image6";
//			    }
//
//
//			    $qrry_1="insert into user_images(fb_id,image_url,columName)values(";
//        		$qrry_1.="'".$fb_id."',";
//        		$qrry_1.="'".$image_link."',";
//        		$qrry_1.="'".$colum_name."'";
//        		$qrry_1.=")";
//        		mysqli_query($conn,$qrry_1);
//
//			    $qrry_1="update users SET $colum_name ='".$image_link."' WHERE fb_id ='".$fb_id."' ";
//    			if(mysqli_query($conn,$qrry_1))
//    			{
//    			    $array_out = array();
//
//            		 $array_out[] =
//            			array(
//            			"response" =>"success");
//
//            		$output=array( "code" => "200", "msg" => $array_out);
//            		print_r(json_encode($output, true));
//    			}
//    			else
//    			{
//    			    $array_out = array();
//
//            		 $array_out[] =
//            			array(
//            			"response" =>"problem in uploading");
//
//            		$output=array( "code" => "201", "msg" => $array_out);
//            		print_r(json_encode($output, true));
//    			}
//			}
//		}
//		else
//		{
//			$array_out = array();
//
//			 $array_out[] =
//				array(
//				"response" =>"Json Parem are missing");
//
//			$output=array( "code" => "201", "msg" => $array_out);
//			print_r(json_encode($output, true));
//		}
//	}
//
//	function Update_From_Firebase()
//	{
//	    require_once("config.php");
//	    $input = @file_get_contents("php://input");
//	    $event_json = json_decode($input,true);
//
//	    $headers = array(
//		"Accept: application/json",
//		"Content-Type: application/json"
//    	);
//
//    	$data = array();
//
//    	$ch = curl_init($firebaseDb_URL.'/.json');
//
//    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//
//    	$return = curl_exec($ch);
//
//    	$json_data = json_decode($return, true);
//
//    	foreach ($json_data as $key => $item)
//    	{
//            // 		echo" this user >>   ";
//            // 		print_r($key);
//
//            // 		//print_r($item);
//            // 		echo"<br>";
//
//
//    		foreach ($item as $key1 => $item1)
//    		{
//
//    		  //  $data = array("fetch"=>"true");
//
//        //     	$ch = curl_init($firebaseDb_URL.'/'. $key .'/'.$key1.'/.json');
//
//        //     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        //     	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
//        //     	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//        //     	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//
//        //     	$return = curl_exec($ch);
//
//        //     	$json_data = json_decode($return, true);
//
//    		    if(!isset($item1['fetch']))
//    		    {
//
//    		       //print_r($item1['match']);
//        		     if($item1['match']=="false")
//        		     {
//        		         $match= "false";
//        		     }
//
//        		     if($item1['match']=="true")
//        		     {
//        		         $match= "true";
//        		     }
//        		     $effeted=$item1['effect'];
//
//                        		  //  echo "<br>";
//                        		  //  print_r($key);
//                            //         print_r($item1['type']);
//                            //         			echo"  this user >>>>>>    ";
//                            //         			print_r($key1);
//                            //         			print_r($item1['name']);
//                            //         			echo"<br>";
//
//
//        			$qrry_1="insert into like_unlike(action_profile,effect_profile,action_type,match_profile,effected)values(";
//            		$qrry_1.="'".$key."',";
//            		$qrry_1.="'".$key1."',";
//            		$qrry_1.="'".$item1['type']."',";
//            		$qrry_1.="'".$match."',";
//            		$qrry_1.="'".$effeted."'";
//            		$qrry_1.=")";
//            		if(mysqli_query($conn,$qrry_1))
//            		{
//            		    //echo "insert done";
//            		   // echo $item1['effect']=="true";
//            		    if($item1['type']=="like" && $item1['effect']=="true")
//            		    {
//            		        $qrry_1="update users SET like_count = like_count+1 WHERE fb_id ='".$key."' ";
//                			if(mysqli_query($conn,$qrry_1))
//                			{
//                			    //echo "udpate";
//                			}
//
//                			if($item1['status']=="1")
//                			{
//                    			$ch1 = curl_init($firebaseDb_URL.'/'. $key .'/'.$key1.'/.json');
//                				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
//                            	curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'DELETE');
//                            	curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
//                            	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
//
//                            	$return = curl_exec($ch1);
//
//                            	$json_data = json_decode($return, true);
//
//
//                            	$curl_error = curl_error($ch1);
//                            	$http_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
//                			}
//
//            		    }
//            		    else
//            		    if($item1['type']=="dislike" && $item1['effect']=="true")
//            		    {
//            		        $qrry_1="update users SET dislike_count = dislike_count+1 WHERE fb_id ='".$key."' ";
//                			if(mysqli_query($conn,$qrry_1))
//                			{
//                			    //echo "udpate";
//                			}
//
//                			$ch1 = curl_init($firebaseDb_URL.'/'. $key .'/'.$key1.'/.json');
//            				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
//                        	curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'DELETE');
//                        	curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
//                        	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
//
//                        	$return = curl_exec($ch1);
//
//                        	$json_data = json_decode($return, true);
//
//
//                        	$curl_error = curl_error($ch1);
//                        	$http_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
//
//                        	if($item1['status']=="1")
//                			{
//                    			$ch1 = curl_init($firebaseDb_URL.'/'. $key .'/'.$key1.'/.json');
//                				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
//                            	curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'DELETE');
//                            	curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
//                            	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
//
//                            	$return = curl_exec($ch1);
//
//                            	$json_data = json_decode($return, true);
//
//
//                            	$curl_error = curl_error($ch1);
//                            	$http_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
//                			}
//            		    }
//
//
//            		}
//
//    		    }
//
//
//    		}
//    	}
//
//
//
//    	//Delete firebase db data after insert
//
//    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
//    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//
//    	$return = curl_exec($ch);
//
//    	$json_data = json_decode($return, true);
//
//
//    	$curl_error = curl_error($ch);
//    	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//
//	}
	function userNearByMe()
	{
		require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
		//0= owner  1= company 2= ind mechanic
        
		if(isset($event_json['user_id']) && isset($event_json['current_lat']) && isset($event_json['current_long']))
		{

			$user_id=htmlspecialchars(strip_tags($event_json['user_id'] , ENT_QUOTES));
			$current_long=strip_tags($event_json['current_long']);
			$current_lat=strip_tags($event_json['current_lat']);

			$distance=strip_tags($event_json['distance']);
			$gender=strip_tags($event_json['gender']);
			
			$age_min =strip_tags($event_json['age_min']);
			$age_max =strip_tags($event_json['age_max']);
		    if($distance=="")
		    {
		        $distance="100000";
		    }

			$qrry_1="update users SET users.lat='".$current_lat."' , users.long='".$current_long."' WHERE id ='".$user_id."' ";
			if(mysqli_query($conn,$qrry_1))
			{
				if($gender=="")
			    {
			    	$query=mysqli_query($conn,"SELECT *, ( 3959 * acos( cos( radians($current_lat) ) * cos( radians( lat ) ) * cos( radians( users.long ) - radians($current_long) ) + sin( radians($current_lat) ) * sin( radians( lat ) ) ) ) AS distance FROM users WHERE age BETWEEN $age_min AND $age_max and id !='".$user_id."' HAVING distance <= $distance ORDER BY distance");
			    }
			    else
			    {
			        $query=mysqli_query($conn,"SELECT *, ( 3959 * acos( cos( radians($current_lat) ) * cos( radians( lat ) ) * cos( radians( users.long ) - radians($current_long) ) + sin( radians($current_lat) ) * sin( radians( lat ) ) ) ) AS distance FROM users WHERE gender = '$gender' AND age BETWEEN $age_min AND $age_max and  id !='".$user_id."' HAVING distance <= $distance ORDER BY distance");
			    }
				$array_out = array();
        		while($row=mysqli_fetch_array($query))
        		{
//        		    $qrry_1="select * from like_unlike where action_profile ='".$user_id."' and effect_profile ='".$row['effect_profile']."' ";
//        			$log_in_rs=mysqli_query($conn,$qrry_1);
//        			$rd=mysqli_fetch_object($log_in_rs);

					$query_count_total_like="select * from like_unlike where effect_profile ='".$user_id."' and match_profile='false' and chat='false' and action_type='like' ";
					$log_in_rs11_count_total_like=mysqli_query($conn,$query_count_total_like);
					$count_total_like=mysqli_num_rows($log_in_rs11_count_total_like);

					$query_count_total_super_like="select * from like_unlike where effect_profile ='".$user_id."' and match_profile='false' and chat='false' and action_type='superLike' ";
					$log_in_rs11_count_total_super_like=mysqli_query($conn,$query_count_total_super_like);
					$count_total_super_like=mysqli_num_rows($log_in_rs11_count_total_super_like);


//    			    if(@$rd->effect_profile != @$row['id'] || (@$rd->effected=="false" && @$rd->match_profile=="false"))
//    			    {
//    			        $action_type=@$rd->action_type;
//    			        if($action_type==null)
//						{
//							$action_type="false";
//						}
//
//            			$other_profiles_lat=$row['lat'];
//            			$other_profiles_long=$row['long'];
//
//
//        			    $INoneKM= distance($current_lat,$current_long,$other_profiles_lat,$other_profiles_long, "K");
//        				$underONE_KM=explode(".",$INoneKM);
//        				$birthDate = $row['birthday'];
//        				$age = $row['age'];
//
//            				 $array_out[] =
//            					array(
//            						"fb_id" => $row['fb_id'],
//            						"first_name" => $row['first_name'],
//            						"last_name" => $row['last_name'],
//            						"birthday" => "$age",
//            						"about_me" => htmlentities($row['about_me']),
//            						"distance" => $underONE_KM[0]." miles away",
//            						"gender" => $row['gender'],
//            						"image1" => $row['image1'],
//            						"image2" => $row['image2'],
//            						"image3" => $row['image3'],
//            						"image4" => $row['image4'],
//            						"image5" => $row['image5'],
//            						"image6" => $row['image6'],
//            						"job_title" => $row['job_title'],
//            						"company" => $row['company'],
//            						"school" => $row['school'],
//            						"swipe" => $action_type,
////            						"block" =>  $profile_block,  //0= normal  1=user blocked and auto logout
//									"hide_age" => $row['hide_age'],
//            						"hide_location" => $row['hide_location'],
//
//            					);
//        			   // }
//
//    			    }

					$array_out[] =
						array(
							"effective_user_id" => $row['id'],
							"about_me" => $row['about_me'],
							"gender" => $row['gender'],
							"birthday" => $row['birthday'],
							"age" => $row['age'],
							"first_name" =>$row['first_name'],
							"last_name" => $row['last_name'],
							"image1" => isset($row['image1'])&& !empty($row['image1'])?'https://clientstagingdev.com/how_about_now/uploads/'.$row['id'].'/'.$row['image1']:'',
							"image2" => isset($row['image2'])&& !empty($row['image2'])?'https://clientstagingdev.com/how_about_now/uploads/'.$row['id'].'/'.$row['image2']:'',
							"image3" => isset($row['image3'])&& !empty($row['image3'])?'https://clientstagingdev.com/how_about_now/uploads/'.$row['id'].'/'.$row['image3']:'',
							"image4" => isset($row['image4'])&& !empty($row['image4'])?'https://clientstagingdev.com/how_about_now/uploads/'.$row['id'].'/'.$row['image4']:'',
							"image5" => isset($row['image5'])&& !empty($row['image5'])?'https://clientstagingdev.com/how_about_now/uploads/'.$row['id'].'/'.$row['image5']:'',
							"image6" => isset($row['image6'])&& !empty($row['image6'])?'https://clientstagingdev.com/how_about_now/uploads/'.$row['id'].'/'.$row['image6']:'',
							"total_like"=>$count_total_like,
							"total_super_like"=>$count_total_super_like,
							"latitude" => $row['lat'],
							"longitude" => $row['long']
						);
				}
        		$output=array( "code" => "200", "msg" => $array_out);
        		print_r(json_encode($output, true));


			}
			else
			{
			    $array_out = array();
        		 $array_out[] = 
        			array(
        			"response" =>"problem in api");
        		$output=array( "code" => "201", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
		}
		else
		{
			$array_out = array();
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function about_us() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$query = "SELECT * FROM `company_info` where slug='about-us'";
		if($query1 = mysqli_query($conn,$query)) {
			$array_out = array();
			while($row=mysqli_fetch_array($query1)) {
				$array_out[] = array(
					"title" => $row['title'],
					"description" => $row['description']
				);
			}
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parem are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}

	}

	function help_center() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$query = "SELECT * FROM `company_info` where slug='help-center'";
		if($query1 = mysqli_query($conn,$query)) {
			$array_out = array();
			while($row=mysqli_fetch_array($query1)) {
				$array_out[] = array(
					"title" => $row['title'],
					"description" => $row['description']
				);
			}
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parm are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}

	}

	function feedback() {
	require_once("config.php");
	$input = @file_get_contents("php://input");
	$event_json = json_decode($input,true);
	if(isset($event_json['user_id']) && !empty($event_json['user_id'])) {
		$user_id = $event_json['user_id'];
		$comment = $event_json['comment'];

		$qrry_1="insert into user_feedback(`user_id`,`comment`)values(";
		$qrry_1.="'".$user_id."',";
		$qrry_1.="'".$comment."'";
//		$qrry_1.="'".$subject."'";
		$qrry_1.=")";

		if($m = mysqli_query($conn,$qrry_1)) {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Thank you for your valuable feedback");
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Server issue");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	} else {
		$array_out = array();
		$array_out[] =
			array(
				"response" =>"Json Parm are missing");
		$output=array( "code" => "201", "msg" => $array_out);
		print_r(json_encode($output, true));
	}

}

	function enable_notification() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);
		if(isset($event_json['user_id']) && !empty($event_json['user_id'])) {
			$user_id = $event_json['user_id'];
			$offer_promotions_noti = $event_json['offer_promotions_noti'];
			$friend_bday_noti = $event_json['friend_bday_noti'];
			$purchase_noti = $event_json['purchase_noti'];
			$like_noti = $event_json['like_noti'];
			$profile_visit_noti = $event_json['profile_visit_noti'];
			$new_message_noti = $event_json['new_message_noti'];
			$match_noti = $event_json['match_noti'];
			$recommend_noti = $event_json['recommend_noti'];

			// check if data exists
			$checkData = "SELECT * FROM user_notification where  user_id=".$user_id;
			$m = mysqli_query($conn,$checkData);

//			var_dump(mysqli_num_rows($m)); die();

			if(mysqli_num_rows($m)) {
				// update Data
				$updateData = "UPDATE user_notification SET `offer_promotions_noti`='".$offer_promotions_noti."', `friend_bday_noti`='".$friend_bday_noti."', `purchase_noti`='".$purchase_noti."', `like_noti`='".$like_noti."', `profile_visit_noti`='".$profile_visit_noti."', `new_message_noti`='".$new_message_noti."',  `match_noti`='".$match_noti."',`recommend_noti`='".$recommend_noti."' where user_id=". $user_id;;
				if(mysqli_query($conn,$updateData)) {
					$array_out = array();
					$array_out[] =
						array(
							"response" =>"Notifications settings updated");
					$output=array( "code" => "200", "msg" => $array_out);
					print_r(json_encode($output, true));
				} else {
					$array_out = array();
					$array_out[] =
						array(
							"response" =>"update Server issue");
					$output=array( "code" => "201", "msg" => $array_out);
					print_r(json_encode($output, true));
				}
			} else {
				// Insert Data
				$qrry_1="insert into user_notification(`user_id`,`offer_promotions_noti`,`friend_bday_noti`,`purchase_noti`,`like_noti`,`profile_visit_noti`,`new_message_noti`,`match_noti`,`recommend_noti`)values(";
				$qrry_1.="".$user_id.",";
				$qrry_1.="'".$offer_promotions_noti."',";
				$qrry_1.="'".$friend_bday_noti."',";
				$qrry_1.="'".$purchase_noti."',";
				$qrry_1.="'".$like_noti."',";
				$qrry_1.="'".$profile_visit_noti."',";
				$qrry_1.="'".$new_message_noti."',";
				$qrry_1.="'".$match_noti."',";
				$qrry_1.="'".$recommend_noti."'";
				$qrry_1.=")";
//				var_dump($qrry_1); die();
				if(mysqli_query($conn,$qrry_1)) {
					$array_out = array();
					$array_out[] =
						array(
							"response" =>"Notifications settings updated");
					$output=array( "code" => "200", "msg" => $array_out);
					print_r(json_encode($output, true));
				} else {
					$array_out = array();
					$array_out[] =
						array(
							"response" =>"insert Server issue");
					$output=array( "code" => "201", "msg" => $array_out);
					print_r(json_encode($output, true));
				}
			}
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parm are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function like_unlike() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

//		$token = $_SERVER['HTTP_AUTHTOKEN'];

		if(isset($event_json['user_id']) && !empty($event_json['user_id']) && isset($event_json['effective_user_id']) && !empty($event_json['effective_user_id'])) {
			switch((int)$event_json['type']) {
				case 0:
					//dislike
					$query = "INSERT INTO like_unlike (`action_profile`,`effect_profile`,`action_type`) VALUES (".$event_json['user_id'].",".$event_json['effective_user_id'].",".$event_json['type'].")";
					mysqli_query($conn,$query);
					if(mysqli_query($conn,$query)) {
						$array_out = array();
						$array_out[] =
							array(
								"response" =>"Pass");
						$output=array( "code" => "200", "msg" => $array_out);
						print_r(json_encode($output, true));
					}  else {
						$array_out = array();
						$array_out[] =
							array(
								"response" =>"Server issue");
						$output=array( "code" => "201", "msg" => $array_out);
						print_r(json_encode($output, true));
					}
					break;
				case 1:
				case 2:
					// 1 -> like; 2 -> SuperLike
					$checkData = "Select * from like_unlike where action_profile=".$event_json['effective_user_id']." AND effect_profile=".$event_json['user_id']." Limit 1";
					$cd = mysqli_query($conn,$checkData);
					if(mysqli_num_rows($cd)) {
						// Match Created
						// get user device_token
						$userData1 = "Select device_token from users where id =".$event_json['effective_user_id'];
						$result1 = mysqli_query($conn,$userData1);
						$device_token1 = mysqli_fetch_object($result1);

						$userData2 = "Select device_token from users where id =".$event_json['user_id'];
						$result2 = mysqli_query($conn,$userData2);
						$device_token2 = mysqli_fetch_object($result2);

						$this->push_notification($device_token1->device_token,'Profile Matched', array());
						$this->push_notification($device_token2->device_token,'Profile Matched', array());

						$update_query = "Update like_unlike SET match_profile= 1 where action_profile=".$event_json['effective_user_id']." AND effect_profile=".$event_json['user_id'];
						if(mysqli_query($conn,$update_query)) {
							$array_out = array();
							$array_out[] =
								array(
									"response" =>"Congratulations its a match..");
							$output=array( "code" => "200", "msg" => $array_out);
							print_r(json_encode($output, true));
						}  else {
							$array_out = array();
							$array_out[] =
								array(
									"response" =>"Server issue");
							$output=array( "code" => "201", "msg" => $array_out);
							print_r(json_encode($output, true));
						}

						// Notification For match

					} else {
						$insert_query = "INSERT INTO like_unlike (`action_profile`,`effect_profile`,`action_type`) VALUES (".$event_json['user_id'].",".$event_json['effective_user_id'].",".$event_json['type'].")";
//						mysqli_query($conn,$insert_query);
						if(mysqli_query($conn,$insert_query)) {
							$array_out = array();
							$array_out[] =
								array(
									"response" =>"profile liked");
							$output=array( "code" => "200", "msg" => $array_out);
							print_r(json_encode($output, true));
						} else {
							$array_out = array();
							$array_out[] =
								array(
									"response" =>"Server issue");
							$output=array( "code" => "201", "msg" => $array_out);
							print_r(json_encode($output, true));
						}
					}
					break;
			}

		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parm are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function favourite() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

		if(isset($event_json['user_id']) && !empty($event_json['user_id']) && isset($event_json['type']) && !empty($event_json['type'])) {
			$user_id = $event_json['user_id'];
			$type = $event_json['type'];
			$array_out = array();
			switch((int)$type) {
				case 1:
					$user_liked_you = "SELECT lu.action_profile,lu.effect_profile FROM like_unlike as lu where lu.effect_profile=".$user_id." AND (action_type = 1 OR action_type = 2) AND match_profile = 0";
					$query = mysqli_query($conn,$user_liked_you);
					break;
				case 2:
					$user_you_liked = "SELECT lu.action_profile,lu.effect_profile FROM like_unlike as lu where lu.action_profile=".$user_id." AND (action_type = 1 OR action_type = 2) AND match_profile = 0";
					$query = mysqli_query($conn,$user_you_liked);

					break;
				case 3:
					$match_profile = "SELECT lu.action_profile,lu.effect_profile FROM like_unlike as lu where (lu.action_profile=".$user_id." OR lu.effect_profile=".$user_id.") AND  (action_type = 1 OR action_type = 2) AND match_profile = 1";
					$query = mysqli_query($conn,$match_profile);
					break;
			}
			while($m=mysqli_fetch_array($query)) {
				if($m['action_profile'] != $user_id) {
					$userQuery = "SELECT * FROM users where users.id=".$m['action_profile']." LIMIT 1";
					$uq = mysqli_query($conn,$userQuery);
				} else {
					$userQuery = "SELECT * FROM users where users.id=".$m['effect_profile']." LIMIT 1";
					$uq = mysqli_query($conn,$userQuery);
				}
				$ud = mysqli_fetch_object($uq);
				$array_out[] = array(
					'image' => isset($ud->image1)&& !empty($ud->image1)?'https://clientstagingdev.com/how_about_now/uploads/'.$ud->id.'/'.$ud->image1:'',
					'name' => $ud->first_name.' '.$ud->last_name,
					'lat' =>$ud->lat,
					'long' => $ud->long
				);
			}
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parm are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function getNotiStatus() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

		if(isset($event_json['user_id']) && !empty($event_json['user_id'])) {
			$user_id = $event_json['user_id'];
			$array_out = array();
			$userQuery = "SELECT * FROM user_notification where user_notification.user_id=".$user_id;
			$uq = mysqli_query($conn,$userQuery);
			$ud = mysqli_fetch_object($uq);
//
//			print_r($ud->offer_promotions_noti); die();
			$array_out[] = array(
				'offer_promotions_noti' => is_null($ud->offer_promotions_noti)?0:$ud->offer_promotions_noti,
				'friend_bday_noti' => is_null($ud->friend_bday_noti)?0:$ud->friend_bday_noti,
				'purchase_noti' => is_null($ud->purchase_noti)?0:$ud->purchase_noti,
				'like_noti' => is_null($ud->like_noti)?0:$ud->like_noti,
				'profile_visit_noti' => is_null($ud->profile_visit_noti)?0:$ud->profile_visit_noti,
				'new_message_noti' => is_null($ud->new_message_noti)?0:$ud->new_message_noti,
				'match_noti' => is_null($ud->match_noti)?0:$ud->match_noti,
				'recommend_noti' => is_null($ud->recommend_noti)?0:$ud->recommend_noti,
				'user_id' => $ud->user_id
			);
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parm are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function getProfileInterest() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

		if(isset($event_json['user_id']) && !empty($event_json['user_id'])) {
			$user_id = $event_json['user_id'];
			$array_out = array();
			// get category List
			$categoryQuery = "SELECT * FROM interest_category ORDER BY sort_order ASC";
			$cq = mysqli_query($conn,$categoryQuery);
			$cd = mysqli_fetch_all($cq, MYSQLI_ASSOC);

			foreach($cd as $cd) {
				// user Data
				$userInterests = "SELECT * FROM user_interests where user_id =".$user_id." AND cat_id".$cd['id']." LIMIT 1";
				$ui = mysqli_query($conn,$userInterests);
				$ud = mysqli_fetch_object($ui);

				$array_out[] = array(
					'cat_id' => $cd['id'],
					'cat_name' => $cd['category_name'],
					'cat_image' => $cd['image'],
					'user_data' => isset($ud->interests) && !empty($ud->interests)?explode(",",$ud->interests):'',
				);
			}
//			die();
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parm are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function updateProfileInterest() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);

		if(isset($event_json['user_id']) && !empty($event_json['user_id'])) {
			$user_id = $event_json['user_id'];
			$user_interest = $event_json['user_interest'];
			$array_out = array();
			foreach ($user_interest as $value) {
				$userData = implode(",",$value['user_data']);
				// check if data exits
				$checkData = "SELECT * FROM user_interests where user_id=".$user_id." AND cat_id=".$value['cat_id'];
				$cd = mysqli_query($conn,$checkData);
				if(mysqli_num_rows($cd)) {
					// Update Data
					$updateQuery = "Update user_interests SET `interests`='".$userData."' where user_id=".$user_id." AND cat_id=".$value['cat_id'];
					if(!mysqli_query($conn,$updateQuery)) {
						$array_out[] =
							array(
								"response" =>"Server Error");
						exit();
					}
				} else {
					// insert Data
					$insertQuery = "INSERT INTO user_interests (`user_id`,`cat_id`,`interests`) VALUES (".$user_id.",".$value['cat_id'].",'".$userData."')";
					if(!mysqli_query($conn,$insertQuery)) {
						$array_out[] =
							array(
								"response" =>"Server Error");
						exit();
					}
				}
			}
			$array_out[] =
				array(
					"response" =>"Interest Updated Successfully");

			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" =>"Json Parm are missing");
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function socialLogin() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);
		if ((isset($event_json['first_name']) && isset($event_json['email'])))
		{
			$first_name=htmlspecialchars(strip_tags($event_json['first_name'] , ENT_QUOTES));
			$last_name=htmlspecialchars(strip_tags($event_json['last_name'] , ENT_QUOTES));
			$device_token=htmlspecialchars_decode(stripslashes($event_json['device_token']));
			$lat=htmlspecialchars_decode(stripslashes($event_json['lat']));
			$lng=htmlspecialchars_decode(stripslashes($event_json['lng']));
			$device=htmlspecialchars_decode(stripslashes($event_json['device']));
			$email=htmlspecialchars_decode(stripslashes($event_json['email']));
			$fb_id=htmlspecialchars_decode(stripslashes($event_json['fb_id']));
			$profile_type='user';

			// if data exits with that email
			$checkData = "SELECT * FROM users where email='$email'";
			$cd = mysqli_query($conn,$checkData);
			if(mysqli_num_rows($cd)) {
				// update data and login
				$rd = mysqli_fetch_object($cd);
				$updateData = " UPDATE users SET `lat`='".$lat."', `long`='".$lng."', `device_token`='".$device_token."', `device`='".$device."', `fb_id`='".$fb_id."' where id=". $rd->id;
				$update = mysqli_query($conn, $updateData);

				$array_out = array();
				$array_out[] =
					array(
						"user_id" => $rd->id,
						"first_name" => $rd->first_name,
						"last_name" => $rd->last_name,
						"device_token" => $device_token,
						"device" => $device,
						"lat" => $lat,
						"lng" => $lng,
						"email" => $email,
						"token" => 'abcTest'
					);

				$output = array("code" => "200", "msg" => $array_out);
				print_r(json_encode($output, true));
			} else {
				// insert Data and Login
				$qrry_1="insert into users(`first_name`,`last_name`,`profile_type`,`lat`,`long`,`device`,`device_token`,`email`,`fb_id`)values(";
				$qrry_1.="'".$first_name."',";
				$qrry_1.="'".$last_name."',";
				$qrry_1.="'".$profile_type."',";
				$qrry_1.="'".$lat."',";
				$qrry_1.="'".$lng."',";
				$qrry_1.="'".$device."',";
				$qrry_1.="'".$device_token."',";
				$qrry_1.="'".$email."',";
				$qrry_1.="'".$fb_id."'";
				$qrry_1.=")";
				if($m = mysqli_query($conn,$qrry_1))
				{
					$array_out = array();
					$array_out[] =
						array(
							"first_name" => $first_name,
							"last_name" => $last_name,
							"device_token" => $device_token,
							"device" => $device,
							"lat" => $lat,
							"lng" => $lng,
							"email" => $email,
							"token" => 'abcTest',
							"user_id" => mysqli_insert_id($conn)
						);
					$output=array( "code" => "200", "msg" => $array_out);
					print_r(json_encode($output, true));
				}
				else
				{
					$array_out = array();
					$array_out[] = array("response" =>"problem in signup");

					$output=array( "code" => "201", "msg" => $array_out);
					print_r(json_encode($output, true));
				}
			}
		} else {
			$array_out = array();

			$array_out[] =
				array(
					"response" => "Json Param are missing");

			$output = array("code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function nearby_story_list() {
		require_once("config.php");
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input,true);
		if(isset($event_json['user_id']) && !empty($event_json['user_id'])) {
			$user_id = $event_json['user_id'];
			// fetch Friend List
			$sql = "SELECT action_profile,effect_profile FROM `like_unlike` where (action_profile = $user_id OR effect_profile =$user_id) AND match_profile=1";
			$query = mysqli_query($conn,$sql);

			$array_out = array();
			if(mysqli_num_rows($query)){
				while($row=mysqli_fetch_array($query)){
					// Check stories
					if($user_id != $row['action_profile']) {
						$friendUser = $row['action_profile'];
					} else {
						$friendUser = $row['effect_profile'];
					}
					$userStories ="Select * from `nearby_stories` inner join users on users.id = nearby_stories.user_id where user_id=$friendUser";
					$story_query = mysqli_query($conn,$userStories);
					if(mysqli_num_rows($story_query)){
						while($data=mysqli_fetch_array($story_query)){
							$array_out[] = array(
								"image" => 'https://clientstagingdev.com/how_about_now'.$data['image'],
								'user_id'=> $data['user_id'],
								'user_name' => $data['first_name'].' '.$data['last_name']
							);
						}
					}
				}
				$output=array( "code" => "200", "msg" => $array_out);
				print_r(json_encode($output, true));

			}else {
				$array_out = array();
				$array_out[] = array("response" =>"No friend list found");

				$output=array( "code" => "201", "msg" => $array_out);
				print_r(json_encode($output, true));
			}

		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" => "Json Param are missing");
			$output = array("code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function nearby_story_add() {
		require_once("config.php");
		$user_id = $_POST['user_id'];
		if(isset($user_id) && !empty($user_id)){
			if($_FILES['image']['size']> 0){
				// upload image
				$target_path = "../uploads/story_data/" . $_POST['user_id'] . "/";
				if (!is_dir($target_path)) {
					mkdir($target_path, 0777);
				}
				$target_path = $target_path . basename($_FILES['image']['name']);
//				var_dump($target_path); die();
				if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
					$file_name = "/uploads/story_data/" . $_POST['user_id'] . "/".$_FILES['name'];
					$qrry_1 ="INSERT into nearby_stories (`user_id`,`image`) VALUES ($user_id,'" .$file_name."')";
					mysqli_query($conn, $qrry_1);
//					var_dump($qrry_1); die();
					$array_out = array();
					$array_out[] = array("response" => "story uploaded successfully");
					$output = array("code" => "200", "msg" => $array_out);
					print_r(json_encode($output, true));
				} else {
					$array_out = array();
					$array_out[] = array("response" => "File upload failed");
					$output = array("code" => "201", "msg" => $array_out);
					print_r(json_encode($output, true));
				}
			} else{
				$array_out = array();
				$array_out[] =
					array(
						"response" => "image param is required");
				$output = array("code" => "201", "msg" => $array_out);
				print_r(json_encode($output, true));
			}
		} else {
			$array_out = array();
			$array_out[] =
				array(
					"response" => "Json Param are missing");
			$output = array("code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function push_notification($device_id,$message,$data){

	//API URL of FCM
	$url = 'https://fcm.googleapis.com/fcm/send';
	$api_key = 'AAAAdQGU1n0:APA91bE7MPTgTzO2gL1nZAwEHQW3ALuDX_fFORiSqyTtjtdkn1ZiOydIn9Q04n_qOkGoMM40B5JcvgwMS02kgVI45CVyKFJX4X4yGbyyu4LSLr2i-0YNeSYuHpsDczTXv6sPXT4CQOk_';

	$fields = array (
		'registration_ids' => array (
			$device_id
		),
		'data' => array (
			"message" => $message
		)
	);

	//header includes Content type and api key
	$headers = array(
		'Content-Type:application/json',
		'Authorization:key='.$api_key
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	$result = curl_exec($ch);
	curl_close($ch);
	if ($result === FALSE) {
		return False;
	} else {
		return true;
	}
}

	//admin panel functions
	function banned_user()
	{
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	
		
		if(isset($event_json['fb_id']) )
		{
			$fb_id=strip_tags($event_json['fb_id']);
			$block=strip_tags($event_json['block']);
		
			$qrry_1="update users SET block ='".$block."' where fb_id='".$fb_id."' ";
			if(mysqli_query($conn,$qrry_1))
			{
			    $array_out = array();
					
        		 $array_out[] = 
        			array(
        			"response" =>"success");
        		
        		$output=array( "code" => "200", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
			else
			{
			    $array_out = array();
					
        		 $array_out[] = 
        			array(
        			"response" =>"problem in updating");
        		
        		$output=array( "code" => "201", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}       
	}

	function All_ReportedUsers()
	{
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		
		$query=mysqli_query($conn,"select * from flag_user order by id DESC");
		        
		$array_out = array();
		while($row=mysqli_fetch_array($query))
		{   
		    
		    $qrry_1="select * from users WHERE fb_id ='".$row['user_id']."' ";
			$log_in_rs=mysqli_query($conn,$qrry_1);
			
			$rd=mysqli_fetch_object($log_in_rs);
			
			$qrry_11="select * from users WHERE fb_id ='".$row['flag_by']."' ";
			$log_in_rs1=mysqli_query($conn,$qrry_11);
			
			$rd1=mysqli_fetch_object($log_in_rs1);
			    
		    $array_out[] = 
			array(
				"fb_id" => $rd->fb_id,
				"first_name" => htmlentities($rd->first_name),
				"last_name" => htmlentities($rd->last_name),
				"block" => $rd->block,
				"flag_by"=>
    				array(
        				"fb_id" => $rd1->fb_id,
        				"first_name" => htmlentities($rd1->first_name),
        				"last_name" => htmlentities($rd1->last_name),
        			),
			);
			
		}
		$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	}

	function All_Users()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		
		$query=mysqli_query($conn,"select * from users order by id DESC");
		        
		$array_out = array();
		while($row=mysqli_fetch_array($query))
		{   
		    
		     
		     
		   	 $array_out[] = 
				array(
					"fb_id" => $row['fb_id'],
					//"first_name" => htmlentities($row['first_name']),
					"first_name" => $row['first_name'],
					"last_name" => $row['last_name'],
					"birthday" => $row['birthday'],
					"about_me" => htmlentities($row['about_me']),
					"location" => $row['lat_long'],
					"purchased" => $row['purchased'],
					"gender" => $row['gender'],
					"image1" => $row['image1'],
					"image2" => $row['image2'],
					"image3" => $row['image3'],
					"image4" => $row['image4'],
					"image5" => $row['image5'],
					"image6" => $row['image6'],
					"like_count" => $row['like_count'],
					"dislike_count" => $row['dislike_count'],
					"created" => $row['created'],
					
				);
			
		}
		$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
		
	    
	}
	
	function fake_profiles()
	{
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		
		$query=mysqli_query($conn,"select * from users where profile_type='fake' order by id DESC");
		        
		$array_out = array();
		while($row=mysqli_fetch_array($query))
		{
		     
		   	 $array_out[] = 
				array(
					"fb_id" => $row['fb_id'],
					//"first_name" => htmlentities($row['first_name']),
					"first_name" => $row['first_name'],
					"last_name" => $row['last_name'],
					"birthday" => $row['birthday'],
					"about_me" => htmlentities($row['about_me']),
					"location" => $row['lat_long'],
					"purchased" => $row['purchased'],
					"gender" => $row['gender'],
					"image1" => $row['image1'],
					"image2" => $row['image2'],
					"image3" => $row['image3'],
					"image4" => $row['image4'],
					"image5" => $row['image5'],
					"image6" => $row['image6'],
					"like_count" => $row['like_count'],
					"dislike_count" => $row['dislike_count'],
					"created" => $row['created'],
					
				);
			
		}
		$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	}
	
	function Admin_Login()
	{   
	   	require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
		//0= owner  1= company 2= ind mechanic
		
		if(isset($event_json['email']) && isset($event_json['password']) )
		{
			$email=htmlspecialchars(strip_tags($event_json['email'] , ENT_QUOTES));
			$password=strip_tags($event_json['password']);
		
			
			$log_in="select * from admin where email='".$email."' and pass='".md5($password)."' ";
			$log_in_rs=mysqli_query($conn,$log_in);
			
			if(mysqli_num_rows($log_in_rs))
			{
				$array_out = array();
				 $array_out[] = 
					//array("code" => "200");
					array(
						"response" => "login success"
					);
				
				$output=array( "code" => "200", "msg" => $array_out);
				print_r(json_encode($output, true));
			}	
			else
			{
			    
    			$array_out = array();
    					
        		 $array_out[] = 
        			array(
        			"response" =>"Error in login");
        		
        		$output=array( "code" => "201", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
			
			
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function All_Matched_Profile()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		
		$query=mysqli_query($conn,"select * from like_unlike where match_profile='true' order by id DESC ");
		        
		$array_out = array();
		while($row=mysqli_fetch_array($query))
		{
		   	 $array_out[] = 
				array(
					"id" => $row['id'],
					"action_profile" => $row['action_profile'],
					"effect_profile" => $row['effect_profile']
				);
			
		}
		$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	    
	}

	function changePassword()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    //print_r($event_json);
		
		if(isset($event_json['new_password']) && isset($event_json['old_password']))
		{
			$old_password=strip_tags($event_json['old_password']);
			$new_password=strip_tags($event_json['new_password']);
		
		    $qrry_1="select * from admin where pass ='".md5($old_password)."' ";
			$log_in_rs=mysqli_query($conn,$qrry_1);
			$rd=mysqli_fetch_object($log_in_rs);
			
			if($rd->id!="")
			{
			    $qrry_1="update admin SET pass ='".md5($new_password)."' where id='".$rd->id."'  ";
    			if(mysqli_query($conn,$qrry_1))
    			{
    			    $array_out = array();
    					
            		 $array_out[] = 
            			array(
            			"response" =>"success");
            		
            		$output=array( "code" => "200", "msg" => $array_out);
            		print_r(json_encode($output, true));
    			}
    			else
    			{
    			    $array_out = array();
    					
            		 $array_out[] = 
            			array(
            			"response" =>"problem in updating");
            		
            		$output=array( "code" => "201", "msg" => $array_out);
            		print_r(json_encode($output, true));
    			}
			}
			else
			{
			    $array_out = array();
					
        		 $array_out[] = 
        			array(
        			"response" =>"problem in updating");
        		
        		$output=array( "code" => "201", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
			
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	    
	}

	function getProfilePictures()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
		//0= owner  1= company 2= ind mechanic
		
		if(isset($event_json['fb_id']))
		{
			$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
			//$about_me=htmlspecialchars(strip_tags($event_json['about_me'] , ENT_QUOTES));
			
			
			$qrry_1="select * from users WHERE fb_id ='".$fb_id."' ";
			$log_in_rs=mysqli_query($conn,$qrry_1);
			
			if(mysqli_num_rows($log_in_rs))
			{
			    $rd=mysqli_fetch_object($log_in_rs);
			    $array_out = array();
					
        		 $array_out[] = 
        			array(
        			"first_name" => htmlentities($rd->first_name),
					"last_name" => htmlentities($rd->last_name),
					"birthday" => $rd->birthday,
					"gender" => $rd->gender,
					"purchased" => $rd->purchased,
					"version" => $rd->version,
					"block" => $rd->block,
					"device" => $rd->device,
					"hide_me" => $rd->hide_me,
					"about_me" => htmlentities($rd->about_me),
					"location" => $rd->location,
					"profile_type" => $rd->profile_type,
					"like_count" => $rd->like_count,
					"dislike_count" => $rd->dislike_count,
					"image1" => stripslashes($rd->image1),
					"image2" => stripslashes($rd->image2),
        			"image3" => stripslashes($rd->image3),
        			"image4" => stripslashes($rd->image4),
        			"image5" => stripslashes($rd->image5),
        			"image6" => stripslashes($rd->image6),
        			"created" => $rd->created
        			);
        		
        		$output=array( "code" => "200", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
			else
			{
			    $array_out = array();
					
        		 $array_out[] = 
        			array(
        			"response" =>"problem in updating");
        		
        		$output=array( "code" => "201", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
			
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	    
	}
	
	function getProfilelikes()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
		//0= owner  1= company 2= ind mechanic
		
		if(isset($event_json['fb_id']) && isset($event_json['status']))
		{
			$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
			$status=htmlspecialchars(strip_tags($event_json['status'] , ENT_QUOTES));
			
			
			$qrry_1="select * from like_unlike WHERE effect_profile ='".$fb_id."' and action_type='".$status."' and effected='true' ";
			$log_in_rs=mysqli_query($conn,$qrry_1);
			
			$array_out = array();
    		while($row=mysqli_fetch_array($log_in_rs))
    		{
    		    $qrry_11="select * from users WHERE fb_id ='".$row['action_profile']."' ";
    			$log_in_rs1=mysqli_query($conn,$qrry_11);
    			
    			while($row1=mysqli_fetch_array($log_in_rs1))
        		{
        		    
    		        $array_out[] = 
    				array(
    					"action_profile" => $row['action_profile'],
    					"profile_info" => 
    					array(
    					        "fb_id" => $row1['fb_id'],
    					        "first_name" => htmlentities($row1['first_name']),
    					        "image1" => htmlspecialchars_decode(stripslashes($row1['image1'])),
    					        "last_name" => htmlentities($row1['last_name']),
    					        "like_count" => $row1['like_count'],
    					        "dislike_count" => $row1['dislike_count']
    					    ),
    					
    				);
    		    
        		}
    			
    		}
    		$output=array( "code" => "200", "msg" => $array_out);
    		print_r(json_encode($output, true));
			
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	    
	}
	
	function getmatchedprofiles()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
		//0= owner  1= company 2= ind mechanic
		
		if(isset($event_json['fb_id']) )
		{
			$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
			
			$qrry_1="select * from like_unlike WHERE effect_profile ='".$fb_id."' and match_profile='true' ";
			$log_in_rs=mysqli_query($conn,$qrry_1);
			
			$array_out = array();
    		while($row=mysqli_fetch_array($log_in_rs))
    		{
    		    $qrry_11="select * from users WHERE fb_id ='".$row['action_profile']."' ";
    			$log_in_rs1=mysqli_query($conn,$qrry_11);
    			
    			while($row1=mysqli_fetch_array($log_in_rs1))
        		{
        		    
    		        $array_out[] = 
    				array(
    					"action_profile" => $row['action_profile'],
    					"profile_info" => 
    					array(
    					        "fb_id" => $row1['fb_id'],
    					        "image1" => htmlspecialchars_decode(stripslashes($row1['image1'])),
    					        "first_name" => htmlentities($row1['first_name']),
    					        "last_name" => htmlentities($row1['last_name']),
    					        "like_count" => $row1['like_count'],
    					        "dislike_count" => $row1['dislike_count']
    					    ),
    					
    				);
    		    
        		}
    			
    		}
    		$output=array( "code" => "200", "msg" => $array_out);
    		print_r(json_encode($output, true));
			
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	    
	}

	function update_purchase_Status()
	{
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
	    
	    $qrry_1="update users SET purchased ='1' WHERE fb_id ='".$fb_id."' ";
		if(mysqli_query($conn,$qrry_1))
		{
		    $array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"update succesfully");
		}
	    
    	$output=array( "code" => "202", "msg" => $array_out);
		print_r(json_encode($output, true));
	    
	} 

	function get_profiles_nameByID()
	{
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $fb_id=$event_json['fb_id'];
	    
	    
	    $query="select * from users where fb_id IN (".$fb_id.") order by fb_id ";
	    $log_in_rs1=mysqli_query($conn,$query);
	    $array_out = array();
	    while($row1=mysqli_fetch_array($log_in_rs1))
		{
		    $array_out[] = 
				array(
					"fb_id" => $row1['fb_id'],
					"first_name" => htmlentities($row1['first_name']),
					"last_name" => htmlentities($row1['last_name'])
				);
		}
	    
    	$output=array( "code" => "202", "msg" => $array_out);
		print_r(json_encode($output, true));
	    
	} 
	
	function myMatch()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $fb_id=$event_json['fb_id'];
	    
		$query1="select * from like_unlike where effect_profile ='".$fb_id."' and match_profile='false' and chat='false' and (action_type='superLike' or action_type='like') order by rand() ";
		
	    $log_in_rs11=mysqli_query($conn,$query1);
	    $array_out1 = array();
	    while($row11=mysqli_fetch_array($log_in_rs11))
		{
		    $query_11="select * from users where fb_id ='".$row11['action_profile']."' ";
	        $log_in_rs1_1_1=mysqli_query($conn,$query_11);
		    $rd_1=mysqli_fetch_object($log_in_rs1_1_1); 
		    
		    $query1_2="select * from users where fb_id ='".$row11['effect_profile']."' ";
	        $log_in_rs11_2=mysqli_query($conn,$query1_2);
		    $rd1_2=mysqli_fetch_object($log_in_rs11_2); 
		    
		    $array_out1[] = 
				array(
					"action_profile" => $row11['action_profile'],
					"action_profile_name"=> array
					(
					    "image1" => htmlentities($rd_1->image1),
					    "first_name" => htmlentities($rd_1->first_name),
					    "last_name" => htmlentities($rd_1->last_name)
					)
				);
		}
		
		$userWhoLikeMe=$arrryy[] = 
			array(
				"total" => count($array_out1),
				"image1" =>$array_out1[0]['action_profile_name']['image1']
			);
	    
	    $query="select * from like_unlike where action_profile ='".$fb_id."' and match_profile='true' and chat='false' ";
	    $log_in_rs1=mysqli_query($conn,$query);
	    $array_out = array();
	    while($row1=mysqli_fetch_array($log_in_rs1))
		{
		    $query="select * from users where fb_id ='".$row1['action_profile']."' ";
	        $log_in_rs1_1=mysqli_query($conn,$query);
		    $rd=mysqli_fetch_object($log_in_rs1_1); 
		    
		    $query1="select * from users where fb_id ='".$row1['effect_profile']."' ";
	        $log_in_rs11=mysqli_query($conn,$query1);
		    $rd1=mysqli_fetch_object($log_in_rs11); 
		    
		    $array_out[] = 
				array(
					"action_profile" => $row1['action_profile'],
					"action_profile_name"=> array
					(
					    "image1" => htmlentities($rd->image1),
					    "first_name" => htmlentities($rd->first_name),
					    "last_name" => htmlentities($rd->last_name)
					),
					"effect_profile" => htmlentities($row1['effect_profile']),
					"effect_profile_name"=> array
					(
					    "image1" => htmlentities($rd1->image1),
					    "first_name" => htmlentities($rd1->first_name),
					    "last_name" => htmlentities($rd1->last_name)
					)
				);
		}
	    
    	$output=array( "code" => "200", "msg" => $array_out , "myLikes"=>$userWhoLikeMe);
		print_r(json_encode($output, true));
		
	}

	function mylikies()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $fb_id=$event_json['fb_id'];
	    $lat_long=strip_tags($event_json['lat_long']);
		
		
		
		//remove after fetch
        	    
    	    $headers = array(
    		"Accept: application/json",
    		"Content-Type: application/json"
        	);
        	
        	$data = array();
        	
        	$ch = curl_init($firebaseDb_URL.'/.json');
        	
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        	
        	$return = curl_exec($ch);
        	
        	$json_data = json_decode($return, true);
        	
        	$datacount=@count($json_data);
			if($datacount!="0")
			{
				foreach ($json_data as $key => $item) 
				{
					foreach ($item as $key1 => $item1)
					{
						
					 
						if(!isset($item1['fetch']))
						{
						   
						   //print_r($item1['match']);
    						 if($item1['match']=="false")
    						 {
    							 $match= "false";
    						 }
    						 
    						 if($item1['match']=="true")
    						 {
    							 $match= "true";
    						 }
    						 
    						 $effeted=$item1['effect'];
    						 
    						 
							 
							$qrry_1="select * from like_unlike where action_profile ='".$key."' and effect_profile ='".$key1."' ";
							$log_in_rs=mysqli_query($conn,$qrry_1);
							if(mysqli_num_rows($log_in_rs))
							{
							   mysqli_query($conn,"update like_unlike SET match_profile ='true' WHERE action_profile ='".$key."' and effect_profile ='".$key1."' ");
							   //echo "update 1";
							}
							else
							{
								$qrry_1="insert into like_unlike(action_profile,effect_profile,action_type,match_profile,effected)values(";
								$qrry_1.="'".$key."',";
								$qrry_1.="'".$key1."',";
								$qrry_1.="'".$item1['type']."',";
								$qrry_1.="'".$match."',";
								$qrry_1.="'".$effeted."'";
								$qrry_1.=")";
								if(mysqli_query($conn,$qrry_1))
								{
									if($item1['type']=="like" && $item1['effect']=="true")
									{
										$qrry_1="update users SET like_count = like_count+1 WHERE fb_id ='".$key1."' ";
										if(mysqli_query($conn,$qrry_1))
										{
											//echo "udpate";
										}
										
									 }
									else
									if($item1['type']=="dislike" && $item1['effect']=="true")
									{
										$qrry_1="update users SET dislike_count = dislike_count+1 WHERE fb_id ='".$key1."' ";
										if(mysqli_query($conn,$qrry_1))
										{
											//echo "udpate";
										}
										
										
									}
									
								   
								} 
								
								
							}
						 
							
						}
						 
						
					}
				}
			}
        	
        	//Delete firebase db data after insert
        	
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        	
        	$return = curl_exec($ch);
        	
        	$json_data = json_decode($return, true);
        	
        	
        	$curl_error = curl_error($ch);
        	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        	//end--------------------------------------------------------------------
			
			
		
		$query1="select * from like_unlike where effect_profile ='".$fb_id."' and match_profile='false' and chat='false' and (action_type='superLike' or action_type='like')";
		
	    $log_in_rs11=mysqli_query($conn,$query1);
	    $array_out1 = array();
	    while($row11=mysqli_fetch_array($log_in_rs11))
		{	
		
			
			  
			$query="select * from users where fb_id ='".$row11['action_profile']."' ";
	        $rows=mysqli_query($conn,$query);
		    $rd1=mysqli_fetch_object($rows); 
			
			
			$mylocation=explode(",",$lat_long);
			$other_profiles=explode(",",$rd1->lat_long);
			
			
			$INoneKM= distance($mylocation[0],$mylocation[1],$other_profiles[0],$other_profiles[1], "K");
			$underONE_KM=explode(".",$INoneKM);
			
			
			
			 $birthDate = $rd1->birthday;
			  //explode the date to get month, day and year
			  $birthDate = explode("/", $birthDate);
			  //get age from date or birthdate
			  $age = (date("md", date("U", @mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
				? ((date("Y") - $birthDate[2]) - 1)
				: (date("Y") - $birthDate[2]));
				
			 $array_out1[] = 
				//array("code" => "200");
				array(
					"fb_id" => $rd1->fb_id,
					"first_name" => $rd1->first_name,
					"last_name" => $rd1->last_name,
					"birthday" => $age,
					"about_me" => htmlentities($rd1->about_me),
					"distance" => $underONE_KM[0]." miles away",
					"gender" => $rd1->gender,
					"image1" => $rd1->image1,
					"image2" => $rd1->image2,
					"image3" => $rd1->image3,
					"image4" => $rd1->image4,
					"image5" => $rd1->image5,
					"image6" => $rd1->image6,
					"job_title" => $rd1->job_title,
					"company" => $rd1->company,
					"swipe" =>$row11['action_type'],
					"school" => $rd1->school
				);
			////////	
					
		    /*$query_11="select * from users where fb_id ='".$row11['action_profile']."' ";
	        $log_in_rs1_1_1=mysqli_query($conn,$query_11);
		    $rd_1=mysqli_fetch_object($log_in_rs1_1_1); 
		    
		    $query1_2="select * from users where fb_id ='".$row11['effect_profile']."' ";
	        $log_in_rs11_2=mysqli_query($conn,$query1_2);
		    $rd1_2=mysqli_fetch_object($log_in_rs11_2); 
		    
		    $array_out1[] = 
				array(
					"action_profile" => $row11['action_profile'],
					"action_profile_name"=> array
					(
					    "image1" => htmlentities($rd_1->image1),
					    "first_name" => htmlentities($rd_1->first_name),
					    "last_name" => htmlentities($rd_1->last_name)
					)
				);*/
		}
		
		$output=array( "code" => "200", "msg" => $array_out1);
		print_r(json_encode($output, true));
		
	}
	
	function firstchat()
	{
	    
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
	    $effected_id=htmlspecialchars(strip_tags($event_json['effected_id'] , ENT_QUOTES));
	    
	    $qrry_1="update like_unlike SET chat ='true' WHERE action_profile ='".$fb_id."' and effect_profile ='".$effected_id."' ";
	    mysqli_query($conn,"update like_unlike SET chat ='true' WHERE action_profile ='".$effected_id."' and effect_profile ='".$fb_id."'");
		if(mysqli_query($conn,$qrry_1))
		{
		    $array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"update succesfully");
		}
	    
    	$output=array( "code" => "202", "msg" => $array_out);
		print_r(json_encode($output, true));
	    
	}

	function unMatch()
	{
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $fb_id=$event_json['fb_id'];
	    $other_id=$event_json['other_id'];

	    //remove from my inbox
        	    
	    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
    	);
    	
    	$data = array();
    	
    
    	$url= $firebaseDb_URL_MainDb.'/Inbox/'.$fb_id.'/'.$other_id.'/.json';
    	$ch = curl_init($url);
    	
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	
    	$return = curl_exec($ch);
    	
    	$json_data = json_decode($return, true);
    	
    	//delete from other user inbox as well
    	$data = array();
    	
    	$url=$firebaseDb_URL_MainDb.'/Inbox/'.$other_id.'/'.$fb_id.'/.json';
    	$ch = curl_init($url);
    	
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	
    	$return = curl_exec($ch);
    	
    	$json_data = json_decode($return, true);
    	
    	
	    mysqli_query($conn,"Delete from like_unlike where action_profile ='".$fb_id."' and effect_profile='".$other_id."'  ");
	    mysqli_query($conn,"Delete from like_unlike where effect_profile ='".$fb_id."' and action_profile='".$other_id."'  ");
	    
	    $array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"update succesfully");
	        
    	$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
		
		
	}
	
	function deleteAccount()
	{
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $fb_id=$event_json['fb_id'];
	   
	    //remove from my inbox
        	    
	    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
    	);
    	
    	$data = array();
    	
    
    	$url= $firebaseDb_URL_MainDb.'/Users/'.$fb_id.'/.json';
    	$ch = curl_init($url);
    	
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	
    	$return = curl_exec($ch);
    	
    	$json_data = json_decode($return, true);
    	
    	//delete from other user inbox as well
    	$data = array();
    	
    	$url=$firebaseDb_URL_MainDb.'/Inbox/'.$fb_id.'/.json';
    	$ch = curl_init($url);
    	
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	
    	$return = curl_exec($ch);
    	
    	$json_data = json_decode($return, true);
    	
    	foreach ($json_data as $key => $item) 
    	{
    	    //echo $key;
    	    //remove chat from my inbox
	    	$data = array();
	    	$url=$firebaseDb_URL_MainDb.'/chat/'.$fb_id.'-'.$key.'/.json';
        	$ch = curl_init($url);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        	$return = curl_exec($ch);
        	$json_data = json_decode($return, true);
        	    
        	        //remove from my Inbox
                    	$data = array();
                    	$url=$firebaseDb_URL_MainDb.'/Inbox/'.$fb_id.'/'.$key.'/.json';
                    	$ch = curl_init($url);
                    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    	$return = curl_exec($ch);
                    	$json_data = json_decode($return, true);
                    	
                    //remove from other person Inbox
                    	$data = array();
                    	$url=$firebaseDb_URL_MainDb.'/Inbox/'.$key.'/'.$fb_id.'/.json';
                    	$ch = curl_init($url);
                    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    	$return = curl_exec($ch);
                    	$json_data = json_decode($return, true);    	
        	    
        	//remove chat from oter inbox
        	$data = array();
	    	$url=$firebaseDb_URL_MainDb.'/chat/'.$key.'-'.$fb_id.'/.json';
        	$ch = curl_init($url);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        	$return = curl_exec($ch);
        	$json_data = json_decode($return, true);
    	}
    	
    	
    	
    	
    	mysqli_query($conn,"Delete from like_unlike where action_profile ='".$fb_id."' ");
	    mysqli_query($conn,"Delete from like_unlike where effect_profile ='".$fb_id."' ");
	    mysqli_query($conn,"Delete from users where fb_id ='".$fb_id."' ");
	    
	    $array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Delete succesfully");
	        
    	$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	}

	function under_review_new_uploaded_pictures()
	 {
	     
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    $query="select * from user_images ";
	    $log_in_rs1=mysqli_query($conn,$query);
	    $array_out = array();
	    while($row1=mysqli_fetch_array($log_in_rs1))
		{
		    
		    $query1="select * from users where fb_id ='".$row1['fb_id']."' ";
	        $log_in_rs11=mysqli_query($conn,$query1);
		    $rd=mysqli_fetch_object($log_in_rs11); 
		    
		    $array_out[] = 
				array(
					"id" => $row1['id'],
					"fb_id" => $row1['fb_id'],
					"image_url" => $row1['image_url'],
					"created_time" => $row1['created_time'],
					"first_name" => $rd->first_name,
					"last_name" => $rd->last_name,
					"columName" => $row1['columName']
				);
		}
	    
    	$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	 }

	function underReviewPictureStatusChange()
	 {
	     
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    
	    $fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
	    $action=htmlspecialchars(strip_tags($event_json['action'] , ENT_QUOTES));
	    $id=htmlspecialchars(strip_tags($event_json['id'] , ENT_QUOTES));
	    $columName=htmlspecialchars(strip_tags($event_json['columName'] , ENT_QUOTES));
	    $imgurl=urldecode($event_json['imgurl']);
	    
	    //print_r($event_json);
	    
	    if($action=="approve")
	    {
	       mysqli_query($conn,"Delete from user_images where id ='".$id."'  "); 
	    }
	    else
	    if($action=="delete")
	    {
	        
	       	mysqli_query($conn,"update users SET image1 ='' WHERE image1 ='".$imgurl."' ");
	       	mysqli_query($conn,"update users SET image2 ='' WHERE image2 ='".$imgurl."' ");
	       	mysqli_query($conn,"update users SET image3 ='' WHERE image3 ='".$imgurl."' ");
	       	mysqli_query($conn,"update users SET image4 ='' WHERE image4 ='".$imgurl."' ");
	       	mysqli_query($conn,"update users SET image5 ='' WHERE image5 ='".$imgurl."' ");
	       	mysqli_query($conn,"update users SET image6 ='' WHERE image6 ='".$imgurl."' ");
	       	
    		mysqli_query($conn,"Delete from user_images where id ='".$id."'  "); 
	    }
	    
	    $array_out = array();
		 $array_out[] = 
			//array("code" => "200");
			array(
			"response" =>"successful");
		
		$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	   
	 }
	 
	function matchNow()
	 {
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
		//0= owner  1= company 2= ind mechanic
		
		if(isset($event_json['fb_id']) && isset($event_json['my_id']))
		{
			$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
			$my_id=htmlspecialchars(strip_tags($event_json['my_id'] , ENT_QUOTES));
			
			$qrry_1="insert into like_unlike(action_profile,effect_profile,action_type,match_profile,effected,chat)values(";
			$qrry_1.="'".$my_id."',";
			$qrry_1.="'".$fb_id."',";
			$qrry_1.="'like',";
			$qrry_1.="'false',";
			$qrry_1.="'true',";
			$qrry_1.="'false'";
			$qrry_1.=")";
			if(mysqli_query($conn,$qrry_1))
			{
			    
			    $qrry_1="insert into like_unlike(action_profile,effect_profile,action_type,match_profile,effected,chat)values(";
    			$qrry_1.="'".$fb_id."',";
    			$qrry_1.="'".$my_id."',";
    			$qrry_1.="'like',";
    			$qrry_1.="'false',";
    			$qrry_1.="'false',";
    			$qrry_1.="'false'";
    			$qrry_1.=")";
    			if(mysqli_query($conn,$qrry_1))
    			{
			         $array_out = array();
    				 $array_out[] = 
    					//array("code" => "200");
    					array(
            			"response" =>"successful");
    				
    				$output=array( "code" => "200", "msg" => $array_out);
    				print_r(json_encode($output, true));
    			}
			}
			else
			{
			    //echo mysqli_error();
			    $array_out = array();
					
        		 $array_out[] = 
        			array(
        			"response" =>"problem in signup");
        		
        		$output=array( "code" => "201", "msg" => $array_out);
        		print_r(json_encode($output, true));
			}
			
			
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	 }
	 
	function convertProfile()
	 {
	    require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
	    
	    
	    $fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
	    $profile_type=htmlspecialchars(strip_tags($event_json['profile_type'] , ENT_QUOTES));
	    
	    mysqli_query($conn,"update users SET profile_type ='".$profile_type."' WHERE fb_id ='".$fb_id."' ");
	    
	    $array_out = array();
		 $array_out[] = 
			//array("code" => "200");
			array(
			"response" =>"successful");
		
		$output=array( "code" => "200", "msg" => $array_out);
		print_r(json_encode($output, true));
	 }

	function addFakeProfile()
	 {
	     require_once("config.php");
	    $input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		//print_r($event_json);
		
		if(isset($event_json['fb_id']) && isset($event_json['first_name']) && isset($event_json['last_name']))
		{
			$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
			$first_name=htmlspecialchars(strip_tags($event_json['first_name'] , ENT_QUOTES));
			$last_name=htmlspecialchars(strip_tags($event_json['last_name'] , ENT_QUOTES));
			$birthday=$event_json['birthday'];
			$gender=htmlspecialchars(strip_tags($event_json['gender'] , ENT_QUOTES));
			$image1=htmlspecialchars_decode(stripslashes($event_json['image1']));
			$image2=htmlspecialchars_decode(stripslashes($event_json['image2']));
			$image3=htmlspecialchars_decode(stripslashes($event_json['image3']));
			$profile_type=htmlspecialchars_decode(stripslashes($event_json['profile_type']));
		    
		    
		     if($birthday=="")
		     {
		         $birthday = "01/01/2000";
		     }
		     else
		     {
		         $birthday = $birthday;
		     }
		     
		     if($profile_type=="")
		     {
		         $profile_type = "user";
		     }
		     else
		     {
		         $profile_type = "fake";
		     }
		     
            //echo $birthDate;
           
			$log_in="select * from users where fb_id='".$fb_id."' ";
			$log_in_rs=mysqli_query($conn,$log_in);
			
			if(mysqli_num_rows($log_in_rs))
			{   
			    $rd=mysqli_fetch_object($log_in_rs);  
			    $age="".calculateAge($rd->birthday)."";
			    
				$array_out = array();
				 $array_out[] = 
					//array("code" => "200");
					array(
						"fb_id" => $fb_id,
						"action" => "login",
						"image1" => $image1,
						"image2" => $image2,
						"image3" => $image3,
						"first_name" => $first_name,
						"last_name" => $last_name,
						"age" => $age,
						"birthday" => $rd->birthday,
						"gender" => $gender
					);
				
				$output=array( "code" => "200", "msg" => $array_out);
				print_r(json_encode($output, true));
			}	
			else
			{
			    $qrry_1="insert into users(fb_id,first_name,last_name,birthday,image1,image2,image3,profile_type,gender)values(";
    			$qrry_1.="'".$fb_id."',";
    			$qrry_1.="'".$first_name."',";
    			$qrry_1.="'".$last_name."',";
    			$qrry_1.="'".$birthday."',";
    			$qrry_1.="'".$image1."',";
    			$qrry_1.="'".$image2."',";
    			$qrry_1.="'".$image3."',";
    			$qrry_1.="'".$profile_type."',";
    			$qrry_1.="'".$gender."'";
    			$qrry_1.=")";
    			if(mysqli_query($conn,$qrry_1))
    			{
				 
				     $age="".calculateAge($birthday)."";
    				 $array_out = array();
    				 $array_out[] = 
    					//array("code" => "200");
    					array(
    						"fb_id" => $fb_id,
    						"action" => "signup",
    						"image1" => $image1,
    						"first_name" => $first_name,
    						"last_name" => $last_name,
    						"age" => $age,
					    	"birthday" => $birthday,
    						"gender" => $gender
    					);
    				
    				$output=array( "code" => "200", "msg" => $array_out);
    				print_r(json_encode($output, true));
    			}
    			else
    			{
    			    //echo mysqli_error();
    			    $array_out = array();
    					
            		 $array_out[] = 
            			array(
            			"response" =>"problem in signup");
            		
            		$output=array( "code" => "201", "msg" => $array_out);
            		print_r(json_encode($output, true));
    			}
			}
			
			
			
		}
		else
		{
			$array_out = array();
					
			 $array_out[] = 
				array(
				"response" =>"Json Parem are missing");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	 }

	function sendPushNotification()
	{
		require_once("config.php");
		$input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		
		
		$tokon=$event_json['tokon'];
		$title=htmlspecialchars(strip_tags($event_json['title'] , ENT_QUOTES));
		$message=htmlspecialchars(strip_tags($event_json['message'] , ENT_QUOTES));
		$icon=htmlspecialchars(strip_tags($event_json['icon'] , ENT_QUOTES));
		$senderid=htmlspecialchars(strip_tags($event_json['senderid'] , ENT_QUOTES));
		$receiverid=htmlspecialchars(strip_tags($event_json['receiverid'] , ENT_QUOTES));
		$action_type=htmlspecialchars(strip_tags($event_json['action_type'] , ENT_QUOTES));
		
		
		
		$notification['to'] = $tokon;
		$notification['notification']['title'] = $title;
		$notification['notification']['body'] = $message;
		// $notification['notification']['text'] = $sender_details['User']['username'].' has sent you a friend request';
		$notification['notification']['badge'] = "1";
		$notification['notification']['sound'] = "default";
		$notification['notification']['icon'] = "";
		 $notification['notification']['image'] = "";
		$notification['notification']['type'] = "";
		
		$notification['data']['title'] = $title;
		$notification['data']['body'] = $message;
		$notification['data']['icon'] = $icon;
		$notification['data']['senderid'] = $senderid;
		$notification['data']['receiverid'] = $receiverid;
		$notification['data']['action_type'] = $action_type;	
		
		sendPushNotificationToMobileDevice(json_encode($notification));  
	}
	
	function boostProfile()
	{
		require_once("config.php");
		$input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		
		$mins=$event_json['mins'];
		$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
		$promoted=htmlspecialchars(strip_tags($event_json['promoted'] , ENT_QUOTES));
		
		$qrry_1="update users SET promoted_mins ='".$mins."' , promoted='".$promoted."' , promoted_date='".date('Y-m-d H:i:s', time())."' WHERE fb_id ='".$fb_id."' ";	
		
		if(mysqli_query($conn,$qrry_1))
		{
			$array_out = array();
				
			 $array_out[] = 
				array(
				"response" =>"success");
			
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
		else
		{
			$array_out = array();
				
			 $array_out[] = 
				array(
				"response" =>"problem in updating");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
		
	}

	function subscription_update()
	{
		require_once("config.php");
		$input = @file_get_contents("php://input");
	    $event_json = json_decode($input,true);
		
		
		$fb_id=htmlspecialchars(strip_tags($event_json['fb_id'] , ENT_QUOTES));
		
		$qrry_1="update users SET subscription_datetime='".date('Y-m-d H:i:s', time())."' WHERE fb_id ='".$fb_id."' ";
		
		if(mysqli_query($conn,$qrry_1))
		{
			$array_out = array();
				
			 $array_out[] = 
				array(
				"response" =>"success");
			
			$output=array( "code" => "200", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
		else
		{
			$array_out = array();
				
			 $array_out[] = 
				array(
				"response" =>"problem in updating");
			
			$output=array( "code" => "201", "msg" => $array_out);
			print_r(json_encode($output, true));
		}
	}

	function sendEmail($password,$email) {
		require_once "../vendor/autoload.php";

		//PHPMailer Object
		$mail = new \PHPMailer\PHPMailer\PHPMailer();

		$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;
		$mail->Host       = "smtp.sendgrid.net";
		$mail->Username   = "piyush-imark";
		$mail->Password   = "cognoscenti123@";

		//From email address and name
		$mail->From = "no-reply@imarkinfotech.com";
		$mail->FromName = "IMARK INFOTECH Pvt. Ltd.";

		//To address and name
		$mail->addAddress($email);

		//Send HTML or Plain Text email
		$mail->isHTML(true);

		$mail->Subject = "Forgot Password";
		$mail->Body = "<i>Password: $password</i>";

		return $mail->send();

//		if(!$mail->send())
//		{
//			echo "Mailer Error: " . $mail->ErrorInfo;
//		}
//		else
//		{
//			echo "Message has been sent successfully";
//		}
	}

	function random_strings($length_of_string)
	{
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($str_result),0, $length_of_string);
	}

?>
