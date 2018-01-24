
<!DOCTYPE html>
<html>
<head>
<title>Score Board</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/angular.min.js"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php 
error_reporting(0);
$mysqli = new mysqli('localhost', 'root', '', 'pooja');
if ($mysqli->connect_error) {
    $msg = 'Connect Error (' . $mysqli->connect_errno . ')'. $mysqli->connect_error;
}else{
	$sql = "CREATE TABLE IF NOT EXISTS tblUser
				(
				ID int NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(ID),
				name VARCHAR(50),
				score INT,
				mobile BIGINT,
				timestamp TIMESTAMP NOT NULL
				)";
		$mysqli->query($sql);
		if(!$mysqli->query($sql)){
			$msg =  $mysqli->error;
		}
		
	if(isset($_POST['submit'])){
		$data = array('name' => !empty($_POST['username'])?$_POST['username']:"NULL",
					  'score' => !empty($_POST['score'])?$_POST['score']:0,
					  'mobile' => !empty($_POST['mobile'])?$_POST['mobile']:"NULL");
		$insert = 'INSERT INTO tblUser (name,score,mobile) VALUES ("'.$data['name'].'",'.$data['score'].','.$data['mobile'].')';
		$mysqli->query($insert);
	}	
	$data = $mysqli->query('SELECT * FROM tblUser ORDER BY  score desc LIMIT 10');
 }

?>
<div class="container">
  <div class="col-md-7 col-md-offset-2">
 <div class="panel panel-default" id="scorePanel">
   <div class="panel-heading"  style="color:cadetblue;font-size:large"> <strong class="">Thankyou</strong>

   </div>
   
<div class="panel-body" >
 <?php 
   if(isset($msg)){
		echo $msg;
   }else{?>
   
 
  <div class="form-group">
     <label id="timer" for="" class="col-sm-12 control-label" style="text-align:center;color:cadetblue;font-size:large">Top Score Board</label>
   </div>

<table class="table">
   <thead class="thead-default">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th>Mobile Number</th>
      <th>Score</th>
    </tr>
  </thead>
  <tbody>
 <?php 
   if(isset($msg)){
		echo $msg;
   }else{
	 if($data->num_rows < 1){
		$msg =  '';
		echo '<tr><td colspan="4" style="text-align:center">No Record Found</td></tr>';
	  }
		$i =1;
		while ($row = $data->fetch_assoc()) {
			echo '<tr><td>'.$i++.'</td><td>'.ucwords($row['name']).'</td><td>'.$row['mobile'].'</td><td>'.$row['score'].'</td></tr>';
		}
  
   }
   
?>
      
    
  </tbody>
</table>  
   <?php }?>
                </div>
                <div class="panel-footer">
                </div>
              </div>
                   </div> 
          </div>
</body>