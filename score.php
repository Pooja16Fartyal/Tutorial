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
if(isset($_GET['uname'])){
  $_SESSION['name'] = $_GET['uname'];
};


?>
<div class="container" data-ng-app="" data-ng-init="x">
    <div class="row">
        <div class="col-md-5 col-md-offset-6">
            <div class="panel panel-default" id="scorePanel">
                <div class="panel-heading"> <strong class="">Quick Fast <?php echo  $_SESSION['name'];?>!!</strong>

                </div>
                <div class="panel-body" >
                    <form class="form-horizontal" role="form" action="info.php" method='post' name="myForm" >
                       <div class="form-group">
                            <label id="timer" for="" class="col-sm-12 control-label" style="text-align:center;">10 Seconds</label>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label" >Score</label>
                            <div class="col-sm-8">
                                <input class="form-control"  value="{{x}}" placeholder="Score" readonly name="score">
                            </div>
                        </div>
                       
                        <div class="form-group ">
                            <div class="col-sm-offset-4 col-sm-9">
                                <button type="button" id="click" data-ng-click="x=x+1" class="btn btn-success btn-sm">Click Me</button>
                                
                            </div>
                        </div>
                        <hr>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="name"  disabled="disabled" placeholder="UserName" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mobile Number</label>
                            <div class="col-sm-8">
                                <input class="form-control" disabled="disabled" id="mobile" placeholder="Mobile Number"  type="text" name="mobile">
                            </div>
                        </div>
                       
                        <div class="form-group last">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button id="final" type="submit" class="btn btn-success btn-sm" disabled="disabled" name="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                </div>
              </div>
                
          </div>
    </div>
   </div>
</body>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
<script>
$('document').ready(function(){
  
var counter = 10;
var interval = setInterval(function() {
  if(counter){
    counter--;
    $('#timer').text(counter + ' Seconds');
    if (counter < 1) {
      
       $('#final,#name,#mobile').prop('disabled',false);
       $('#click').prop('disabled',true);
       
        
    }
  }
    
}, 1000);


 $(".form-horizontal").validate({
  rules:
  {
   username:{required: true},
   mobile:{ phoneValidation:true},
  },
 messages:
 {
   username:{required: "<div style='color:#cc2424; font-weight:500'>You can't leave this empty.</div>"},
 },
 submitHandler: function (form)
 {
      this.submit();
 }
});
$.validator.addMethod("phoneValidation", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, ""); 
	return this.optional(element) || phone_number.length > 9 &&
		phone_number.match(/^(0-?)?(\([1-9]\d{2}\)|[1-9]\d{2})-?[0-9]\d{2}-?\d{4}$/);
}, "<div style='color:#cc2424; font-weight:500'>Please specify a valid phone number.</div>");


});
</script>