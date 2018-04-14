<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
	$database_connection = connect_to_database();
	$setting = get_settings($database_connection);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $site_name ?> - Administration Panel</title>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/css/main.php'; ?>
	</head>
	<body>
		<div id="particles" class="background"></div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/navigation.php'; ?>
		<div id="page" class="page card">
			<div class="loading">Loading...</div>
		</div>
		<div id="image_upload_modal" class="modal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<form id="image_upload_form" method="POST" enctype="multipart/form-data">
					<header class="modal-card-head">
						<p class="modal-card-title">Image Upload</p>
						<button class="delete" aria-label="close" onclick="onImageUploadCloseClick(); return false;"></button>
					</header>
					<section class="modal-card-body">
						<div class="field">
							<label class="label">File Name</label>
							<div class="control">
								<input class="input" type="input" placeholder="File Name" name="name" value="" required>
							</div>
						</div>
						<div class="file has-name is-fullwidth">
							<label class="file-label">
								<input id="image_upload_file" class="file-input" type="file" name="file" required>
								<span class="file-cta">
									<span class="file-icon">
										<i class="fas fa-upload"></i>
									</span>
									<span class="file-label">
										Choose an image..
									</span>
								</span>
								<span id="image_upload_name" class="file-name"></span>
							</label>
						</div>
					</section>
					<footer class="modal-card-foot">
						<button class="button is-success" onclick="onImageUploadSaveClick(this); return false;">Upload</button>
						<button class="button" onclick="onImageUploadCloseClick(); return false;">Cancel</button>
					</footer>
				</form>
			</div>
		</div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/js/main.php'; ?>
	</body>
</html>