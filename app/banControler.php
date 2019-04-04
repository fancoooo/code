<?php

    

    function getListBan(){
        require __DIR__ . '/connect.php';

        $arr =  array();
        $sql = "SELECT * FROM [Ban]";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        $flag = false;
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $arr[$row['MaBan']] = array($row['SoChoNgoi'],$row['IsKH']); 
        }
        echo json_encode($arr);
    }

    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case 'getListBan':
                getListBan();
                break;
            
            default:
                echo "ko có response data";
                break;
        }
    }
    
?>