<?php
session_start();
include("dbconnect.php");
$uidlgn=$_SESSION['login'];
$dwny=mysqli_fetch_assoc(mysqli_query($conn,"select * from login where uname='$uidlgn';"));
$batch=$dwny['batch'];
$branch=$dwny['branch'];
if($_POST['idr']==8){
  $stdid=$_POST['srh'];
  if($_POST['selfn']=="Selected"){
      mysqli_query($conn,"update registration_details set selected='rejected' where studid='$stdid';");
  }
  else
  {
      mysqli_query($conn,"update registration_details set selected='selected' where studid='$stdid';");

  }
echo 1;

}


if($_POST['idr']==7){//used to display the list of students
    
  $srch=$_POST['srh'];
  
  //$user_idr=$_POST['uidrh'];
      if($srch==""){
        $sqQuery = "select * from registration_details where branch='$branch' and (selected='selected' or selected='rejected' )order by rollno;";
       // echo "1";
     }
       else{
        if($srch!="")
        {
          $m=$srch."%";
        $sqQuery = "select * from registration_details where ( studid like '$m' or fullname like '$m') and  branch='$branch' and (selected='selected' or selected='rejected' ) order by rollno;";
        //echo 2;
        }
        
      } 
  
         $resObjQuery = mysqli_query($conn, $sqQuery);
         $_SESSION['fetch_qry']="select * from registration_details where branch='$branch' and selected='selected' order by rollno;";;
      $i = 0;
      if (mysqli_num_rows($resObjQuery)) {
          while ($rowObj = mysqli_fetch_assoc($resObjQuery)) {
              $retArray[$i] = $rowObj;
              $i++;
          }
          echo json_encode($retArray);
      } else {
          $retArray[0] = "NULL";
          echo json_encode($retArray);
      }
  }

if($_POST['idr']==6){//used to display the list of students
    
$_SESSION['login']="";
  echo 1;
  
  }

if($_POST['idr']==5){//used to display the list of students
    
if($_SESSION['login']=="")
{
  echo 0;
}
else
{
  echo 1;
}

}
if($_POST['idr']==4){//used to display the list of students
    
  
        $sqQuery = "select * from registration_details where branch='$branch' and batch='$batch'and selected='selected' order by rollno;";
       // echo "1";
    
         $_SESSION['fetch_qry']=$sqQuery;
       $resObjQuery = mysqli_query($conn, $sqQuery);

      $i = 0;
      if (mysqli_num_rows($resObjQuery)) {
          while ($rowObj = mysqli_fetch_assoc($resObjQuery)) {
              $retArray[$i] = $rowObj;
              $i++;
          }
          echo json_encode($retArray);
      } else {
          $retArray[0] = "NULL";
          echo json_encode($retArray);
      }
  }


    if($_POST['idr']==3){//used to return json data for filling
        $tid=$_POST['reff_dta'];
        $tdata=mysqli_fetch_assoc(mysqli_query($conn,"select * from registration_details where studid='$tid';"));
      //  $user_idr=$tdata['user_id'];
      $_SESSION['fetch_qry']="select * from registration_details where studid='$tid';";
        //$udata=mysqli_fetch_assoc(mysqli_query($conn,"select * from registration_details where studid='$user_idr';"));
        $rtarray['0']=$tdata['fullname'];
        $rtarray['1']=$tdata['studid'];
        $rtarray['2']=$tdata['email'];
        $rtarray['3']=$tdata['mobile'];
        $rtarray['4']=$tdata['fatherincome'];
        $rtarray['5']=$tdata['motherincome'];
        $rtarray['6']=$tdata['sibling1income'];
        $rtarray['7']=$tdata['sibling2income'];
        $rtarray['8']=$tdata['entrancerank'];
        $rtarray['9']=$tdata['gpa'];
        echo json_encode($rtarray);
        
        }
 
        if($_POST['idr']==2){
            $stdid=$_POST['srh'];
            if($_POST['selfn']=="Select"){
                mysqli_query($conn,"update registration_details set selected='selected' where studid='$stdid';");
            }
            else
            {
                mysqli_query($conn,"update registration_details set selected='' where studid='$stdid';");

            }
echo 1;

        }

if($_POST['idr']==1){//used to display the list of students
    
$srch=$_POST['srh'];

//$user_idr=$_POST['uidrh'];
    if($srch==""){
      $sqQuery = "select * from registration_details where branch='$branch' and batch='$batch' order by rollno;";
     // echo "1";
   }
     else{
      if($srch!="")
      {
        $m=$srch."%";
      $sqQuery = "select * from registration_details where ( studid like '$m' or fullname like '$m') and  branch='$branch' and batch='$batch' order by rollno;";
      //echo 2;
      }
      
    } 

       $resObjQuery = mysqli_query($conn, $sqQuery);
       $_SESSION['fetch_qry']=$sqQuery;
    $i = 0;
    if (mysqli_num_rows($resObjQuery)) {
        while ($rowObj = mysqli_fetch_assoc($resObjQuery)) {
            $retArray[$i] = $rowObj;
            $i++;
        }
        echo json_encode($retArray);
    } else {
        $retArray[0] = "NULL";
        echo json_encode($retArray);
    }
}
?>