<option value="">Select a Size</option>
<?php
	@dd($colorArrays);
	if (isset($_POST['state'])) 
		$state=$_POST['state'];
		$conn=mysqli_connect('localhost','root','admin123',"employee");
		$select = "SELECT S_Id FROM state WHERE S_Name = '$state'";
		$select_result = mysqli_query ($conn, $select);

		while($rows = mysqli_fetch_array($select_result)){
			$s_id = $rows['S_Id'];
		}
		$selectCity = "SELECT * FROM citys WHERE S_Id = '$s_id'";
		$cityResults = mysqli_query ($conn, $selectCity);
		while($rows1 = mysqli_fetch_array($cityResults))
?>

		<option value="<?php echo $rows1['C_Name'];?>"><?php echo $rows1['C_Name'];?></option>
@php
	
@endphp
