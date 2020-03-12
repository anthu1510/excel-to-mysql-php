
<form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <label class="col-sm-3 label-on-left" style="margin-top: -16px;">Upload Excel</label>
                <div class="col-md-6">
                    <input name="result_file"  required=""  type="file">
                </div>
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-sm-3" style="width: 31%;margin-top: 15px;">
            <div class="pull-right hidden-print">
                <button type="submit" name="upload_excel" class="btn btn-primary btn-rounded"> Upload Excel</button>
            </div>
        </div>
    </div>
</form>

<?php
require_once ('connection.php');
require_once 'phpexcel/PHPExcel/IOFactory.php';
if(isset($_POST['upload_excel']))
{
    $file_info = $_FILES["result_file"]["name"];
    $file_directory = "uploads/excel_mail/";
    $new_file_name = date("dmY").".". $file_info["extension"];
    move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name);
    $file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
    $objReader	= PHPExcel_IOFactory::createReader($file_type);
    $objPHPExcel = $objReader->load($file_directory . $new_file_name);
    $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

    $res = [];
    foreach ($sheet_data as $row)
    {
        //array_push($res,$row);
      /*  $sql = "INSERT INTO `wp_admin_custom_users`(`id`, `reg_no`, `name`, `company_name`, `user_category`, `contact_no`, `email`, `date_of_joining`, `alter_email`, `select_type`, `member_category`, `district`, `area`, `address`, `status`, `username`, `password`, `group_name`, `group_id`)
                VALUES 
                ('".$row['A']."','".$row['B']."','".$row['C']."','".$row['D']."',
                '".$row['E']."','".$row['F']."','".$row['G']."',
                '".$row['H']."','".$row['O']."','".$row['M']."',
                '".$row['T']."','".$row['I']."','".$row['J']."',
                '".$row['K']."','".$row['L']."','".$row['M']."',
               '".md5($row['N'])."','".$row['R']."','".$row['S']."')";*/

       /* $sql = "INSERT INTO `wp_admin_custom_group`(`id`, `name`, `contact_no`,
`email`, `district`, `area`, 
`date_of_joining`, `address`, `status`) 
                        VALUES (
                        '".$row['A']."','".$row['B']."','".$row['C']."',
                        '".$row['D']."','".$row['F']."','".$row['G']."',
                        '".$row['E']."','".$row['H']."','".$row['I']."'
                        )";*/

       /*$sql = "INSERT INTO `wp_admin_custom_circulars`(`id`, `circular_no`, `title`, `circular_date`, `user_category`, `circular_type`, `crop`, `upload_circular`)
                            VALUES ('".$row['A']."','".$row['G']."','".$row['B']."',
                            '".$row['C']."','".$row['D']."','".$row['F']."','".$row['H']."','".$row['I']."'
                            )";*/



       $sql = "INSERT   
                    INTO
                        `wp_admin_custom_directory`  (`id`,  `title`,  `name`,  `email`,  `mobile_no`,  `phone_no`,  `res_phone_no`,  `fax`,  `pin_no`,  `address`)
                    VALUES
                    ('".$row['A']."','".$row['B']."','".$row['C']."','".$row['J']."','".$row['H']."','".$row['F']."',
                        '".$row['G']."','".$row['I']."','".$row['E']."','".$row['D']."')";

       //array_push($res,$sql);

        $result = mysqli_query($conn, $sql);
        /*if(!empty($row['C']))
        {
            $checkemail = mysqli_query($conn,'SELECT * FROM `wo_emaillist` WHERE email = "'.$row['C'].'" ');
            if(mysqli_num_rows($checkemail) == '0')
            {
                mysqli_query($conn,'INSERT INTO `wo_emaillist` (firstname,gender,email) VALUES ("'.$row['A'].'","'.$row['B'].'","'.$row['C'].'") ');
            }
        }*/

    }

    echo "<pre>";
    //print_r($sql."</br>");
    //print_r($res);
    print_r($result);
    //print_r($join_date);
    $updatemsg = "File Successfully Imported!";
    $updatemsgtype = 1;
}
?>
