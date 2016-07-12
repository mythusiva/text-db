<!DOCTYPE html>
<html>
<head>
	<title><?=$this->e($pageTitle)?></title>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"> -->

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	  
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<style type="text/css">
.side-menu-heading {
	font-weight: bold;
	/*border-bottom: 1px solid #eee;*/
	font-size: 14px;	
}
</style>

</head>
<body class="orange lighten-5">  

	<div class="container">
		<div class="row">
			<div class="col-xs-2">
				<br/>
				<br/>
				<br/>
				<br/>
				<ul class="nav nav-pills nav-stacked">
					<li class="side-menu-heading"><h4>General</h4></li>
					<li class="<?=($menuActive==='overview')?'active':''?>" role="presentation"><a href="/admin.php">Overview</a></li>
					<li class="<?=($menuActive==='settings')?'active':''?>" role="presentation"><a href="#">Settings</a></li>
					<li class="side-menu-heading"><h4>Catalogue</h4></li>
					<li class="<?=($menuActive==='catalogue-add')?'active':''?>" role="presentation"><a href="/admin.php/catalogue">Create catalogue</a></li>
					<li class="<?=($menuActive==='catalogue-edit')?'active':''?>" role="presentation"><a href="#">Edit catalogue</a></li>
					<li class="side-menu-heading"><h4>Message</h4></li>
					<li class="<?=($menuActive==='message-add')?'active':''?>" role="presentation"><a href="/admin.php/message">Create message</a></li>
					<li class="<?=($menuActive==='message-edit')?'active':''?>" role="presentation"><a href="#">Edit message</a></li>
				</ul>
			</div>
			<div class="col-xs-10">
				<div>
			    	<?=$this->section('content')?>
			    </div>
			</div>
		</div>			
    </div>

</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
});
</script>