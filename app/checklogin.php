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
                echo ("User");
                $_SESSION['user'] = 'User';
                $_SESSION['name'] = $row['Email'];
            }else{
                echo ("Admin");
                $_SESSION['user'] = 'Admin';
                $_SESSION['name'] = $row['Email'];
            }
            break; 
        }
    }
    echo $flag ? '' : 'Fail';
    sqlsrv_free_stmt( $stmt);

?>