<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {   
        $data = json_decode(file_get_contents('php://input'), true);
        switch ($data['action']) {
            case 'findUser':
                    include_once "./db_manager.php";
                    $db_manager=new DB_Manager();
                    echo json_encode(['result' => $db_manager->userExist($data["username"])]);
                break;
            
            default:
                break;
        }
    }
    
?> 