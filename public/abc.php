<?php

	$servername = "localhost";
	$username = "ecogreenapp";
	$password = "Ecogreen@app8888";
	$db = "Admin_Portal";
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password,$db);
	
	// Check connection
	if (!$conn) {
	   die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT order_id, attachment FROM homes_orders ORDER BY order_id ASC";
	// echo $sql2;
	$stmt = mysqli_query($conn, $sql);
		
	$attachment = array();
	// $i = 0;
	
	while($row = mysqli_fetch_assoc($stmt)){
		$attachment[] = $row;
	}	
	
	// foreach($attachment as $index){
		
	// 	echo "Order ID = " . $index['order_id'] . "<Br>Attachment = ".$index['attachment']."<br>";
		
	// }
	
	$sql2 = "SELECT photo_id, photo FROM homes_photos ORDER BY photo_id ASC";
	
	$stmt2 = mysqli_query($conn, $sql2);
	
	$image = array();
	// $j = 0;
	
	while($row = mysqli_fetch_assoc($stmt2)){
		// $image[$j]['value'] = $row['value'];
		// $image[$j]['name'] = $row['name'];
		// $j++;
		$image[] = $row;
	}
	
	// foreach($image as $photo){
	// 	echo $i . " . ";
	// 	echo $j . " + ";	
	// 	// echo "photo_id = " . $photo['photo_id'] . " + photo = " . $photo['photo'] . "<br>";
		
	// 	foreach($attachment as $index){
		
	// 		// echo "Order ID = " . $index['order_id'] . " + Attachment = ".$index['attachment']."<br>";
	// 		if($photo['photo'] === $index['attachment']){
	// 			echo "Photo ID = " . $photo["photo_id"] . "<br>";
	// 			$j++;
	// 		}
	// 	}

	// 	$i++;
	// }
	// $result=array_intersect($image, $attachment);
	// print_r($result);
	// echo "Same data = " . $j;
	
	for($i = 0; $i<count($attachment); $i++){
		
		echo "<br>Order ID: " .$attachment[$i]['order_id'];

		// foreach($image as $photos){
			$array = array();

			$array = explode(", ", $attachment[$i]['attachment']);

			// if($attachment[$i]['attachment'] === $photos['photo']){
			// 	echo " = " . $photos['photo_id'] ;
			// }
			foreach($array as $key => $value){

			}
			// if(strpos($photos['photo'], ",") == true){
			// 	$array = array();
				

				// foreach($array as $data){
					// echo $data;
				// }
			// }
			
		// }
	}
	// for($k=0; $k<count($array2); $k++)
	// {
	// 	$result = array_intersect($array1, $array2);
	// 	print_r($result);
	// 	if(array_intersect($array1[$k], $array2){
	// 		echo $array1[$k];
	// 	}
	// }
	
?>