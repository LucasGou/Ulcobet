<html>
<head>
<?php
	if(isset($title)) echo "<title>$title</title>\n";
	if(isset($css)) echo"<link rel=stylesheet type=text/css href='$css'/>";
	
?>
</head>
<body>
<?php echo $body; ?>
</body>
</html>

