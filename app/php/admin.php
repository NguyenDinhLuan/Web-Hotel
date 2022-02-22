<?php
    session_start();
    require_once 'db.php';

    
    $action = '';
    if(isset($_REQUEST['action']))
    $action = $_REQUEST['action'];
    

    if($action=='getHoaDon'){
        $hoadon = Db::thongTinHoaDonADMIN();
        echo json_encode($hoadon);
    }


    if($action=='getKhachHang'){
        $khachHang = Db::thongTinKhachHangADMIN();
        echo json_encode($khachHang);
    }


    if($action=='duyet'){
        if($_REQUEST['accept']==1)
        $accept = true;
        else
        $accept = false;
        $maSo_KH = $_POST['maSo_KH'];
        $maHoaDon = $_REQUEST['maHoaDon'];
        echo json_encode(Db::duyetDonADMIN($maHoaDon, $maSo_KH, $accept));
           
    }

    if($action=='getDanhGia'){
        $danhgia = Db::getDanhGia();
        echo json_encode($danhgia);
    }





    if($action=='changeInfo'){
        echo $_POST['address'];
        $rs = Db::getUser($_SESSION['maTruyCap']);
        if($rs['success']){
            $name = $_POST['name'];
            $tenDangNhap = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $new_pwd = $_POST['new_pwd'];
            echo json_encode(Db::changeInfo($rs['maSo_ND'], $name, $email, $tenDangNhap, $phone, $address, $city, $new_pwd));
            header('location: ../account/taiKhoanAdmin.html');
        }

    }
    
?>