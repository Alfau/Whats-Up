</pre>
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>/add" id="add">
<table>
	<?php
	if(isset($data)){
		foreach($data[0][0] as $key => $value){
			if(!is_numeric($key)){
				if($key !== "ID" && $key !== "ResortID"){
			?>
				<tr><td><?php echo $key ?> :</td></tr>
				<?php
					if($key === "Resort"){
						?>
						<tr>
							<td>
								<select name="<?php echo $key ?>">
									<?php
									$array_length = count($data[1]);
									for ($i=0; $i < $array_length; $i++) {
										foreach($data[1][$i] as $resort){
										?>	
											<option value="<?php echo $resort ?>"><?php echo $resort ?></option>
										<?php
										}
									}
									?>
								</select>
							</td>
						</tr>
						<?php
					}else{
						?>
						<tr><td><input type="text" name="<?php echo $key ?>"/></td></tr>
						<?php
					}
				?>
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
	}
	?>
</table>
</form>