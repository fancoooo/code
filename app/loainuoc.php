<?php
    function listnuoc(){
        require __DIR__ . '/connect.php';
        $arr = array();
        $sql = "SELECT * FROM [LoaiNuoc]";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        $str = "";

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $arr[] = $row['MaN']."-".$row['TenN']."-".$row['LoaiN']."-".$row['DonGia'];
        }
        print_r(json_encode($arr));
    }

    function listdanhmuc(){
        require __DIR__ . '/connect.php';
        $arr = array();
        $sql = "SELECT * FROM [DanhMuc]";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        $str = "";

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $arr[$row['LoaiN']] = array($row['TenL']); 
        }
        echo json_encode($arr);
    }

    function addsp($t,$l,$p){
        require __DIR__ . '/connect.php';
        $sql = 'INSERT INTO LoaiNuoc(TenN,LoaiN,DonGia) VALUES(?,?,?)';
        $stmp = sqlsrv_prepare($conn,$sql,array($t,$l,$p));
        if($stmp == false){
            die( print_r( sqlsrv_errors(), true));
        }else{
            $ex = sqlsrv_execute($stmp);
            if($ex == false){
                echo 'none';
            }else{
                echo 'done';
            }
        }
        sqlsrv_free_stmt($stmp);
    }

    function delcategory($id){
        require __DIR__ . '/connect.php';
        $sql = 'DELETE FROM DanhMuc WHERE LoaiN = ?';
        $stmp = sqlsrv_prepare($conn,$sql,array($id));
        if($stmp == false){
            die( print_r( sqlsrv_errors(), true));
        }else{
            $ex = sqlsrv_execute($stmp);
            if($ex == false){
                echo 'none';
            }else{
                echo 'done';
            }
        }
        sqlsrv_free_stmt($stmp);
    }

    function adddm($t,$l){
        require __DIR__ . '/connect.php';
        $sql = 'INSERT INTO DanhMuc(LoaiN,TenL) VALUES(?,?)';
        $stmp = sqlsrv_prepare($conn,$sql,array($t,$l));
        if($stmp == false){
            die( print_r( sqlsrv_errors(), true));
        }else{
            $ex = sqlsrv_execute($stmp);
            if($ex == false){
                echo 'none';
            }else{
                echo 'done';
            }
        }
        sqlsrv_free_stmt($stmp);
    }
    

    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case 'getlistnuoc':
                listnuoc();
                break;
            case 'getdanhmuc':
                listdanhmuc();
                break;
            case 'addsp':
                addsp($_GET['tensp'],$_GET['loaisp'],(int)$_GET['gia']);
                break;
            case 'adddm':
                adddm($_GET['codedm'],$_GET['namedm']);
                break;
            case 'deleteCategory':
                delcategory($_GET['id']);
                break;
            default:
                echo "fail";
                break;
        }
    }else{
        echo json_encode("hello");
    }
    
?>