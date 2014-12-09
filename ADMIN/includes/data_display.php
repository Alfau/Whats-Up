<?php
require_once '../includes/paths.php';

if(isset($delete_status)){
	echo $delete_status;
}
if(isset($update_status)){
	echo $update_status;
}
if(isset($add_status)){
	echo $add_status;
}
?>
<table>
	<tr>
	<?php
	if(isset($data) && !empty($data)){
		foreach($data[0][0]as $key => $value){
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
		$array_length = count($data[0]);
		
		for($i=0;$i<$array_length;$i++){
			?>
			<tr>
			<?php
			foreach($data[0][$i] as $key => $value){
				if(!is_numeric($key)){
				?>
					<td><?php echo $value ?></td>
				<?php
				}
				?>
				<?php
				$id = $data[0][$i]['ID'];
			}
			?>
				<td>
					<a href="<?php echo URL::current()."edit/" . $id; ?>" class="edit">Edit</a>
				</td>
				<td>
					<a href="<?php echo URL::current() . "delete/" . $id; ?>" class="delete">Delete</a>
				</td>
			</tr>
			<?php
		}
	}else{
		?>
		<h4>This table is currently empty.</h4>
		<?php
	}
	?>
</table>