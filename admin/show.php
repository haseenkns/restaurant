<?php
  $data = array();
  function add_person($first, $middle, $last,$gender, $fathername, $dob, $email, $mobile, $amobile,	$landline,	$country,$state,$city,$address1,			
			 $address2,	$address3,$pincode,$course,$yaddmission,$ypassing,$university,$college,$pover,$pfirst,$psecond,$pthird,$pfourth,$phonors )
  {
  global $data;
  $data[]= array(
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
 		  
  ?>
  <html>
  <body>
  <table width="100%" cellpadding="8" cellspacing="0" bgcolor="#F8F8F8"  style="border:#993300">
  <tr style="background:#0099FF;color:#FFFFFF;">
<th>first</th><th>middle</th><th>last</th><th>gender</th><th>fathername</th><th>dob</th><th>email</th><th>mobile</th><th>amobile</th><th>landline</th><th>country</th><th>state</th><th>city</th><th>address1</th><th>address2</th><th>address3</th><th>pincode</th><th>course</th><th>yaddmission</th><th>ypassing</th><th>university</th><th>college</th><th>pover</th><th>pfirst</th><th>psecond</th><th>pthird</th><th>pfourth</th><th>phonors</th>
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