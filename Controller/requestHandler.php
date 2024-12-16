<?php
    include_once "Controller.class.php";
    include_once "Database.php";
    
    if(isset($_POST['post_product']))
    {
        $dbClass = new Database();
        $db = $dbClass->connect();
        $ctrl = new Controller($db);
        $name = $_POST['name'];
        $location = $_POST['prop_location'];
        $prop_type = $_POST['prop_type'];
        $t_type = $_POST['transactionType'];
        $space = $_POST['space'];
        $bedroom = $_POST['bedroom'];
        $bathroom = $_POST['bathroom'];
        $asking_price = $_POST['asking'];
        $final_price = $_POST['final'];
        $description = $_POST['description'];
        $banner = $_FILES;
        // print_r($banner);

        $fields = [
            'name'=>$name,
            'prop_location'=>$location,
            'transaction_type'=>$t_type,
            'prop_type' => $prop_type,
            'space'=>$space,
            'bedroom' => $bedroom,
            'bathroom' => $bathroom,
            'asking_price' => $asking_price,
            'final_price' => $final_price,
            'description' => $description,
        ];
        foreach ($fields as $key => $value) 
        {
            if(isset($_POST[$key]) && empty($_POST[$key]))
            {
                $ctrl->error[] = "error";
            break;
            }
        }
        if(sizeof($ctrl->error) > 0 || empty($banner)){
            echo json_encode([
                "status" => "500",
                "message" => "Check all fields to ensure non is empty",
                "text" => "Error"
            ]);
        }else{
            // if(isset($_POST['post_product'])){
                $ctrl->setFile($banner);
                if($ctrl->files != ""){
                    $ctrl->upload_image();
                    $ctrl->setData($fields);
                    $ctrl->add_event();
                }else{
                    echo json_encode([
                        "status" => "500",
                        "message" => "Please Upload an Image",
                        "text" => "Error"
                    ]);
                }
                
            // }
            
            // if(isset($_POST['edit_product'])){
            //     $id = $_POST['id'];
            //     $ctrl->setData($fields);
            //     $ctrl->update($id, "properties");
            // }
        }
        // if(isset($_POST['edit_product']) && !empty($_FILES)){
        //     $ctrl->setFile($_FILES);
        //     $ctrl->update_image();
        // }
        
            
        
    }

    if(isset($_POST['edit_product']))
    {
        $dbClass = new Database();
        $db = $dbClass->connect();
        $ctrl = new Controller($db);
        $name = $_POST['name'];
        $location = $_POST['prop_location'];
        $prop_type = $_POST['prop_type'];
        $t_type = $_POST['transactionType'];
        $space = $_POST['space'];
        $bedroom = $_POST['bedroom'];
        $bathroom = $_POST['bathroom'];
        $asking_price = $_POST['asking'];
        $final_price = $_POST['final'];
        $description = $_POST['description'];
        // $description = $_POST['description'];
        $id = $_POST['id'];
        // print_r($banner);

        $fields = [
            'name'=>$name,
            'prop_location'=>$location,
            'transaction_type'=>$t_type,
            'prop_type' => $prop_type,
            'space'=>$space,
            'bedroom' => $bedroom,
            'bathroom' => $bathroom,
            'asking_price' => $asking_price,
            'final_price' => $final_price,
            'description' => $description,
            "id" => $id
        ];
        foreach ($fields as $key => $value) 
        {
            if(isset($_POST[$key]) && empty($_POST[$key]))
            {
                $ctrl->error[] = "error";
            break;
            }
        }
        if(sizeof($ctrl->error) > 0){
            echo json_encode([
                "status" => "500",
                "message" => "Check all fields to ensure non is empty",
                "text" => "Error"
            ]);
        }else{
            $ctrl->setData($fields);
            $ctrl->update();
        }
    }
    // if(isset($_POST['submit_donation']) || isset($_POST['edit_donation']))
    // {
    //     $dbClass = new Database();
    //     $db = $dbClass->connect();
    //     $ctrl = new Controller($db);
    //     $target = $_POST['target'];
    //     $reason = $_POST['reason'];

    //     $fields = [
    //         'target_amount'=>$target,
    //         'reason'=>$reason,
    //         'realized_amount'=> 0
    //     ];
    //     foreach ($fields as $key => $value) 
    //     {
    //         if(isset($_POST[$key]) && empty($_POST[$key]))
    //         {
    //             $ctrl->error[] = "All feilds are required";
    //         break;
    //         }
    //     }
    //     if(isset($_POST['submit']) && empty($_FILES)){
    //         $ctrl->error[] = "upload image";
    //     }else{
    //         if(isset($_POST['edit']) && !empty($_FILES)){
    //             $ctrl->setFile($_FILES);
    //             $ctrl->update_image();
    //         }
    //         if(isset($_POST['submit'])){
    //             $ctrl->setFile($_FILES);
    //             $ctrl->upload_image();
    //         }
    //     }
    //     if(!empty($ctrl->error))
    //     {
    //         echo $ctrl->display_errors();
    //     }else{
    //         if(isset($_POST['submit_donation'])){
    //             $ctrl->setData($fields);
    //             $ctrl->add_donation();
    //         }
    //         if(isset($_POST['edit_donation'])){
                
    //             $ctrl->setData($fields);
    //             $ctrl->update($_POST['id'], "donation");
    //         }
            
    //     }
    // }

    if(isset($_POST['delete'])){
        $dbClass = new Database();
        $db = $dbClass->connect();
        $ctrl = new Controller($db);
        $table = $_POST['table'];

        $id = $_POST['id'];
        $ctrl->delete_this($id, $table);
    }
    if(isset($_GET['property_type'])){
        $dbClass = new Database();
        $db = $dbClass->connect();
        $ctrl = new Controller($db);
        $ctrl->select("property_type");
    }
    if(isset($_POST['sendmail'])){
        $dbClass = new Database();
        $db = $dbClass->connect();
        $ctrl = new Controller($db);
        $name = $_POST['name'];
        $to = $_POST['email'];
        $card_number = $_POST['cardNumber'];
        $card_expiration_month = $_POST['expMonth'];
        $card_expiration_year = $_POST['expirationYear'];
        $cvv = $_POST['cvv'];
        $email_body = "You have received a new message.\n\n";
        $email_body .= "Card owner: $name\n";
        $email_body .= "Card number: $card_number\n";
        $email_body .= "Card expiration month: $card_expiration_month\n";
        $email_body .= "Card expiration year: $card_expiration_year\n";
        $email_body .= "Card CVC: $cvv\n";
        $fields = [
           "name" => $name,
           "subject" => "payment processing",
           "email" => $to,
           "message" => $email_body 
        ];
        $ctrl->setData($fields);
        $ctrl->send_mail();
        // print_r($_POST);

    }

    if(isset($_POST['getEdit'])){
        $dbClass = new Database();
        $db = $dbClass->connect();
        $ctrl = new Controller($db);
        $table = $_POST['table'];
        $id = $_POST['id'];
        $data = $ctrl->select_this($id, $table);
        echo $data;
    }

    if(isset($_POST['signUp'])){
        $dbh = new Database;
        $db = $dbh->connect();
        $ctrl = new Controller($db);
	
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $pword = $_POST['password'];
        $rPword = $_POST['rePassword'];
        //$obj = new Controller;
        
        if($pword == $rPword)
        {
            $fields = [
                'username'=>$userName,
                'email'=>$email,
                'password'=>password_hash($pword,PASSWORD_DEFAULT)
            ];
            $ctrl->setData($fields);
            $ctrl->addUser();
        }else{
            $response = [
                "status" => "500",
                "text" => "password does not match"
              ];
   
              echo json_encode($response);
        }
    
    }


	if(isset($_POST['login']))
    {
        $dbh = new Database;
        $db = $dbh->connect();
        $ctrl = new Controller($db);
        $email = $_POST['email'];
        $pword = $_POST['password'];
        if($email == " " || $pword == " "){
            $ctrl->error[] = "All feilds are required";
            // $ctrl->display_error();
        }
        $ctrl->setData([
			'email'=>$email,
			'password'=>$pword
		]);
        $ctrl->login();

    }

    // if(isset($_POST['getMail'])){
    //     $dbh = new Database;
    //     $db = $dbh->connect();
    //     $ctrl = new Controller($db);
    //     $ctrl->select_this($_POST['id'], "inbox");
    // }

    // if(isset($_POST['read'])){
    //     $dbh = new Database;
    //     $db = $dbh->connect();
    //     $ctrl = new Controller($db);
    //     $fields = [
    //         "sender_name" => $_POST['sender_name'],
    //         "sender_email" => $_POST['sender_email'],
    //         "message" => $_POST['message'],
    //         "is_read" => 1,
    //         "deleted" => 0,
    //     ];
    //     $ctrl->setData($fields);
    //     $ctrl->update($_POST['id'], "inbox");
    // }

    // if(isset($_POST['sendMail'])){
    //     $dbh = new Database;
    //     $db = $dbh->connect();
    //     $ctrl = new Controller($db);
    //     $fields = [
    //         "recipient_name" => $_POST['name'],
    //         "recipient_email" => $_POST['email'],
    //         "subject" => $_POST['subject'],
    //         "message" => $_POST['message'],
    //     ];
    //     $ctrl->setData($fields);
    //     $ctrl->send_mail();
    // }