<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {   
        $data = json_decode(file_get_contents('php://input'), true);
        switch ($data['action']) {
            case 'findUser':
                    include_once "./user.php";
                    $user=new User();
                    echo json_encode(['result' => $user->userExist($data["username"])]);
                break;
            
            default:
                break;
        }
    }
    
?> 