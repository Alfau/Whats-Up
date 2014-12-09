<?php 
session_start();

require_once "../includes/paths.php";

if(!isset($_SESSION['Username'])){
	header("Location:".URL::base()."/admin/login");
	exit();
}

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
			<?php
			if($key === "ID" || $key === "ResortID"){
				?>
				<input type="hidden" name='<?php echo $key ?>' value='<?php echo strip_tags($value) ?>'/>
				<?php
			}elseif($key === "Resort"){
				?>
				<td><?php echo $key ?></td>
				<td><input type='text' value='<?php echo strip_tags($value) ?>' disabled/></td>
				<input type="hidden" name='<?php echo $key ?>' value='<?php echo strip_tags($value) ?>'/>
				<?php
			}else{
				?>
				<td><?php echo $key ?></td>
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
