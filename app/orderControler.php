<?php

    

    function getListOder(){
        require __DIR__ . '/connect.php';

        $arr =  array();
        $sql = "SELECT * FROM [PhieuThu]";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $arr[$row['MaP']] = array($row['MaKH'],$row['TongTien'],$row['NgayLap']); 
        }
        echo json_encode($arr);
    }

    function show($id){
        require __DIR__ . '/connect.php';
        $arr =  array();
        $sql = "SELECT [Chon].MaKH , [Chon].SoLuong , [LoaiNuoc].TenN , [LoaiNuoc].DonGia FROM [Chon] LEFT JOIN [LoaiNuoc] ON [Chon].MaN = [LoaiNuoc].MaN AND [Chon].MaKH = $id";
        $query = sqlsrv_query($conn,$sql);
        if($query == false){
            die( print_r(sqlsrv_errors(), true));
        }else{
            while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
                $arr[$row['TenN']] = array($row['SoLuong'],$row['MaKH'],$row['DonGia']); 
            }
        }
        echo json_encode($arr);
        sqlsrv_free_stmt($query);
    }

    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case 'getListOder':
                getListOder();
                break;
            case 'showOrder':
                show((int)$_GET['id']);
                break;
            default:
                echo "ko có response data";
                break;
        }
    }
    
?>