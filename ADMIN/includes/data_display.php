<table>
	<tr>
	<?php
	foreach($data[0] as $key => $value){
		if(!is_numeric($key)){
		?>
			<td><?php echo $key ?></td>
		<?php
		}
	}
	?>
	</tr>
	<?php
	$array_length = count($data);
	
	for($i=0;$i<$array_length;$i++){
		?>
		<tr>
		<?php
		foreach($data[$i] as $key => $value){
			if(!is_numeric($key)){
			?>
				<td><?php echo $value ?></td>
			<?php
			}
		}
		?>
		</tr>
		<?php
	}
	?>
</table>