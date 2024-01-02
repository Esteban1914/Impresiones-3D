<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {   
        $data = json_decode(file_get_contents('php://input'), true);
        include_once "./db_manager.php";
        $db_manager=new DB_Manager();
        switch ($data['action']) {
            case 'findUser':
                    echo json_encode(['result' => $db_manager->userExist($data["username"])]);
                break;
            case "findPassword":
                    echo json_encode(['result' => $db_manager->userExistPassword($_SESSION['user'],$data["password"])]);
                break;
            default:
                break;
        }
    }
    
?> 