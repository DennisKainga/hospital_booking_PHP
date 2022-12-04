<?php

function security_error($mess,$pdo){
    unset($pdo);
    header("Location: ../index.php?mess=$mess");
    exit;
}

function success_redirect($rank,$pdo){
    unset($pdo);
    header("Location: ../$rank/index.php");
    exit;
}

function verify_inputs($input_password,$username){
    //This will check to verify password no blank submissions on form return true if not empty
    if(empty($input_password) || empty($username)){
        return false;
    }
    else{
        return true;
    }
}

//This function will return data if any row matches email or id number provided else returns false
function check_user($pdo,$username){
    $statement=$pdo->prepare("SELECT * FROM login WHERE login_username=:email");
    $statement->bindValue(":email",$username);
    $statement->execute();
    $resultdata=$statement->fetch(PDO::FETCH_ASSOC);
    if($resultdata){
        return $resultdata;
    }
    else{
        return false;
    }
}


//This verifies is password of selected user is correct
function verify_password($hashed,$input_password){
    if(password_verify($input_password,$hashed)){
        return true;
    }
    else{
        return false;

    }
}

function get_userinfo($pdo,$uid,$rank){
    if($rank=="admin"){
        $statement = $pdo->prepare("SELECT * FROM admin WHERE admin_login_id=:id");
    }
    if($rank=="patient"){
        $statement = $pdo->prepare("SELECT * FROM patient WHERE patient_login_id=:id");
    }
    if($rank=="spec"){
        $statement = $pdo->prepare("SELECT * FROM specialist WHERE specialist_login_id=:id");
    }
    
    $statement->bindValue(":id",$uid);
    $statement->execute();
    $userinfo = $statement->fetch(PDO::FETCH_ASSOC);
    if($userinfo){
        return $userinfo;
    }
    else{
        return false;
    }
}


function startUserSession($userdata,$input_password,$pdo){
    if(verify_password($userdata["login_password"],$input_password)){
        
        $set_userinfo = get_userinfo($pdo,$userdata["login_id"],$userdata["login_rank"]);
        session_start();
        if($userdata["login_rank"]=="admin"){
           $_SESSION["uid"] = $set_userinfo["admin_id"];
           $_SESSION["name"] = $set_userinfo["admin_name"];
           $_SESSION["email"] = $set_userinfo["admin_email"];
           $_SESSION["phone"] = $set_userinfo["admin_mobile"];          
        }
        if($userdata["login_rank"]=="patient"){
            $_SESSION["uid"] = $set_userinfo["patient_id"];
            $_SESSION["name"] = $set_userinfo["patient_name"];
            $_SESSION["phone"] = $set_userinfo["patient_mobile"];
            $_SESSION["email"] = $set_userinfo["patient_email"];
            $_SESSION["gender"] = $set_userinfo["patient_gender"];
            $_SESSION["dob"] = $set_userinfo["patient_dob"];
        }

        if($userdata["login_rank"]=="spec"){
            $_SESSION["uid"] = $set_userinfo["specialist_id"];
            $_SESSION["name"] = $set_userinfo["specialist_name"];
            $_SESSION["phone"] = $set_userinfo["specialist_mobile"];
            $_SESSION["email"] = $set_userinfo["specialist_email"];
            $_SESSION["gender"] = $set_userinfo["specialist_gender"];
            

        }
        return $userdata["login_rank"];
    }
    else{
        return False;
    }
}

//DRIVER CODE

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['uname'];
    $input_password=$_POST['password'];
    require_once "dbh.inc.php";
    if(verify_inputs($input_password,$username)){
        $UserResult=check_user($pdo,$username);
        if($UserResult){
            $UserRank=startUserSession($UserResult,$input_password,$pdo);
            if($UserRank){
                if($UserRank=="patient"){
                    success_redirect('patient',$pdo);
                }
                else if($UserRank=="admin"){
                    success_redirect('admin',$pdo);
                }
                else if($UserRank=="spec"){
                    success_redirect('specialist',$pdo);
                }
                else{
                    security_error('contactus',$pdo);

                }
            }
            else{
                security_error('wrongpwd',$pdo);
            }
        }
        else{
            security_error('nouser',$pdo);

        }
    }
    else{
        security_error('emptyinputs',$pdo);
    }
      
}

?>