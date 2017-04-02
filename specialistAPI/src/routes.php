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

$app->get('doctor/email/{email}',function($request,$response,$arga){
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

