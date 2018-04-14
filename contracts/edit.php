<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$user_id = $_GET['user_id'];
	$result = mysqli_query($c, "SELECT * FROM contracts WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find contract by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit Contract</title>

	<link rel="stylesheet" href="https://sdk.ttcdn.co/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>

		<header>
		  <a href="../contracts/" class="btn btn-link">&larr; Go back to contracts</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add New Contract";
				} else {
					echo "Edit Contract";
				}
			?>
		  </h3>
		</header>

		<form class="form-grouped" action="submit.php" method="post" data-validate>
		  <?php if($id <> "") { echo '<input type="hidden" name="id" value="'.$u["id"].'" />'; } ?>
		  <fieldset>
			<legend>Contact</legend>
			<div class="row form-group">
			  <div class="col-md-4 col-xs-4">
				<label>User Id</label>
				<input class="form-control" type="text" name="user_id" <?php if($user_id <> "") { echo 'value="'.$user_id.'"'; } else { echo 'value="'.$u["user_id"].'"'; } ?> required>
				<span class="help-block">The user id of the client this contract is for. Look in the <b>Clients tab</b> for user ids or to enter in a new client.</span>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Description</label>
				<input class="form-control" type="text" name="description" <?php echo 'value="'.$u["description"].'"'; ?> required>
				<span class="help-block">A description of the contract.</span>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Contract URL</label>
				<input class="form-control" type="text" name="contract_url" <?php echo 'value="'.$u["contract_url"].'"'; ?> required>
				<span class="help-block">The url where the contract is being held. For example, a <b>Google Docs link</b> or <b>embed url</b>.</span>
			  </div>
			</div>
		  </fieldset>
		  <div class="form-actions">
			<a href="../contracts/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>

		<br />

		<iframe style="width:75%; height:900px;" frameBorder="0" seamless="seamless" src="https://docs.google.com/document/d/1dhJqr5FXJGf8bbJoiaMsklFMlgymxJGKEom0UNAs39k/pub?embedded=true"></iframe>

		<br /><br />

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="https://sdk.ttcdn.co/tt-uikit-0.11.0.min.js"></script>
	<script src="https://sdk.ttcdn.co/tt.js"></script>
	<script>
	  $(function() {
		$( "#date_added" ).datepicker();
		//$( "#date_last_contacted" ).datepicker();
	  });
	</script>
</body>
</html>
