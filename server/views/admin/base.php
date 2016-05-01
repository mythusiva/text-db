<!DOCTYPE html>
<html>
<head>
	<title><?=$this->e($pageTitle)?></title>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
	  
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>  

	<div class="row">
		<div class="col s3">
			<ul id="side-menu" class="">
		      <li><a href="#!">Overview</a></li>
		      <li><a href="#!">Catalogues</a></li>
		      <li><a href="#!">Messages</a></li>
		      <li><a href="#!">Settings</a></li>
		    </ul>
		</div>
		<div class="col s9">
			<div>
		    	<?=$this->section('content')?>
		    </div>
		</div>
    </div>

</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
});
</script>