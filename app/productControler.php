<?php

    
    // GET /List
    function getListProduct(){
        require __DIR__ . '/connect.php';
        $arr =  array();
        $sql = "SELECT * FROM [LoaiNuoc]";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        $flag = false;
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $arr[$row['MaN']] = array($row['TenN'],$row['LoaiN'],$row['DonGia']); 
        }
        echo json_encode($arr);
    }

    //POST /DELETE
    function deleteProduct($id){
        require __DIR__ . '/connect.php';
        $sql = "DELETE FROM [LoaiNuoc] WHERE MaN = ?";
        $query = sqlsrv_prepare($conn,$sql,array(&$id));
        if($query == false){
            die( print_r(sqlsrv_errors(), true));
        }else{
            $id = $id;
            if(sqlsrv_execute($query) == false){
                die( print_r(sqlsrv_errors(), true));
            }
        }
        sqlsrv_free_stmt($query);
    }

    function updateProduct($id,$price){
        require __DIR__ . '/connect.php';
        $sql = "UPDATE [LoaiNuoc] SET DonGia = ? WHERE MaN = ?";
        $query = sqlsrv_prepare($conn,$sql,array(&$price,&$id));
        if($query == false){
            die( print_r(sqlsrv_errors(), true));
        }else{
            $id = $id;
            $price = $price;
            if(sqlsrv_execute($query) == false){
                die( print_r(sqlsrv_errors(), true));
            }
        }
        sqlsrv_free_stmt($query);
    }

    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case 'getListProduct':
                getListProduct();
                break;
            case 'deleteProduct':
                deleteProduct((int)$_GET['id']);
                break;
            case 'updateProduct':
                updateProduct((int)$_GET['id'],(int)$_GET['price']);
                break;
            default:
                echo "ko có response data";
                break;
        }
    }
    
?>