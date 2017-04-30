<?php
// Routes
require __DIR__ . '/dependencies.php';

/**
 * [generateRandomString generate random ID strings]
 * @param  integer $length [length of string to be generated]
 * @return [string]          [randomly generated string]
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//Get API'S

/**
 * Get doctor full list
 */
$app->get('/doctor/list',function($request,$response,$arga){
	$this->logger->info("/doctor/list");
    $sql = "SELECT * FROM doctor";
    try{
    	$db = new db();
    	$db = $db->connect();

    	$stmt = $db->query($sql);
    	$doctors = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$db = null;
    	echo json_encode($doctors);
    	$this->logger->addInfo("Doctor List API Success");
    } catch(PDOException $e){
    	echo '{"error":{"text":'.$e->getMessage().'}}';
    	$this->logger->addInfo('Doctor List API error'.$e->getMessage());
    }
});

/**
 * API to get doctor with particular id
 */
$app->get('/doctor/{id}',function($request,$response,$arga){
	$id = $request->getAttribute('id');
    
    $sql = "SELECT * FROM doctor WHERE id = '$id'";
    try{
    	$db = new db();
    	$db = $db->connect();

    	$stmt = $db->query($sql);
    	$doctors = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$db = null;
    	echo json_encode($doctors);
    	$this->logger->addInfo("Asked for doctor".$id);
    } catch(PDOException $e){
    	echo '{"error":{"text":'.$e->getMessage().'}}';
    	$this->logger->addInfo('Doctor'.$id.'Failure'.$e->getMessage());
    }
});

/**
 * API to check if username exists
 */
$app->get('/doctor/docUsername/{username}',function($request,$response,$arga){
    $username = $request->getAttribute('username');
    $sql = "SELECT * FROM doctor WHERE username = '$username'";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        //$doctors = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //echo json_encode($doctors);
        $docCount = $stmt->rowCount();
        if($docCount > 0){
            echo 1;
        }else{
            echo 0;
        }
        exit();
    } catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});

/**
 * API to check if email olready exists
 */
$app->get('/doctor/email/{email}',function($request,$response,$arga){
    $email = $request->getAttribute('email');
    $this->logger->info("Specialist '/' check doctor existence");
    $sql = "SELECT * FROM doctor WHERE email = $email";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $doctors = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($doctors);
        $this->logger->addInfo("Asked for doctor".$id);
    } catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
        $this->logger->addInfo('Doctor'.$id.'Failure'.$e->getMessage());
    }
});

/**
 * Doctor booking status API
 */
$app->get('/doctorBooking/status/{id}',function($request,$response,$arga){
    $id = $request->getAttribute('id');

    $sql = "SELECT doctor.name,doctor.address,doctor.hv_fee,doctor.fee,doctor.recommendation,doctor.certified,doctor_booking.clinicVisit,doctor_booking.homeVisit FROM doctor INNER JOIN doctor_booking ON 'doctor.id'='doctor_booking.doctor_id' WHERE doctor.id = '$id'";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $doctors = $stmt->fetchAll(PDO::FETCH_OBJ);
       // $stmt2 = $db->query($BookingSql);
       // $doctor_booking = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($doctors);
        //echo $doctor_booking;
        //print_r($doctor_booking);
        //echo json_encode($doctor_booking);
        $this->logger->addInfo("Asked for doctor".$id);
    } catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
        $this->logger->addInfo('Doctor'.$id.'Failure'.$e->getMessage());
    }

});


/**
 * Doctor Login
 */
$app->post('/doctor/login',function($request,$response,$arga){
    $email = $request->getParam('email');
    $password = $request->getParam('password');
    
    if(!isset($error)){
        $this->logger->info("Patient '/' login");
        $sql = "SELECT id, name, password FROM doctor WHERE email = '$email'";
        try{
            $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $doctor = $stmt->fetchAll(PDO::FETCH_OBJ);
        $doc = $doctor[0];
        // echo password_hash($password, PASSWORD_DEFAULT);
        if (password_verify($password, $doc->password)){
            $data = array('id' => $doc->id, 'name' => $doc->name);
        $newResponse = $response->withJson($data);

         return $newResponse;
                 // $newResponse = $response->withJson($data);
//             echo '{"id":'.$doctor["id"].',"username":'.$dotor["username"].'}';
        }else{
            echo '{"error":"password do not match"}';
        }
        $db = null;
        // echo json_encode($doctors);

        } catch(PDOException $e){
        echo '{"error":{"text":"User does not exists. Please signup"}}';
        $this->logger->addInfo('Doctor List API error'.$e->getMessage());
    }
    }
});

$app->post('/update/doctorProfile',function($request,$response,$arga){
    $id = $request->getParam('id');
    $name = $request->getParam('name');
    //$address = $request->getParam('address');
    // $hv_fee = $request->getParam('hv_fee');
    // $fee = $request->getParam('fee');
    // $mob = $request->getParam('mobile');
    $experience = $request->getParam('experience');
    $speciality = $request->getParam('speciality');
    $about = $request->getParam('about');
    $about_clinic = $request->getParam('about_clinic');
    $qualification = $request->getParam('qualification');

if(!isset($error)){
    $sql = "UPDATE doctor SET name = '$name',experience ='$experience', speciality = '$speciality', about = '$about', about_clinic = '$about_clinic', qualification = '$qualification'  WHERE id = '$id'";
        try{
            $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo "success";
        } catch(PDOException $e){
        echo '{"error":{"text":"Cannot Update , error '.$e->getMessage().'"}}';
        $this->logger->addInfo('Doctor List API error'.$e->getMessage());
    }


    }
});



/**
 * Add a New Doctor
 */
$app->post('/doctor/add',function($request,$response,$arga){
    $options = ['cost' => 12];

    $id = generateRandomString();
	$name = $request->getParam('name');
	$address = $request->getParam('address');
	$hv_fee = $request->getParam('hv_fee');
	$fee = $request->getParam('fee');
	$email = $request->getParam('email');
	$mob = $request->getParam('mobile');
	$city = $request->getParam('city');
	$state = $request->getParam('state');
	$pin = $request->getParam('pin');
    $clinic_name = $request->getParam('clinic_name');
    $username = $request->getParam('username');
    $pass = $request->getParam('password');
    $password = password_hash($pass, PASSWORD_BCRYPT, $options);
    //Verifcation 
    // if (empty($name) || empty($username) || empty($email) || empty($password) || empty($password1)){
    //     $error = "Complete all fields";
    // }

    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    //     $error = "Enter a  valid email";
    // }

    //if (strlen($password) <= 6){
    //    $error = "Choose a password longer then 6 character";
   // }

    if(!isset($error)){
	$this->logger->info("Specialist '/' Add");
    
    $sql = "INSERT INTO doctor (id,name,address,hv_fee,fee,email,mobile,city,state,pin,clinic_name,username,password) VALUES (:id,:name,:address,:hv_fee,:fee,:email,:mob,:city,:state,:pin,:clinic_name,:username,:password)";
    try{
    	$db = new db();
    	$db = $db->connect();

    	$stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$id);
    	$stmt->bindParam(':name',$name);
    	$stmt->bindParam(':address',$address);
    	$stmt->bindParam(':hv_fee',$hv_fee);
    	$stmt->bindParam(':fee',$fee);
    	$stmt->bindParam(':email',$email);
    	$stmt->bindParam(':mob',$mob);
    	$stmt->bindParam(':city',$city);
    	$stmt->bindParam(':state',$state);
    	$stmt->bindParam(':pin',$pin);
        $stmt->bindParam(':clinic_name',$clinic_name);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$password);

    	$stmt->execute();
        
        echo $id;
    	$this->logger->addInfo("New Doctor Added");
    } catch(PDOException $e){
    	echo '{"error":{"text":'.$e->getMessage().'}}';
    	$this->logger->addInfo("New Doctor addition error ".$e->getMessage());
    }
    }else{
        echo "error occured: ".$error;
        exit();
    }
});


$app->post('/upload/profilePic',function($request,$response,$arga){

$data = $request->getParam('baseString');
$id = $request->getParam('docId');
//$this->logger->info("data from hit". $data);

 $ext = null;
    
    if(strpos($data, 'data:image/jpeg;base64,') === 0) {
        $data = str_replace('data:image/jpeg;base64,', '', $data);
        $ext = '.jpg';
    } elseif (strpos($data, 'data:image/jpg;base64,') === 0) {
        $data = str_replace('data:image/jpg;base64,', '', $data);
        $ext = '.jpg';
    } elseif (strpos($data, 'data:image/png;base64,') === 0) {
        $data = str_replace('data:image/png;base64,', '', $data);
        $ext = '.png';
    } elseif (strpos($data, 'data:image/gif;base64,') === 0) {
        $data = str_replace('data:image/gif;base64,', '', $data);
        $ext = '.gif';
    }
    //$this->logger->info("data after ext". $data . "and ext". $ext);
    if($ext != null) {
        $entry = base64_decode($data);
        $image = imagecreatefromstring($entry);
        $this->logger->info("Image". $image);
        $imagename = "profile_".generateRandomString().$ext;
        $directory = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.$imagename;
        $this->logger->info("directory".$directory);
        header ( 'Content-type:image/jpeg' ); 
        $sql = "UPDATE doctor SET profile_pic = '$imagename' WHERE id = '$id'";
        try{
            $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':imagename',$imagename);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $db = null;
        imagejpeg($image, $directory);
        imagedestroy ( $image ); 
        readfile ( $directory );
        echo '{"status":"successfull"}';
        } catch(PDOException $e){
        echo '{"error":{"text":"User does not exists. Please signup"}}';
        $this->logger->addInfo('Doctor List API error'.$e->getMessage());
    }
        exit (); 
    }else{
    
    return null;
}
});


/**
 * Patient Login
 */

$app->post('/patient/login',function($request,$response,$arga){
    $email = $request->getParam('email');
    $password = $request->getParam('password');

    if(!isset($error)){
        $this->logger->info("Patient '/' login");
        $sql = "SELECT id, username, email FROM patients WHERE email = $email and password = $password";
        echo $sql;
        try{
            $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $doctors = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($doctors);

        } catch(PDOException $e){
        echo '{"error":{"text":"User does not exists. Please signup"}}';
        $this->logger->addInfo('Doctor List API error'.$e->getMessage());
    }
    }
});

/**
 * Add a New Patient
 */
$app->post('/patient/add',function($request,$response,$arga){
    $options = ['cost' => 12];
    $id = generateRandomString();
    $first_name = $request->getParam('firstname');
    $last_name = $request->getParam('lastname');
    $email = $request->getParam('email');
    $mobile = $request->getParam('mobile');
    $username = $request->getParam('username');
    $pass = $request->getParam('pass');

    $password = password_hash($password, PASSWORD_BCRYPT,$options);
    if(!isset($error)){
    $this->logger->info("Patient '/' Add");
    
    $sql = "INSERT INTO patients (id,first_name,last_name,email,mobile,username,password) VALUES (:id,:firstname,:lastname,:email,:mob,:username,:pass)";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':firstname',$first_name);
        $stmt->bindParam(':lastname',$last_name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':mob',$mobile);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':pass',$password);

        $stmt->execute();
        
        //echo json_encode({id:$id,name:$first_name});
        $this->logger->addInfo("New Patient Added");
    } catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
        $this->logger->addInfo("New Patient addition error ".$e->getMessage());
    }
    }else{
        echo "error occured: ".$error;
        exit();
    }
});
