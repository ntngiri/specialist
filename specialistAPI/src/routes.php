<?php
// Routes
require __DIR__ . '/dependencies.php';

// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
//});

// $app->get('/api/customer', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");
//     $this->logger->addInfo("Something interesting happened");

//     echo 'CUSTOMERS';
//});

/**
 * API to get all list of doctors
 */
$app->get('/doctor/list',function($request,$response,$arga){
	$this->logger->info("/doctor/list");
    

    $sql = "SELECT * FROM doctor_booking";
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
    

    $sql = "SELECT * FROM doctor_booking WHERE id = $id";
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

	$this->logger->info("Specialist '/' Add");
    
    $sql = "INSERT INTO doctor_booking (name,address,hv_fee,fee,email,mobile,city,state,pin) VALUES (:name,:address,:hv_fee,:fee,:email,:mob,:city,:state,:pin)";
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

    	$stmt->execute();
    	$this->logger->addInfo("New Doctor Added");
    } catch(PDOException $e){
    	echo '{"error":{"text":'.$e->getMessage().'}}';
    	$this->logger->addInfo("New Doctor addition error ".$e->getMessage());
    }
});

$app->get('doctor/email/{email}',function($request,$response,$arga){
    $email = $request->getAttribute('email');
    $this->logger->info("Specialist '/' check doctor existence");
    $sql = "SELECT * FROM doctor_booking WHERE email = $email";
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

