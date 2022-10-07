<?php

require 'connection.php';

if (isset($_POST['login'])) {

    $uid = $_POST['username'];
    $pass = $_POST['password'];    

    if (empty($uid)||empty($pass)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM `me_user` WHERE `USER_EMAIL` = ? OR `USER_ID` = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$uid,$uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($pass,$row['USER_PASSWORD']);
                    if ($pwdCheck == false) {
                        header("Location: ../login.php?error=wrongpwd");
                        exit();
                    }elseif ($pwdCheck == true) {
                        session_start();
                        $_SESSION['uuid'] = $row['USER_UUID'];
                        $_SESSION['email'] = $row['USER_EMAIL'];
                        $_SESSION['name'] = $row['USER_NAME'];
                        $_SESSION['user_id'] = $row['USER_ID'];
                        $_SESSION['savetime'] = $row['USER_DATE_TIME'];
                        $_SESSION['role'] = $row['USER_ROLE'];
                        header("Location: ../index.php?login=success");
                        exit();
                    }else{
                        header("Location: ../login.php?error=wrongpwd");
                        exit();
                    }
            }else{
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
}

?>