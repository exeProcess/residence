<?php
// Load Composer's autoloader (if using Composer)
// require '../vendor/autoload.php';
include_once "config.php";
include_once "Session.php";
include_once "Database.php";

// Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
   


    class Controller
    {
        // private $productTable = PROPERTIES_TABLE;
        // private $donationTable = DONATION_TABLE;
        // private $inboxTable = INBOX_TABLE;
        // private $outboxTable = OUTBOX_TABLE;
        private $connection;
        public $data;
        public $files;
        public $fileNames = "";
        public $error = [];
        public $success = [];

        public function __construct($db)
        {
            $this->connection = $db;
        }

        public function setData($data)
        {
            $this->data = $data;
        }
        public function setFile($file)
        {
            $this->files = $file;
        }
        public function setFileName($name){
            $this->fileNames = $name;
        }
        

        // public function add_category()
        // {
        //     $query_cat = "SELECT 
        //                 * 
        //             FROM "
        //                 .$this->categoryTable." 
        //             WHERE 
        //                 category = :category 
        //             AND 
        //                 parent = 0";
        //     $prep_cat_query = $this->connection->prepare($query_cat);
        //     $prep_cat_query->bindValue(':category',$this->data['category']);
        //     $prep_cat_query->execute();
        //     $parent = $prep_cat_query->fetch();
        //     if($prep_cat_query->rowCount() == 0)
        //     {
        //         $sql = "INSERT INTO "
        //                 .$this->categoryTable."
        //                 (category) 
        //             VALUE
        //                 (:category)";
        //         $prep_cat_query = $this->connection->prepare($sql);
        //         $prep_cat_query->bindValue(':category',$this->data['category']);
        //         $exec = $prep_cat_query->execute();
        //         $query_cat = "SELECT
        //                     * 
        //                 FROM "
        //                     .$this->categoryTable."
        //                 WHERE 
        //                     category = :category 
        //                 AND 
        //                     parent = 0";
        //         $prep_cat_query = $this->connection->prepare($query_cat);
        //         $prep_cat_query->bindValue(':category',$this->data['category']);
        //         $prep_cat_query->execute();
        //         $parent = $prep_cat_query->fetch();
        //     }
        //     $this->data['category'] = $parent['id'];
        //     //////////Insert portfolio
        //     $query_child = "SELECT 
        //                     * 
        //                 FROM "
        //                     .$this->categoryTable."
        //                 WHERE 
        //                     category = ? 
        //                 AND 
        //                     parent = ? ";
        //     $prep_child_query = $this->connection->prepare($query_child);
        //     $prep_child_query->execute([$this->data['portfolio'],$parent['id']]);
        //     $child = $prep_child_query->fetch();
        //     if($prep_child_query->rowCount() == 0)
        //     {
        //         $sql = "INSERT INTO "
        //                 .$this->categoryTable."
        //                 (category,parent) 
        //             VALUES 
        //                 (?,?)";
        //         $stmt = $this->connection->prepare($sql);
        //         $exec = $stmt->execute([$this->data['portfolio'],$parent['id']]);
        //         $query_cat = "SELECT 
        //                     * 
        //                 FROM "
        //                     .$this->categoryTable." 
        //                 WHERE 
        //                     category = ? 
        //                 AND 
        //                     parent = ?";
        //         $prep_child_query = $this->connection->prepare($query_cat);
        //         $prep_child_query->execute([$this->data['portfolio'],$parent['id']]);
        //         $child = $prep_child_query->fetch();
        //     }
        //     $this->data['portfolio'] = $child['id'];
        // }


        public function upload_image()
        {
            $name = $this->files['photo']['name'];
            $size = $this->files['photo']['size'];
            $tmp_name = $this->files['photo']['tmp_name'];
            $type = $this->files['photo']['type'];
            $formats = ['jpg','jpeg','png'];
            $db_path = "";
            // for($i = 0;$i < count($name);$i++)
            // {
                $ext = explode('/',$type);
                $actExt = end($ext);
                if(!in_array($actExt,$formats))
                {
                    $this->error[] = "Image format not allowed";
                }
                if($size > 101010101)
                {
                    $this->error[] = "File too large";
                
                }
                if(empty($this->error))
                {
                    $file_name = sha1(microtime()).'.'.$actExt;
                    $dir = $_SERVER['DOCUMENT_ROOT'].'/resido/Admin/Uploads/'.$file_name;
                    $db_path = '/resido/admin/Uploads/'.$file_name;
                    move_uploaded_file($tmp_name,$dir);
                }
            //}
            $this->fileNames .= $db_path;
        }
        public function update_image($id,$index)
        {
           $name = $this->files['name'];
           $type = $this->files['type'];
           $size = $this->files['size'];
           $format = ['jpg','jpeg','png'];
           $tmp = $this->files['tmp_name'];
           $ext = explode('.',$name);
           $actExt = strtolower(end($ext));
           $file_name = sha1(microtime()).".".$actExt;
           $upload_name = '/E-shop/View/Admin/Uploads/'.$file_name;
           $dir = $_SERVER['DOCUMENT_ROOT']."/E-shop/View/Admin/Uploads/".$file_name;
           if($size > 101010101)
           {
               $this->error[] = "File too large";
           }
           if(!in_array($actExt,$format))
           {
               $this->error[] = "Image Format not allowed";
           }
           if(empty($this->error))
           {
               move_uploaded_file($tmp,$dir);
               $entry = $this->select_this($id);
               $image = explode(',',$entry['product_img']);
               $image[$index] = $upload_name;
               $sequel = "UPDATE "
                        .$this->productTable."
                    SET 
                        product_img = ? 
                    WHERE 
                        id = ?";
               $stmt = $this->connection->prepare($sequel);
               $stmt->execute([implode(',',$image),$id]);
               echo $upload_name;
            }
        }
        public function delete_image($id,$index)
        {
            $data = $this->select_this($id);
            $photo = explode(',',$data['photo']);
            unset($photo[$index]);
            $sequel = "UPDATE "
                    .$this->productTable." 
                SET 
                   product_img =:photo 
                WHERE 
                    id =:id";
            $stmt = $this->connection->prepare($sequel);
            $stmt->bindValue(':photo',implode(',',$photo));
            $stmt->bindValue(':id',$id);
            $exec = $stmt->execute();
            if($exec){
                echo "removed";
            }else{
                echo "something went wrong";
            }
        }
        public function validate()
        {
            $this->add_brand();
            $this->add_category();
        }
        public function add()
        {
            $this->validate();
            $this->data['photo'] = $this->fileNames;
                $query_keys = implode(',',array_keys($this->data));
                $query_values = implode(', :',array_keys($this->data));
                $query = "INSERT INTO 
                            products($query_keys) 
                        VALUES
                            (:".$query_values.")";
                $prep_stmt = $this->connection->prepare($query);
                foreach($this->data as $key => $value)
                {
                    $prep_stmt->bindValue(":".$key,$value);
                }
                $exec = $prep_stmt->execute();
                if($exec)
                {
                    header('Location: pages/data-tables.php');
                }
        }
        public function selectAllProperty()
        {
            $table = 'properties';
            $select_query = "SELECT 
                            * 
                        FROM 
                            $table";
            $stmt = $this->connection->query($select_query);
            $data = $stmt->fetchAll();
            return $data;
        }
        public function selectAllPropertyType()
        {
            $table = 'property_type';
            
            $select_query = "SELECT 
                            * 
                        FROM 
                            $table";
            $stmt = $this->connection->query($select_query);
            $data = $stmt->fetchAll();
            return $data;
        }

       
        public function select_this($id)
        {
            $query = "SELECT 
                    * 
                FROM 
                    properties
                WHERE 
                    id=:id";
            $prep_stmt = $this->connection->prepare($query);
            $prep_stmt->bindValue(':id',$id);
            $prep_stmt->execute();
            $result = $prep_stmt->fetch();
            $result['status'] = 200;
            return $result;
        } 
        public function select($limit){
            $sql = "SELECT * FROM properties
                    ORDER BY id DESC
                    LIMIT $limit";
            $stmt = $this->connection->query($sql);
            $data = $stmt->fetchAll();
            if(sizeof($data)){
                return $data;
            }
            
        } 
        // public function update()
        // {
        //     if(!empty($this->fileNames)){
        //         $this->data['image'] = $this->fileNames;
        //     }
        //     $st = "";
        //     foreach ($this->data  as $key => $value) 
        //     {
        //         $st .= "$key = :".$key.", ";
        //     }
        //     $table = $this->productTable;
        //     $sql = "UPDATE ".
        //                 $table ."
        //             SET". 
        //                 rtrim($st,', ')."
        //             WHERE 
        //             id=:id"; 
           
        //     $stmt = $this->connection->prepare($sql);
        //     foreach ($this->data as $key => $value) 
        //     {
        //         # code...
        //         $stmt->bindValue(":".$key,$value);
        //     }
        //     // $stmt->bindValue(":id",$id);
        //     $exec = $stmt->execute();
        //     if($exec)
        //     {
        //         $response = [
        //             "status" => 200,
        //             "text" => "Event Updated Successfully"
        //         ];
        //         echo json_encode($response);
        //     }else{
        //         $response = [
        //             "status" => 500,
        //             "text" => "Update Error. Retry!"
        //         ];
        //         echo json_encode($response);
        //     }
        // }
        public function update()
        {
            // Ensure the fileNames is not empty before assigning
            if (!empty($this->fileNames)) {
                $this->data['image'] = $this->fileNames; // Assuming $this->fileNames is an array or string
            }

            // Prepare the SQL update statement
            $st = "";
            foreach ($this->data as $key => $value) {
                // Skip the 'id' field in the set part of the query
                if ($key !== 'id') {
                    $st .= "$key = :$key, ";
                }
            }

            // Remove the trailing comma and space
            $st = rtrim($st, ', ');

            // Make sure the table name exists
            $table = isset($this->productTable) ? $this->productTable : 'properties';

            // Final SQL query with dynamic values
            $sql = "UPDATE $table SET $st WHERE id = :id";

            try {
                // Prepare the statement
                $stmt = $this->connection->prepare($sql);

                // Bind all the values dynamically except the 'id' field
                foreach ($this->data as $key => $value) {
                    if ($key !== 'id') {
                        $stmt->bindValue(":$key", $value);
                    }
                }

                // Bind the id separately for clarity
                if (isset($this->data['id'])) {
                    $stmt->bindValue(':id', $this->data['id']);
                } else {
                    throw new Exception('ID is required for updating a record.');
                }

                // Execute the statement
                $exec = $stmt->execute();

                // Check the result of the execution
                if ($exec) {
                    $response = [
                        "status" => 200,
                        "text" => "Event Updated Successfully"
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        "status" => 500,
                        "text" => "Update Error. Retry!"
                    ];
                    echo json_encode($response);
                }
            } catch (PDOException $e) {
                // Handle PDO exceptions (like connection issues)
                $response = [
                    "status" => 500,
                    "text" => "Database error: " . $e->getMessage()
                ];
                echo json_encode($response);
            } catch (Exception $e) {
                // Handle other exceptions (e.g. missing 'id')
                $response = [
                    "status" => 400,
                    "text" => "Error: " . $e->getMessage()
                ];
                echo json_encode($response);
            }
        }
        public function delete_this($id, $table)
        {
            $sequel = "UPDATE 
                    $table 
                SET 
                    deleted = 1 
                WHERE 
                    id=?";
            $stmt = $this->connection->prepare($sequel);
            $exec = $stmt->execute([$id]);
            if($exec)
            {
                $response = [
                    "status" => 200,
                    "text" => "Data deleted successfully"
                ];
                return json_encode($response);
               
            }
        }
        public function display_error()
        {
            $response = [
                "status" => 500,
                "text" => $this->error
            ];
            echo json_encode($response);
            return;
        }
        public function addUser()
        {
            if(!empty($this->error))
            {
                echo $this->display_errors();
            }
            $keys = implode(',',array_keys($this->data));
            $values = implode(', :',array_keys($this->data));
            $sequel = "SELECT 
                    * 
                FROM 
                    users 
                WHERE 
                    email = ?";
            $stmt = $this->connection->prepare($sequel);
            $stmt->execute([$this->data['email']]);
            if($stmt->rowCount() > 0)
            {
                $response = [
                    "status" => 500,
                    "text" => "User with this email already exist"
                ];
                echo json_encode($response);
            }else
            {
                $sequel = "INSERT INTO 
                        users ($keys) 
                    VALUES 
                        (:".$values.")";
                $stmt = $this->connection->prepare($sequel);
                foreach ($this->data as $key => $value)
                {
                    # code...
                    $stmt->bindValue(":".$key,$value);
                }
                $exec = $stmt->execute();
                if($exec)
                {
                    
                    $response = [
                        "status" => 200,
                        "text" => "success"
                    ];
                    echo json_encode($response);
                }
            }
        }
        public function login()
        {
            $sequel = "SELECT 
                        * 
                    FROM 
                        users 
                    WHERE 
                        email = ?";
            $stmt = $this->connection->prepare($sequel);
            $stmt->execute([$this->data['email']]);
            $result = $stmt->fetch();
            if($stmt->rowCount() == 0)
            {
                $response = [
                    "status" => 500,
                    "text" => "User not found",
                ];
                echo json_encode($response);
                return;
            }
            if(!empty($this->error))
            {
                echo $this->display_errors();    
            }else
            {
                if(!password_verify($this->data['password'],$result['password']))
                {
                    // $this->error[] = "Password does not match our record.Try again";
                    $response = [
                        "status" => 500,
                        "text" => "Password does not match our record.Try again",
                    ];
                    echo json_encode($response);
                    return;
                }
                Session::start();
                Session::set('user',$result);
                $response = [
                    "status" => 200,
                    "text" => "success",
                    "user" => Session::get('user')
                ];
                echo json_encode($response);
            }
        }
        static public function is_logged_in()
        {
            if(isset($_SESSION['user']) && !empty($_SESSION['user']))
            {
                return true;
            }
            return false;
        }
        public static function login_error_redirect($url)
        {
            Session::set('error_flash','You have no permission to this page');
            if(isset($_SESSION['user']))
            {
                unset($_SESSION['error_flash']);
            }
            header('Location: '.$url);
        }
        public static function logOut()
        {
            if(isset($_SESSION['user']))
            {
                Session::destroy();
            }
            header("Location: ../View/index.php");
        }
        public function validate_location(){
            $sequel = "SELECT 
                        * 
                    FROM 
                        properties 
                    WHERE 
                        prop_location = ?";
            $stmt = $this->connection->prepare($sequel);
            $stmt->execute([$this->data['prop_location']]);
            $result = $stmt->fetch();
            if($stmt->rowCount() > 0)
            {
                return true;
            }
        }
        public function add_event(){
            //$cart_data = $this->select_this($id);
            $key = [];
            $value = [];
            $this->data['image'] = $this->fileNames;
            $transaction_code = $this->generateUniqueCode(16);
            $this->data['transaction_code'] = $transaction_code;
            if($this->validate_location($this->data['prop_location'])){
                $response = [
                    "status" => 500,
                    "text" => "This property has already been listed, O boy!",
                ];
                echo json_encode($response); 
                return; 
            }else{
                $field = ['name','prop_location','prop_type','transaction_type','asking_price','final_price','space',
                'bedroom','bathroom','description','image','transaction_code'];
                for($i = 0;$i < count($field);$i++){
                    if(in_array($field[$i],array_keys($this->data))){
                        $index = $field[$i];
                        $key[] =  $field[$i];
                        $value[] = $this->data[$index];
                    }
                }
                $keys = implode(',',$key);
                $values = implode(', :',$key);
                $table = $this->productTable;
                $sequel = "INSERT INTO 
                            $table($keys) 
                        VALUES
                            (:".$values.")";
                $stmt = $this->connection->prepare($sequel);
                for($i = 0;$i < count($key);$i++){
                    $stmt->bindValue(':'.$key[$i],$value[$i]);
                }
                $exec = $stmt->execute();
                if($exec){
                    $response = [
                        "status" => 200,
                        "text" => "success"
                    ];
                    echo json_encode($response);
                }else{
                    $response = [
                        "status" => 500,
                        "text" => "Error"
                    ];
                    echo json_encode($response);
                }
            }
            
            
        }

        
        // public function add_donation(){
        //     //$cart_data = $this->select_this($id);
        //     $key = [];
        //     $value = [];
        //     $field = ['reason','target_amount','realized_amount'];
        //     for($i = 0;$i < count($field);$i++){
        //         if(in_array($field[$i],array_keys($this->data))){
        //             $index = $field[$i];
        //             $key[] =  $field[$i];
        //             $value[] = $this->data[$index];
        //         }
        //     }
        //     $keys = implode(',',$key);
        //     $values = implode(', :',$key);
        //     $table = $this->donationTable;
        //     $sequel = "INSERT INTO 
        //                 $table($keys) 
        //             VALUES
        //                 (:".$values.")";
        //     $stmt = $this->connection->prepare($sequel);
        //     for($i = 0;$i < count($key);$i++){
        //         $stmt->bindValue(':'.$key[$i],$value[$i]);
        //     }
        //     $exec = $stmt->execute();
        //     if($exec){
        //         $response = [
        //             "status" => 200,
        //             "text" => "success"
        //         ];
        //         echo json_encode($response);
        //     }
        // }
        public function send_mail(){
            $sender_email = filter_var($this->data['email'], FILTER_SANITIZE_EMAIL);
            $to = "habeebajani9@gmail.com";
            $subject = filter_var($this->data['subject'], FILTER_SANITIZE_STRING);
            $message = filter_var($this->data['message'], FILTER_SANITIZE_STRING);
            $name = $this->data['name'];
            $headers = "From: agent@americareside.com";
            if(mail($to, $subject, $message, $headers)){
                echo "Message sent";
            }else{
                echo "Something went wrong";
            }
            
        }
        private function generateUniqueCode($length = 8) {
            // Generate a unique ID based on the current time in microseconds
            $uniqueId = uniqid();
        
            // Generate a random string of the specified length
            $randomString = bin2hex(random_bytes($length));
        
            // Combine the unique ID with the random string
            $uniqueCode = $uniqueId . $randomString;
        
            // Return a truncated version of the generated code (optional, for fixed length)
            return substr($uniqueCode, 0, $length);
        }
        
        // Example usage
        // echo generateUniqueCode(16); // generates a random unique code with length 16
        
    }

?>
