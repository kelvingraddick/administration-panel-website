<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$search = $_POST['search'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Contracts</title>

	<link rel="stylesheet" href="https://sdk.ttcdn.co/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>

		<h3>Contracts</h3>

		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search contracts\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search contracts\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>

		<a href="edit.php" class="btn btn-default"><b>+</b> Add new contract</a>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>User</th>
					<th>Description</th>
					<th>Online Signing URL</th>
					<th>Signed?</th>
					<th>Signature</th>
					<th>Date Added</th>
					<th>Date Signed</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT c.id AS id, c.user_id AS user_id, code, c.description AS description, contract_url, signature_url, c.date_added AS date_added, date_signed, first_name, last_name, business_name, email, phone
							  FROM `contracts` AS c INNER JOIN `users` AS u ON u.id = c.user_id";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE
							code LIKE '$search' OR
							c.description LIKE '$search' OR
							contract_url LIKE '$search' OR
							c.id LIKE '$search' OR
							user_id LIKE '$search' OR
							first_name LIKE '$search' OR
							last_name LIKE '$search' OR
							business_name LIKE '$search' OR
							email LIKE '$search' OR
							phone LIKE '$search'";
					}
					$result = mysqli_query($c, $query) or die(mysql_error());
					while($u = mysqli_fetch_array( $result, MYSQL_ASSOC )) {
						echo
						"<tr>
							<td><a href=\"".$u["contract_url"]."\" target=\"_blank\">".$u["id"]."</a></td>
							<td>
								".$u["first_name"]." ".$u["last_name"]." (".$u["business_name"].")<br />
								".$u["email"]." &middot; ".$u["phone"]."
							</td>
							<td>".$u["description"]."</td>
							<td><a href=\"http://".$_SERVER['SERVER_NAME']."/sign/?code=".$u["code"]."\" target=\"_blank\">http://".$_SERVER['SERVER_NAME']."/sign/?code=".$u["code"]."</a></td>
							<td class=\"status\">"; if($u["signature_url"] <> "none") { echo "<span class=\"on\">"; } else { echo "<span class=\"off\">"; } echo "</span></td>
							<td><div style=\"width:220px;\">"; if($u["signature_url"] <> "none") { echo "<img src=\"".$u["signature_url"]."\" style=\"width:500px; position:absolute; clip: rect(0, 200px, 50px, 0);\" />"; } echo "</div></td>
							<td>".$u["date_added"]."</td>
							<td>".$u["date_signed"]."</td>
							<td>
								<a href=\"edit.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Edit</a>&nbsp;<a href=\"delete.php?id=".$u["id"]."\" class=\"btn btn-danger btn-sm\" style=\"display:inline;\" onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</a>
							</td>
						</tr>";
					}
				?>
			</tbody>
		</table>

		<br /><br />

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="https://sdk.ttcdn.co/tt-uikit-0.11.0.min.js"></script>
	<script src="https://sdk.ttcdn.co/tt.js"></script>
</body>
</html>
