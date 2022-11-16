<?php
    include('connection.php');
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    // Login Request Query
    if ($q == 'LOGIN_REQUEST') {
        // Post Generic Variables
        $uid = mysqli_real_escape_string($db, $_POST['username']);
        $pass = mysqli_real_escape_string($db, $_POST['password']);  
        // Query to Check Email Or User Id
        $sql = "SELECT * FROM `me_user` WHERE `USER_EMAIL` = ? OR `USER_ID` = ?";
        $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                // Return Error
                $result = [];
                $result['status'] = "error";
                $result['message'] = "Something went wrong!";
                echo json_encode($result);
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"ss",$uid,$uid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $pwdCheck = password_verify($pass,$row['USER_PASSWORD']);
                            if ($pwdCheck == false) {
                                // Return Error
                                $result = [];
                                $result['status'] = "error";
                                $result['message'] = "Invalid Credentials!";
                                echo json_encode($result);
                                exit();
                            }elseif ($pwdCheck == true) {
                                // Return Session Data
                                session_start();
                                $_SESSION['uuid'] = $row['USER_UUID'];
                                $_SESSION['email'] = $row['USER_EMAIL'];
                                $_SESSION['name'] = $row['USER_NAME'];
                                $_SESSION['user_id'] = $row['USER_ID'];
                                $_SESSION['savetime'] = $row['USER_DATE_TIME'];
                                $_SESSION['role'] = $row['USER_ROLE'];
                                // Return Success Message
                                $result = [];
                                $result['status'] = "success";
                                $result['message'] = "Welcome ".$row['USER_NAME'];
                                echo json_encode($result);
                                exit();
                            }else{
                                // Return Error
                                $result = [];
                                $result['status'] = "error";
                                $result['message'] = "Invalid Credentials!";
                                echo json_encode($result);
                                exit();
                            }
                    }else{
                        // Return Error
                        $result = [];
                        $result['status'] = "error";
                        $result['message'] = "Invalid Credentials!";
                        echo json_encode($result);
                        exit();
                    }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    // Logout Request Query
    if ($q == 'LOGOUT_REQUEST') {
        session_start();
        $_SESSION = array();
        session_destroy();
        // Return Success Message
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Logout Successfully!";
            echo json_encode($result);
        exit;
    }
?>