<?php
    session_start();
    require __DIR__ . '/connect.php';

    $email =  $_POST['email'] ;
    $pass =  $_POST['pass'] ;
    $sql = "EXEC dbo.[check_login] @email = ?";
    $procedure_params = array($email);
    $stmt = sqlsrv_query( $conn, $sql, $procedure_params);
    if($stmt) {
        $true = sqlsrv_has_rows($stmt);
        if($true){
            sqlsrv_fetch($stmt);
            $pass1 = sqlsrv_get_field($stmt,1);
            if($pass1 == $pass){
                $pq = sqlsrv_get_field($stmt,7);
                if($pq == 1){
                    echo ("user");
                    $_SESSION['user'] = 'user';
                }else{
                    echo ("admin");
                    $_SESSION['user'] = 'admin';
                }
                $_SESSION['name'] = sqlsrv_get_field($stmt,0);
                $_SESSION['HoTen'] = sqlsrv_get_field($stmt,2);
                $_SESSION['Tuoi'] = sqlsrv_get_field($stmt,3);
                $_SESSION['GioiTinh'] = sqlsrv_get_field($stmt,4) ? 'Nam' : 'Nu';
                $_SESSION['SDT'] = sqlsrv_get_field($stmt,5);
                $_SESSION['Image'] = sqlsrv_get_field($stmt,6);
            }
        }else{
            echo 'Fail';
            sqlsrv_free_stmt( $stmt);
        }
    }else{
        echo 'hi';
    }


    // while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //     if($email == $row['Email'] && $pass == $row['Password']){
    //         $flag = true;
    //         if($row['PhanQuyen'] == 1){
    //             echo ("user");
    //             $_SESSION['user'] = 'user';
    //         }else{
    //             echo ("admin");
    //             $_SESSION['user'] = 'admin';
    //         }
    //             $_SESSION['name'] = $row['Email'];
    //             $_SESSION['HoTen'] = $row['HoTen'];
    //             $_SESSION['Tuoi'] = $row['Tuoi'];
    //             $_SESSION['GioiTinh'] = $row['GioiTinh'] ? 'Nam' : 'Nu';
    //             $_SESSION['SDT'] = $row['SDT'];
    //             $_SESSION['Image'] = $row['Image'];
    //         break; 
    //     }
    // }
    

?>