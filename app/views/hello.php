<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
	<script src="js/jquery.js" type="text/javascript"></script>
</head>
<body>
    <div id="testA">
	</div>
	<div id="testB">
		
	</div>
	<div id="js_test">
	</div>
	<div id="div_test">
	</div>
	</body>
</html>



<script>
	jQuery(document).ready(function() {
		$.post('../Temp/'+ <?php echo $tid?>, function(data){
			document.getElementById('div_test').innerHTML=data;
		});
		
		<?php 
		$str = "";
		$str2 = "";
		$count = 0;
		foreach($mids as $mid){
			$str .= "$.post('".$mid->path."/0', function(data){";
			$str.="	var script = document.createElement('script');";
			$str.="	script.type = 'text/javascript';";
			$str.="	script.text = data;";
			$str.="	$('body').append(script);";
			$str.="});";
			
			$str2 .= "$.post('".$mid->path."/1', function(data){";
			$str2 .= "document.getElementById('div_".$count."').innerHTML=data;";
			$str2 .= "});";

		}
		echo $str;
		echo $str2;
		?>
	});
</script>

