<?php
// Routes
require __DIR__ . '/dependencies.php';
//require __DIR__ . '/App/Mail/Mailer.php';

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
    
    $sql = "SELECT * FROM doctor WHERE id = $id";
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
 * Add a New Doctor
 */
$app->post('/doctor/add',function($request,$response,$arga){
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

	$this->logger->info("Specialist '/' Add");
    
    $sql = "INSERT INTO doctor (name,address,hv_fee,fee,email,mobile,city,state,pin,clinic_name) VALUES (:name,:address,:hv_fee,:fee,:email,:mob,:city,:state,:pin,:clinic_name)";
    try{
    	$db = new db();
    	$db = $db->connect();

    	$stmt = $db->prepare($sql);
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

    	$stmt->execute();
        $temp = $db->lastInsertId();
        echo $temp;
    	$this->logger->addInfo("New Doctor Added");
    } catch(PDOException $e){
    	echo '{"error":{"text":'.$e->getMessage().'}}';
    	$this->logger->addInfo("New Doctor addition error ".$e->getMessage());
    }
});

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

$app->get('/doctorBooking/status/{id}',function($request,$response,$arga){
    $id = $request->getAttribute('id');

    $sql = "SELECT doctor.name,doctor.address,doctor.hv_fee,doctor.fee,doctor.recommendation,doctor.certified,doctor_booking.clinic_timing,doctor_booking.visit_timing FROM doctor INNER JOIN doctor_booking ON doctor.id=doctor_booking.doctor_id WHERE doctor.id = $id";

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

$app->post('/upload/ClinicPic',function($request,$response,$arga){
    error_reporting(E_ALL);
ini_set('display_errors', 1);

    
    $name     = $_FILES['file']['name'];
    $tmpName  = $_FILES['file']['tmp_name'];
    $error    = $_FILES['file']['error'];
    $size     = $_FILES['file']['size'];
    $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  
    switch ($error) {
        case UPLOAD_ERR_OK:
            $valid = true;
            //validate file extensions
            if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
                $valid = false;
                $response = 'Invalid file extension.';
            }
            //validate file size
            if ( $size/1024/1024 > 2 ) {
                $valid = false;
                $response = 'File size is exceeding maximum allowed size.';
            }
            //upload file
            if ($valid) {
                $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
                move_uploaded_file($tmpName,$targetPath); 
                header( 'Location: index.php' ) ;
                exit;
            }
            break;
        case UPLOAD_ERR_INI_SIZE:
            $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $response = 'The uploaded file was only partially uploaded.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $response = 'No file was uploaded.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
            break;
        default:
            $response = 'Unknown error';
        break;
    }

    echo $response;
});
