<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {   
        $data = json_decode(file_get_contents('php://input'), true);
        include_once "./user.php";
        $user=new User();
        switch ($data['action']) {
            case 'findUser':
                    echo json_encode(['result' => $user->userExist($data["username"])]);
                break;
            case "findPassword":
                    echo json_encode(['result' => $user->userExistPassword($_SESSION['user'],$data["password"])]);
                break;
            case "findValidation":
                echo json_encode(['result' => $user->validationExist($data["data"])]);
                break;
            default:
                break;
        }
    }
    
?> 