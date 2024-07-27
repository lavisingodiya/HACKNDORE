<style>
.table td{
	text-align: left;
}
</style>

<?php include'db_connect.php';
     
	 $PropertyId = $_GET['proId'];
	$qry = $conn->query("SELECT
	`property`.`id`
   ,`property`.`Property`
   , `property`.`PropertyId`
   , `property`.`Location`
   , FORMAT(`property`.`ChargeableFee`,2) AS ChargeableFee
   , FORMAT(`property`.`BalanceBF`,2) AS BalanceBF
   , FORMAT(`property`.`AmountPayable`,2) AS AmountPayable
   , FORMAT(`property`.`AmountPaid`,2) AS AmountPaid
   , DATE_FORMAT(`property`.`DataRegistered`, '%d %M, %Y') AS date
   , FORMAT(`property`.`CurrentBalance`,2) AS CurrentBalance
   , `property`.`Description`
   , `property`.`PhysicalAddress`
   , `charge_group`.`ChargeGroupName`
   , `property`.`PropertyUse`
   ,`client`.`id` AS clientNum
FROM
   `client`
   LEFT JOIN `property` 
	   ON (`client`.`id` = `property`.`ClientId`)
   LEFT JOIN `charges` 
	   ON (`charges`.`ChargeDesc` = `property`.`ChargeGroup`)
   LEFT JOIN `charge_group` 
	   ON (`charges`.`ChargeGroup` = `charge_group`.`ChargeGroupCode`) WHERE `property`.`PropertyId` = '$PropertyId' AND client.id = '$SessionId' ");
	$row= $qry->fetch_assoc();
?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
<table style="width: " class="table">
<tr><th>Tax ID#</th><td><?php  echo $row['PropertyId'];?></td></tr>
<tr><th>Tax</th><td><?php echo $row['Property'];?></td></tr>
<tr><th>Tax USE</th><td><?php echo $row['PropertyUse'];?></td></tr>
<tr><th>DATE REGISTERED</th><td><?php echo $row['date'];?></td></tr>
<tr><th>Tax VALUE</th><td>₹ <?php echo $row['ChargeableFee'];?></td></tr>
<!-- <tr><th>BALANCE BF</th><td>₹ <?php echo $row['BalanceBF'];?></td></tr> -->
<tr><th>AMOUNT DUE</th><td>₹ <?php echo $row['AmountPayable'];?></td></tr>
<tr><th>AMOUNT CLEARED</th><td>₹ <?php echo $row['AmountPaid'];?></td></tr>
<tr><th>CURRENT AMOUNT DUE</th><td>₹ <?php echo $row['CurrentBalance'];?></td></tr>
<!-- <tr><th>Tax LOCATION</th><td><?php echo $row['Location'];?></td></tr>
<tr><th>PHYSICAL ADDRESS</th><td><?php echo $row['PhysicalAddress'];?></td></tr>
<tr><th>Tax DESC.</th><td><?php echo $row['Description'];?></td></tr> -->
</table>
		<!-- d:\rates\rates\property_details.php -->
		</div>
	</div>
</div>