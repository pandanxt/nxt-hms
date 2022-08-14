<?php
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";

    // Add OPD-SLIP Request Query
    if ($q == 'GENERATE-OPD-SLIP') {

        $title = mysqli_real_escape_string($db, $_POST['title']);
        $comment = mysqli_real_escape_string($db, $_POST['comment']);
        $by = mysqli_real_escape_string($db, $_POST['userId']);
        $table = 'OPD_SLIP_REQUEST';

        $sql = "INSERT INTO `edit_request`(`REQUEST_TABLE_ID`,`REQUEST_TABLE_NAME`, `REQUEST_NAME`, `REQUEST_COMMENT`, `REQUEST_BY`) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($db);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo "Error: " . $sql . "" . mysqli_error($stmt);
        }else{
            mysqli_stmt_bind_param($stmt,"sssss",$id,$table,$title,$comment,$by);
            mysqli_stmt_execute($stmt);
            echo "Form Has been submitted successfully";
        }			

        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    // View Edit Request Query Response
    if ($q == 'VIEW-OPD-SLIP') {
        $str = "OPD_SLIP_REQUEST";
        $request = 'SELECT *, `ADMIN_USERNAME` FROM `edit_request` INNER JOIN `admin` WHERE `edit_request`.`REQUEST_BY` = `admin`.`ADMIN_ID` AND `edit_request`.`REQUEST_BY` = '.$_SESSION["userid"].' AND `REQUEST_TABLE_ID` = '.$id.' AND `REQUEST_TABLE_NAME` = "'.$str.'"';
        $result = mysqli_query($db, $request) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr style='font-size: 12px;'>
            <td>";
            if ($row['REQUEST_NAME'] == 'cancel') {
                echo "Record Cancel Request";
            }else if ($row['REQUEST_NAME'] == 'update') {
                echo "Record Update Request";
            }
            echo"</td>
            <td>$row[REQUEST_COMMENT]</td>
            <td>";
            if ($row['REQUEST_STATUS'] == 0) {
                echo "Pending";
            }else if ($row['REQUEST_STATUS'] == 1) {
                echo "Approved";
            } else if ($row['REQUEST_STATUS'] == 2) {
                echo "Cancelled";
            } 
            echo"</td>
            <td>
                <b>By</b>: $row[ADMIN_USERNAME] <br>
                <b>On</b>: $row[REQUEST_ON]
            </td>
            <td>
                <a href='javascript:void(0);' onclick='updateOpdRequest($row[REQUEST_ID])' data-toggle='modal' data-target='#edit-request'>
                    <i class='fas fa-edit'></i>
                </a>
                <a onClick='deleteOptRequest($row[REQUEST_ID])' href='javascript:void(0);' style='color:red;'>
                    <i class='fas fa-trash'></i>
                </a>
            </td>
            </tr>";
        }   
    }
    // Update Edit Request Query
    if ($q == 'EDIT-OPD-SLIP') {

        $title = mysqli_real_escape_string($db, $_POST['eTitle']);
        $comment = mysqli_real_escape_string($db, $_POST['eComment']);
        $by = mysqli_real_escape_string($db, $_POST['userId']);

        if(mysqli_query($db, "UPDATE `edit_request` SET `REQUEST_NAME`= '$title',`REQUEST_COMMENT`='$comment',`REQUEST_BY`='$by' WHERE `REQUEST_ID`= ".$id)) {
            echo 'Form Has been submitted successfully';
        }else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
    // View Update Request Query Response
    if ($q == 'GET-OPD-SLIP') {
        $request = 'SELECT * FROM `edit_request` WHERE `REQUEST_ID` = "'.$id.'"';
        $result = mysqli_query($db, $request) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='modal-body'>
            <div class='form-group'>
              <label>Title</label>
              <select class='form-control select2bs4' name='eTitle' id='eTitle' style='width: 100%;'>";
               if ($row['REQUEST_NAME'] == "cancel") {
                    echo "<option selected value='cancel'>Cancel Slip</option>
                    <option value='update'>Update Slip</option>";
               }else if ($row['REQUEST_NAME'] == "update") {
                    echo "<option value='cancel'>Cancel Slip</option>
                    <option selected value='update'>Update Slip</option>";
               }
              echo "</select>
            </div>
            <div class='form-group'>
              <label>Comment</label>
              <textarea type='text' name='eComment' class='form-control' id='eComment' value='$row[REQUEST_COMMENT]' required>$row[REQUEST_COMMENT]</textarea>
            </div>
            <input type='text' name='userId' id='userId' value='$_SESSION[userid]' hidden readonly>
            <input type='text' name='eId' id='eId' value='$id' hidden readonly>
          </div>
          <div class='modal-footer justify-content-between'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            <button type='submit' name='submit' class='btn btn-primary'>Save</button>
          </div>";
        }   
    }
    // Request Record Delete Query
    if($q == 'REMOVE-OPD-REQUEST')
    {
        $sql ='DELETE FROM `edit_request` WHERE `REQUEST_ID` ="'.$id.'"';
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {  
            echo 'Form Has been submitted successfully';
        }else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
?>