<?php

  $data = array();
  function add_person($first, $middle, $last,$gender, $fathername, $dob, $email, $mobile, $amobile,	$landline,	$country,$state,$city,$address1,			
			 $address2,	$address3,$pincode,$course,$yaddmission,$ypassing,$university,$college,$pover,$pfirst,$psecond,$pthird,$pfourth,$phonors )
  {
  global $data;
  
  $data []= array(
			'first' => $first,
			'middle' => $middle,
			'last' => $last,
			'gender' => $gender,
			'fathername' => $fathername,
			'dob' => $dob,
			'email' => $email,
			
			'mobile' => $mobile,
			'amobile' => $amobile,
			'landline' => $landline,
			'country' => $country,
			'state' => $state,
			'city' => $city,
			'address1' => $address1,
			
			
			'address2' => $address2,
			'address3' => $address3,
			'pincode' => $pincode,
			'course' => $course,
			'yaddmission' => $yaddmission,
			'ypassing' => $ypassing,
			'university' => $university,
			
			
			'college' => $college,
			'pover' => $pover,
			'pfirst' => $pfirst,
			'psecond' => $psecond,
			'pthird' => $pthird,
			'pfourth' => $pfourth,
			'phonors' => $phonors
			
   
  );
  }
  
  
  
  if(isset($_POST['submit'])){
  if ( $_FILES['sheet']['tmp_name'] )
		  {
		  $dom = DOMDocument::load( $_FILES['sheet']['tmp_name'] );
		  $rows = $dom->getElementsByTagName( 'Row' );
		  $first_row = true;
		  foreach ($rows as $row)
		  {
		  if ( !$first_row )
		  {
		    'first' = "";
			'middle' = "";
			'last' = "";
			'gender' = "";
			'fathername' = "";
			'dob' = "";
			'email' = "";
			
			'mobile' = "";
			'amobile' = "";
			'landline' = "";
			'country' = "";
			'state' = "";
			'city' = "";
			'address1' = "";
			
			
			'address2' = "";
			'address3' = "";
			'pincode' = "";
			'course' = "";
			'yaddmission' = "";
			'ypassing' = "";
			'university' = "";
			
			
			'college' = "";
			'pover' = "";
			'pfirst' = "";
			'psecond' = "";
			'pthird' = "";
			'pfourth' = "";
			'phonors' = ""
		  
		  $index = 1;
		  $cells = $row->getElementsByTagName( 'Cell' );
		  foreach( $cells as $cell )
		  { 
		  $ind = $cell->getAttribute( 'Index' );
		  if ( $ind != null ) $index = $ind;
		  
		  if ( $index == 1 ) $first = $cell->nodeValue;
		  if ( $index == 2 ) $middle = $cell->nodeValue;
		  if ( $index == 3 ) $last = $cell->nodeValue;
		  if ( $index == 4 ) $gender = $cell->nodeValue;
		  
		   if ( $index == 5 ) $fathername = $cell->nodeValue;
		  if ( $index == 6 ) $dob = $cell->nodeValue;
		  if ( $index == 7 ) $email = $cell->nodeValue;
		  if ( $index == 8 ) $mobile = $cell->nodeValue;
		  
		   if ( $index == 9 ) $amobile = $cell->nodeValue;
		  if ( $index == 10 ) $landline = $cell->nodeValue;
		  if ( $index == 11 ) $country = $cell->nodeValue;
		  if ( $index == 12 ) $state = $cell->nodeValue;
		  if ( $index == 13 ) $city = $cell->nodeValue;

		   if ( $index == 14 ) $address1 = $cell->nodeValue;
		  if ( $index == 15 ) $address2 = $cell->nodeValue;
		  if ( $index == 16 ) $address3 = $cell->nodeValue;
		  if ( $index == 17 ) $pincode = $cell->nodeValue;
		  
		   if ( $index == 18 ) $course = $cell->nodeValue;
		  if ( $index == 19 ) $yaddmission = $cell->nodeValue;
		  if ( $index == 20 ) $ypassing = $cell->nodeValue;
		  if ( $index == 21 ) $university = $cell->nodeValue;
		  
		   if ( $index == 22 ) $college = $cell->nodeValue;
		  if ( $index == 23 ) $pover = $cell->nodeValue;
		  if ( $index == 24 ) $pfirst = $cell->nodeValue;
		  if ( $index == 25 ) $psecond = $cell->nodeValue;
		  
		   if ( $index == 26 ) $pthird = $cell->nodeValue;
		  		   if ( $index == 27 ) $pfourth = $cell->nodeValue;

		   if ( $index == 28 ) $phonors = $cell->nodeValue;

		  
		  $index += 1;
		  }
		  add_person(  $first, $middle, $last,$gender, $fathername, $dob, $email, $mobile, $amobile,	$landline,	$country,$state,$city,$address1,			
			 $address2,	$address3,$pincode,$course,$yaddmission,$ypassing,$university,$college,$pover,$pfirst,$psecond,$pthird,$pfourth,$phonors);
		  }
		  $first_row = false;
		  }
		  }
		  
}		  
  ?>
  <html>
  <body>
  <table>
  <tr>
  <th>First</th>
  <th>Middle</th>
  <th>Last</th>
  <th>Email</th>
  </tr>
  <?php foreach( $data as $row ) { ?>
  <tr>
            <td><?php echo( $row['first'] ); ?></td>
            <td><?php echo( $row['middle'] ); ?></td>
            <td><?php echo( $row['last'] ); ?></td>
            <td><?php echo( $row['gender'] ); ?></td>
            <td><?php echo( $row['fathername'] ); ?></td>
            <td><?php echo( $row['dob'] ); ?></td>
            <td><?php echo( $row['email'] ); ?></td>
            <td><?php echo( $row['mobile'] ); ?></td>
            <td><?php echo( $row['amobile'] ); ?></td>
            <td><?php echo( $row['landline'] ); ?></td>
            <td><?php echo( $row['country'] ); ?></td>
            <td><?php echo( $row['state'] ); ?></td>
            <td><?php echo( $row['city'] ); ?></td>
            <td><?php echo( $row['address1'] ); ?></td>
            <td><?php echo( $row['address2'] ); ?></td>
            <td><?php echo( $row['address3'] ); ?></td>
            <td><?php echo( $row['pincode'] ); ?></td>
            <td><?php echo( $row['course'] ); ?></td>
            <td><?php echo( $row['yaddmission'] ); ?></td>
            <td><?php echo( $row['ypassing'] ); ?></td>
            <td><?php echo( $row['university'] ); ?></td>
            <td><?php echo( $row['college'] ); ?></td>
            <td><?php echo( $row['pover'] ); ?></td>
            <td><?php echo( $row['pfirst'] ); ?></td>
            <td><?php echo( $row['psecond'] ); ?></td>
            <td><?php echo( $row['pthird'] ); ?></td>
            <td><?php echo( $row['pfourth'] ); ?></td>
            <td><?php echo( $row['phonors'] ); ?></td>
  
  </tr>
  <?php } ?>
  </table>
  </body>
  </html>