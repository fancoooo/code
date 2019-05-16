<?php
    session_start();
    require __DIR__ . '/connect.php';

    $email =  $_POST['email'] ;
    $pass =  $_POST['pass'] ;
    $sql = "SELECT * FROM [User]";
    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }
    $flag = false;
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        if($email == $row['Email'] && $pass == $row['Password']){
            $flag = true;
            if($row['PhanQuyen'] == 1){
                echo ("user");
                $_SESSION['user'] = 'user';
            }else{
                echo ("admin");
                $_SESSION['user'] = 'admin';
            }
                $_SESSION['name'] = $row['Email'];
                $_SESSION['HoTen'] = $row['HoTen'];
                $_SESSION['Tuoi'] = $row['Tuoi'];
                $_SESSION['GioiTinh'] = $row['GioiTinh'] ? 'Nam' : 'Nu';
                $_SESSION['SDT'] = $row['SDT'];
                $_SESSION['Image'] = $row['Image'];
            break; 
        }
    }
    echo $flag ? '' : 'Fail';
    sqlsrv_free_stmt( $stmt);

?>