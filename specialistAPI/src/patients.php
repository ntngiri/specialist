<?php
// Routes
require __DIR__ . '/dependencies.php';

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//user routes
/**
 * Add a New Patient
 */
$app->post('/patient/add',function($request,$response,$arga){
    $id = generateRandomString();
	$first_name = $request->getParam('firstname');
	$last_name = $request->getParam('lastname');
	$address = $request->getParam('address');
	$email = $request->getParam('email');
	$mobile = $request->getParam('mobile');
    $username = $request->getParam('username');

    if(!isset($error)){
	$this->logger->info("Specialist '/' Add");
    
    $sql = "INSERT INTO patients (id,first_name,last_name,email,mobile,username) VALUES (:id,:firstname,:lastname,:email,:mob,:username)";
    try{
    	$db = new db();
    	$db = $db->connect();

    	$stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$id);
    	$stmt->bindParam(':firstname',$firstname);
    	$stmt->bindParam(':lastname',$lastname);
    	$stmt->bindParam(':email',$email);
    	$stmt->bindParam(':mob',$mobile);
        $stmt->bindParam(':username',$username);

    	$stmt->execute();
        
        echo $id;
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