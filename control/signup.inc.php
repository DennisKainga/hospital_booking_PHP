<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SERVER["REQUEST_METHOD"]==='POST'){
    $uname = $_POST["uname"];
    $first_name=$_POST['fname'];
    $last_name=$_POST['lname'];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password_repeat=$_POST['password_repeat'];
    $rank = $_POST["rank"] ??"patient";
    $loc = $_POST["loc"] ?? "";
    $dob = $_POST["dob"] ?? "";
    $spes_id = $_POST["spes_id"] ?? "";
   
    
    if($password!=$password_repeat){
        header("Location: ../register.php?mess=no_match");
        exit;
    }
  
    require_once "dbh.inc.php";

    if(empty($first_name) || empty($last_name) || empty($password) || empty($password_repeat) || empty($email)){
        header("Location: ../register.php?mess=empty_inputs");
        exit;
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("Location: ../register.php?mess=invalidemail");
        exit;
    }

    if($password!==$password_repeat){
        header("Location: ../register.php?mess=passwordsdonotmatch");
        exit;
    }

    function userexist($pdo,$uname){
        $statement=$pdo->prepare("SELECT * FROM login WHERE login_username = :username");
        $statement->bindValue(":username",$uname);
        $statement->execute();
        $resultdata=$statement->fetchAll(PDO::FETCH_ASSOC);
        if($resultdata){
            return true;
        }
        else{
            return false;
        }
    }

    function authenticate($pdo,$uname,$password,$rank){
        $statement=$pdo->prepare("INSERT INTO login(login_username,login_password,login_rank)
        VALUES(:uname,:passwd,:login_rank)");
        $statement->bindValue(':uname',$uname);
        $statement->bindValue(':passwd',password_hash($password,PASSWORD_DEFAULT));
        $statement->bindValue(":login_rank",$rank);
        $statement->execute();
        return $pdo->lastInsertId();
    }

    function adduser($pdo,$first_name,$last_name,$email,$phone,$gender,$login_id,$dob,$loc,$spes_id,$rank){
        
        if($rank=="admin"){
            $statement=$pdo->prepare("INSERT INTO admin
            (admin_name,admin_mobile,admin_email,admin_gender,admin_login_id)
            VALUES(:name,:phone,:email,:gender,:login_id)");
        }
        if($rank=="patient"){
            $statement=$pdo->prepare("INSERT INTO patient
            (patient_name,patient_mobile,patient_email,patient_gender,patient_dob,patient_location,patient_login_id)
            VALUES(:name,:phone,:email,:gender,:dob,:loc,:login_id)");
            $statement->bindValue(":dob",$dob);
            $statement->bindValue(":loc",$loc);
        }
        if($rank=="spec"){
            $statement=$pdo->prepare("INSERT INTO specialist
        (specialist_name,specialist_mobile,specialist_email,specialist_gender,specialist_location,specialist_specialization_id,specialist_login_id)
            VALUES(:name,:phone,:email,:gender,:loc,:spes_id,:login_id)");
            $statement->bindValue(":loc",$loc);
            $statement->bindValue(":spes_id",$spes_id);
        }

        $statement->bindValue(":name",$first_name.' '.$last_name);
        $statement->bindValue(":phone",$phone);
        $statement->bindValue(":email",$email);
        $statement->bindValue(":gender",$gender);
        $statement->bindValue(":login_id",$login_id);
        $statement->execute();
    }
    if(!userexist($pdo,$uname)){
        $user_login_id =  authenticate($pdo,$uname,$password,$rank);
        adduser($pdo,$first_name,$last_name,$email,$phone,$gender,$user_login_id,$dob,$loc,$spes_id,$rank);
        if($rank=="spec"){
            header("Location: ../admin/specs.php?mess=sucess");
        }
        if($rank=="admin"){
            header("Location: ../admin/index.php?mess=sucess");
        }
        if($rank=="patient"){
            header("Location: ../index.php?mess=sucess");
        }
    }    
    else{
        header("Location: ../admin/index.php?mess=userexists");
        exit;
    }
   
}

else{
    header('Location: ../admin/index.php?mess=error');
}
