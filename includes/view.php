<?php  

class View{
	
	function render($viewFile, $requirements){
		
		extract($requirements);
		
		include("views/$viewFile.php");
	}
	
}

?>