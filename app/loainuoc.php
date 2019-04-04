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

    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case 'getlistnuoc':
                listnuoc();
                break;
            
            default:
                echo "fail";
                break;
        }
    }else{
        echo json_encode("hello");
    }
    
?>