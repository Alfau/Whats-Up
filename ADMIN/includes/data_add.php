<form method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>/add">
<table>
	<?php
	if(isset($data) && !empty($data)){
		foreach($data[0] as $key => $value){
			if(!is_numeric($key)){
				if($key !== "ID"){
			?>
				<tr><td><?php echo $key ?> :</td></tr>
				<tr><td><input type="text" name="<?php echo $key ?>"/></td></tr>
			<?php
				}
			}
			?>
			<?php
		}
		?>
		<tr>
			<td><input type="submit" value="Submit"/></td>
		</tr>
	<?php	
	}else{
		?>
		<h4>This table is currently empty.</h4>
		<?php
	}
	?>
</table>
</form>