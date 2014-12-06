<table>
	<tr>
	<?php
	foreach($data[0] as $key => $value){
		if(!is_numeric($key)){
		?>
			<td><?php echo $key ?></td>
		<?php
		}
		?>
		<?php
	}
	?>
		<td>Edit</td>
		<td>Delete</td>
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
			?>
			<?php
			$id = $data[$i]['ID'];
		}
		?>
			<td>
				<a href="<?php echo $_SERVER['REQUEST_URI'];?>/edit/<?php echo $id ?>" class="edit">Edit</a>
			</td>
			<td>
				<a href="<?php echo $_SERVER['REQUEST_URI'];?>/delete/<?php echo $id ?>" class="delete" id="<?php echo $id ?>">Delete</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>