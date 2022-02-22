<?php
    session_start();
    require_once 'db.php';
    $action = '';
    if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];
    
    if($action == 'onLogin'){
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        echo json_encode(Db::tonTai_ND($email, $pwd));
    }

    if($action == 'onSignUp'){
        $email = $_REQUEST['email'];
        $pwd = $_REQUEST['pwd'];
        $result = Db::tonTai_ND_DK($email);
        if($result['success'])
            echo json_encode(Db::dangKy(NULL, NULL, $pwd, $email, NULL, 0, NULL,NULL));
        else
            echo json_encode($result);
    }

    if(isset($_REQUEST['btn_submit_login'])){
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        
        $maTruyCap = Db::taoTruyCap()['maTruyCap'];
        
        $_SESSION['maTruyCap'] =  $maTruyCap;
        $result = Db::dangNhap($email, $pwd, Db::getTruyCap($maTruyCap));
        echo json_encode($result);
        if($result['success'])
            header('location: ../Home/index.html');
        else
            echo json_encode(['success'=>false, 'msg'=>'Lỗi không xác định! | login.php ']);
    }

    // Auto Login
    if($action == 'Auto-Login'){
        if(isset($_SESSION['maTruyCap'])){
            $maTruyCap = $_SESSION['maTruyCap'];
            Db::capNhat_IP($maTruyCap)['success'];
            $loginInfo = Db::getUser($maTruyCap);
            if($loginInfo['success']==true){
                $rs = Db::dangNhap($loginInfo['email_ND'], $loginInfo['matKhau_ND'], Db::getTruyCap($maTruyCap));
                echo json_encode($rs);
                $_SESSION['login_info'] = $rs;
            }
            else
                echo json_encode($loginInfo);
        }
        else{
            $maTruyCap = Db::taoTruyCap()['maTruyCap'];
        }
        $_SESSION['maTruyCap'] = $maTruyCap;
    }








?>