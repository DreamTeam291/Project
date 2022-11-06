<?php 
include('config.php');
include('header.php');
// action varible for using insert update and delete opretion which retrive from query string
$action = "";
if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
}
?>
<!--start of header name-->
 <h1 class="h3 mb-4 text-gray-800">technology_details</h1>
 <!--end of header name-->
        <?php
//Start of insert opretion
if(isset($_REQUEST['save']))
{
	//start of of varibale and value setting
	$id  = $_REQUEST['id'];
	$user_code = $_REQUEST['user_code'];
	$experience_type   = $_REQUEST['experience_type'];
	$experience_detail   = $_REQUEST['experience_detail'];
	
  //end of of varibale and value setting
	//start of typing  query
	$query = "INSERT INTO `technology_details`(`id`, `user_code`, `experience_type`, `experience_detail`) VALUES ('$id','$user_code','$experience_type','$experience_detail')";  
	//end of typing the query
  $message=iud_data($query);
  if($message=="sucess"){
		echo"<script>alert('data saved successfully ')</script>";
		echo"<script>window.location='technology_details.php'</script>";
	}
  else
  {
		echo"<script>alert('data Not  saved successfully ')</script>";
	}
}
//end of insert operation
//for Update opretion
if(isset($_REQUEST['edit'])){
	$id  = $_REQUEST['id'];
	$user_code = $_REQUEST['user_code'];
	$experience_type   = $_REQUEST['experience_type'];
	$experience_detail   = $_REQUEST['experience_detail'];
  //end of of varibale and value setting
  //start of typing  query
	$query = "UPDATE `technology_details` SET `id`='$id',`user_code`='$user_code',`experience_type`='$experience_type',`experience_detail`='$experience_detail'";  
  // end of typing  query
	$message=iud_data($query);
  if($message=="sucess"){
		echo"<script>alert('data saved successfully ')</script>";
		echo"<script>window.location='technology_details.php'</script>";
	}else{
		echo"failed ".mysql_error();
	}
}
//for Delete opretion
if($action == 'delete'){
	$id   = $_REQUEST['id'];
	//start of typing  query
	$query = "delete from technology_details where id='$id'";  
  //end of typing  query
	$message=iud_data($query);
  if($message=="sucess"){
		echo"<script>alert('data deleted successfully ')</script>";
		echo"<script>window.location='technology_details.php'</script>";
	}else{
		echo"<script>alert('failed to delete')</script>";
	}
}

?>

<div class="container">
  
  <?php if($action == 'edit' or $action == 'add' ){ 
          $id = $_REQUEST['id'];
        //start of typing  query
		  $query ="select * from technology_details where id='$id'";
      //end of typing  query
      $result = mysqli_query($conn, $query);
          $data = mysqli_fetch_assoc($result)
  ?>
  <form method="post" >
  <!-- start of updataion of the form field and database fields-->
                  
  <table class="table table-striped table-bordered table-hover">
  <tr>
  <td align="right"><b>id</b></td>
  <td>
   <input type="text" name="id" id="name" class="form-control" value="<?php if($action=="edit"){ echo $data['id'];}else {echo "";} ?>" placeholder="id" required="required" autofocus="autofocus">
  </td>
  </tr>
  <tr>
  <td align="right"><b>User_code</b></td>
  <td>
  <input type="text" name="user_code" class="form-control" value="<?php if($action=="edit"){echo $data['user_code'];}else{echo "";} ?>"  required="required">
  </td>
  </tr>
  <tr>
  <td align="right"><b>experience_type<b></td>
  <td>
   <input type="text" name="experience_type" class="form-control" value="<?php if($action=="edit"){ echo $data['experience_type'];} else { echo "";} ?>" required="required">
   </td>
  </tr>
  <tr>
  <td align="right"><b>experience_detail<b></td>
  <td>
   <input type="text" name="experience_detail" class="form-control" value="<?php if($action=="edit"){ echo $data['experience_detail'];} else { echo "";} ?>"  required="required">
   </td>
  </tr>
  </tr>
  <td colspan="2" align="center">
  <?php
  if($action=="edit")
  {
  ?>
  <button type="submit" class="btn btn-success" name="edit" >Save</button>
  <?php
  }
  else
  {
	?>
    <button type="submit" class="btn btn-success" name="save" >Save</button>
    <?php  
  }
  ?>
  </td>
  </tr>
  </table>
  </form>

  <!-- end of updataion of the form field and database fields-->
  <?php
  ?>
		
  <?php }else{ ?>
		  <center><a href="technology_details.php?action=add&id=0" class="btn btn-primary">Insert</a></center>
		  <br />
          <table  id="example2" class="table table-bordered table-hover">
          <tr>
           <td colspan="6" align="right">
            <input type="button" id="btnExport" value="Download As PDF" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#example1')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("userdetail.pdf");
                }
            });
        });
    </script>
          </td>
          </tr>
          </table>
		  <table  id="example1" class="table table-bordered table-hover">
			<thead>
			  <tr>
<!-- start of table header change-->
			<th>id</th>
			<th>user_code</th>
			<th>experience_type</th>
			<th>experience_detail</th>
			
      <!-- End of table header change-->
			  </tr>
			</thead>
			<tbody>
			<?php
       //start of typing  query
		$query  = "select * from technology_details order by id desc";
    //En of typing  query
$result = mysqli_query($conn,$query);
  while($data = mysqli_fetch_assoc($result))
		{
			?>
			  <tr>
          <!-- start of Changing database variable-->
			  <td><?php echo $data["id"]; ?></td>
			<td><?php echo $data["user_code"]; ?></td>
			<td><?php echo $data["experience_type"]; ?></td>
			<td><?php echo $data["experience_detail"]; ?></td>    
			<td>
			<a href="technology_details.php?action=edit&id=<?php echo $data["id"]; ?>" class="btn btn-success">Edit</a>
			<a href="technology_details.php?action=delete&id=<?php echo $data["id"]; ?>" class="btn btn-danger" onClick="return confirm('are you soure want to delete this')" >Delete</a>
			</td>
      <!-- end of Changing database variable-->
			  </tr>
			  <?php 	
		}
		?>
			</tbody>
		  </table>
  <?php } ?>
  
</div>
<?php
include('footer.php');
?>