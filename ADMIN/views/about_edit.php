<?php
include("includes/header.php");
?>
<div class="wrapper">

<form method="POST" action="../update">
<table>
	<?php
	foreach($data[0][0] as $key => $value){
		if(!is_numeric($key)){
		?>
		<tr>
			<td><?php echo $key ?></td>
			<?php
			if($key === "ID"){
				?>
				<td><input type='text' value='<?php echo strip_tags($value) ?>' disabled/></td>
				<input type="hidden" name='<?php echo $key ?>' value='<?php echo strip_tags($value) ?>'/>
				<?php
			}else{
				?>
				<td><input type='text' name='<?php echo $key ?>' value='<?php echo strip_tags($value) ?>'/></td>
				<?php
			}
			?>
		</tr>
		<?php
		}
	}
	?>
	<tr>
		<td><input type="submit" value="Submit"/></td><td></td>
	</tr>
</table>
</form>

</div>
<?php
include("includes/footer.php");
?>
