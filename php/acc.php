<?php  
  ini_set(session.save_path,'C:\xampp\htdocs\drdo30\session'); 
session_start();
  $sf=$_SESSION['sfid']; //sfid is passed as session variable
  ?>
<!DOCTYPE html>

<html>
    <head>
      <title>IT Requistion Portal</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">      
	  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/cloudflare.css">
    <link rel="stylesheet" type="text/css" href="../css/fonts.css">

    <link rel="stylesheet" type="text/css" href="../css/responsiveform.css">
  <link rel="stylesheet" media="screen and (max-width: 1550px) and (min-width: 1200px)" href="../css/responsiveform4.css" />
  <link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 601px)" href="../css/responsiveform1.css" />
  <link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 351px)" href="../css/responsiveform2.css" />
  <link rel="stylesheet" media="screen and (max-width: 350px)" href="../css/responsiveform3.css" />

      <script type="text/javascript" href="../js/cloudflare"></script>  
      <script type="text/javascript" href="../js/jquery"></script>
      <style>
      .pin{
        margin-left: 20px;
        margin-right: 20px;
      }
  #columns:hover .pin:not(:hover) {
  opacity: 0.4;
}</style>                
  </head>

  <nav>
    <div class="nav-wrapper">
      <a  href="#" class="brand-logo center">IT Assets Requistion Portal</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
       <?php echo "<li><a href='home.php'>Home</a></li>"; ?>

       <?php echo "<li><a href='sent.php'>Sent Issues</a></li>"; ?>
        <?php 
       mysql_connect("localhost", "root", "") or die (mysql_error());
          mysql_select_db("asl") or die(mysql_error());

          $query="SELECT * FROM info WHERE bsfid='$sf'"; // table name 'info'
        $result= mysql_query($query);
        $count=0;
        while($row= mysql_fetch_array($result)){
          $count=$count+1;}              // counting if any employee has this 
                                        //fellow as a boss or not
        if($count!=0){
       echo "<li class='active'><a href='pend.php'>Received</a></li>";
       }                               //if atleast one such employee is there this fellow can receive requests hence should be there
       ?>                           
      </ul>
      <ul class="right hide-on-med-and-down">
      
        <li><a class="waves-effect waves-light indigo accent-4 btn" href="logout.php">Log Out</a></li>
       
      </ul>
    </div>
    </nav><nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
       <?php echo "<li class='active'><a href='acc.php'>Accepted</a></li>"; ?>
       <?php echo "<li><a href='decl.php'>Declined</a></li>";?> 
       <?php echo "<li><a href='pend.php'>Pending</a></li>"; ?>
      </ul>
    </div>


  </nav>

  <body>
<?php

$a1=2;$a2=3;$a3=4;$a4=5;$a5=6;$a6=7;$x=1;$sn=1;$sn1=1; // all 'a's are to set opt field. 'sn' and 'sn1' are serial numbers in the tables

$query="SELECT * FROM flash WHERE bsfid='$sf' AND opt=2";
$result= mysql_query($query);
//$i=0;$ids=array();
if($sf=='14co101'){       //Help Desk ID
  $query="SELECT * FROM flash WHERE (bsfid='$sf' AND opt=2) OR (help_desk='$sf' AND opt=5)";
$result= mysql_query($query);

}
while($row= mysql_fetch_array($result)){

  if($sn1==1){        // For displaying table head only if it is non-empty
    ?>

<table class="highlight bordered">
        <thead>
          <tr>
              <th data-field="sno">S/No</th>
              <th data-field="id">SFID</th>
              <th data-field="req">Request</th>
          </tr>
        </thead>
        <tbody><?php
  }

if($row[opt]==2){ $_SESSION['acc_sfid']=$row['sfid'];
  echo "<a href='flash_disp.php'>";
 echo "<div class='row  columns' id=" . $row['flash_id'] . " >";
        echo "<tr>";
            echo "<td>".$sn1."</td>";$sn1=$sn1+1;
            echo "<td><a href='flash_disp.php?id=" . $row[flash_id] . "''>$row[sfid]</a></td>";
            echo "<td>Flash Drive</td>";
            echo "</tr>";/*
          echo "<div class='card blue-grey'>";
            echo "<div class='card-content white-text' >";
              echo "<span class='card-title' > Request for FlashDrive Acess<br> </span>";
              echo "<h6> IP or Name of PC for Acess : $row[ipon] </h6><br>";
              echo "PURPOSE : $row[purp]";
            echo "</div> ";
            */
          echo "</div>";
          echo "</a>";
            }
  if($row[opt]==5&&$row[help_desk]=='14co101'){

    $_SESSION['acc_sfid']=$row['sfid'];
    echo "<a href='flash_disp.php'>";
    echo "<div class='row  columns' id=" . $row['flash_id'] . " >";
        echo "<tr>";
            echo "<td>".$sn1."</td>";$sn1=$sn1+1;
            echo "<td><a href='flash_disp.php?id=" . $row[flash_id] . "''>$row[sfid]</a></td>";
            echo "<td>Flash Drive</td>";
            echo "</tr>";
            /*
          echo "<div class='card blue-grey '>";
            echo "<div class='card-content white-text' >";
              echo "<span class='card-title' > Request for FlashDrive Acess<br> </span>";
              echo "<h6> IP or Name of PC for Acess : $row[ipon]</h6><br>";
              echo "PURPOSE : $row[purp]";
            echo "</div> ";          
          echo "</div>";
          */
          echo "</div>";
          echo "</a>";
        }

}

//echo "<br><div class='center'> <h5>Accepted requests</h5></div>";

$query="SELECT * FROM pc WHERE bsfid='$sf' AND opt=2";
$result= mysql_query($query);
//$i=0;$ids=array();
if($sf=='14co101'){//Help Desk ID
  $query="SELECT * FROM pc WHERE (bsfid='$sf' AND opt=2) OR ($sf='14co101' AND opt=5)"; //'14co101' is Help Desk
$result= mysql_query($query);

}
while($row= mysql_fetch_array($result)){

  if($sn==1){?>

<table class="highlight bordered">
        <thead>
          <tr>
              <th data-field="sno">S/No</th>
              <th data-field="id">SFID</th>
              <th data-field="req">Request</th>
          </tr>
        </thead>
        <tbody><?php
  }

if($row[opt]==2){
   $_SESSION['acc_sfid']=$row['sfid'];
  echo "<a href='pc_disp.php?id=" . $row['pc_id'] . "'>"; //passing pc request id via URL
 echo "<div class='row  columns' id=" . $row['pc_id'] . " >";
        echo "<tr>";
        echo "<td>".$sn."</td>";$sn=$sn+1;
            echo "<td><a href='pc_disp.php?id=" . $row[pc_id] . "''>$row[sfid]</a></td>";
            echo "<td>PC</td>";echo "</tr>";
            /*
          echo "<div class='card blue-grey'>";
            echo "<div class='card-content white-text' >";
              echo "<span class='card-title' > Request for new PCs<br> </span>";
              echo "<h6> Number of new PCs required : $row[n_npc] </h6><br>";
              echo "$row[just]";
            echo "</div> ";
            */
          echo "</div>";
          echo "</a>";
            }
            if($row[opt]==5&&$row[help_desk]=='14co101'){ // helpdesk ID - 14co101
            echo "<a href='pc_disp.php?id=" . $row['sfid'] . "'>";
 echo "<div class='row  columns' id=" . $row['pc_id'] . " >";
        echo "<tr>";
        echo "<td>".$sn."</td>";$sn=$sn+1;
            echo "<td><a href='pc_disp.php?id=" . $row[pc_id] . "''>$row[sfid]</a></td>";
            echo "<td>PC</td>";echo "</tr>";
            /*
          echo "<div class='card blue-grey '>";
            echo "<div class='card-content white-text' >";
              echo "<span class='card-title' > Request for new PCs<br> </span>";
              echo "<h6> Number of new PCs required : $row[n_npc] </h6><br>";
              echo "$row[just]";
            echo "</div> ";          
          echo "</div>";
          */
          echo "</div>";
          echo "</a>";
        }

}




?>
</tbody>
</table>



   </body>
  <script>
   $(document).ready(function() {
    $('select').material_select();
});</script>
</html>