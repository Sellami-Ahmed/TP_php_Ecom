<?php

// Create connection
require_once "../DBconnect.php";
$sql = "SELECT produits.code,produits.designation,produits.Prix,produits.Quantite,categories.name FROM produits JOIN categories on produits.code_categorie = categories.code WHERE designation LIKE '%".$_POST['name']."%'";

	$result = $pdo->query($sql);
									if ($result->rowCount()>0) {
									
									// read data of each row
									while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
										echo "<tr>
	<th scope='row'>
		<div class='p-2'>
			<img src='inc/images/$row[designation].jpg' alt='' width='70' class='img-fluid rounded shadow-sm'>
			<div class='ml-3 d-inline-block align-middle'>
				<h5 class='mb-0'><a href='#' class='text-dark d-inline-block'>$row[designation]</a></h5><span class='text-muted font-weight-normal font-italic'>Category: $row[name]</br>ID:$row[code]</span>
			</div>
		</div>
	</th>
	<td class='align-middle' align='center'><strong>$$row[Prix]</strong></td>
	
	<td class='align-middle' align='center'><strong>$row[Quantite]</strong></td>
	<td class='align-middle' align='center'><a href='crudProduit.php?code=$row[code]&event_id=2' class='text-dark'><i class='fa fa-edit'></i></a>
	</td>
	<td class='align-middle' align='center'><a href='crudProduit.php?code=$row[code]&event_id=1' class='text-dark'><i class='fa fa-trash'></i></a>
	</td>
</tr>";
									}}

else{
	echo "<tr><td >0 result's found</td></tr>";
}

?>