<?php
error_reporting(0);
include_once ('Classes/ComposerGenerator.php');
$objComposer = new ComposerGenerator();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Composer.json Generator For Your TYPO3 Extensions</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="Assets/app.css">
	<script type="text/javascript" src="Assets/app.js"></script>
</head>
<body>
	<form id="frmGenerateComposer" method="post" enctype="multipart/form-data" action="">
		<div class="container">
			<div class="row">
				<div class="col-md-12 joinComposerTYPO3">
					<a href="https://composer.typo3.org/" target="_blank"><img src="Assets/Composer.json-Generator-for-TYPO3-Extensions.jpg" title="Composer.json Generator for TYPO3 Extensions" alt="Composer.json Generator for TYPO3 Extensions" /></a>
					<!--<a class="pull-left" href="https://getcomposer.org/" target="_blank"><img src="Assets/Composer.json-Generator-for-TYPO3-Extensions.png" title="Composer.json Generator for TYPO3 Extensions" alt="Composer.json Generator for TYPO3 Extensions" height="80" /></a>
					<a href="#" class="joinPlus">+</a>
					<a href="https://composer.typo3.org/" target="_blank"><img src="Assets/TYPO3-logo.png" title="TYPO3-logo" alt="TYPO3-logo" height="100" /></a> -->
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="contact-form" class="form-container" data-form-container>
						<div class="row">
							<div class="form-title">								
								<h1>Composer.json Generator For Your TYPO3 Extensions</h1>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">				
					<div id="contact-form" class="form-container actionMainContainer" data-form-container>
						<div class="input-container">
							<div class="row headerContainer">
								<?php
								if($objComposer->invalidPHPFile == 'Yes') {
									?>
									<div class="col-md-12 invalidPHPFile">
										<h2>Invalid ext_emconf.php file!</h2>
										<button type="button" class="btn submit-form" onclick="window.location.href='';">Try again!</
									</div>
									<?php
								}
								else {
								?>
									<div class="col-md-3">
										<h2>Upload Your TYPO3 Extension's ext_emconf.php</h2>
										<div class="row submit-row">
											<input name="fileUploadEmconf" id="fileUploadEmconf" type="file" data-min-length="8" placeholder="Full Name" class="btn btn-block submit-form">
										</div>
									</div>
									<div class="col-md-2">
										<h1><br>OR</h1>
									</div>
									<div class="col-md-3">
										<h2>Create Composer for New TYPO3 Extension</h2>
										<div class="row submit-row">
											<button name="btnNewComposer" id="btnNewComposer" type="button" class="btn btn-block submit-form">Let's Create New Composer.json</button>
										</div>
									</div>
									<div class="col-md-1">
										<h1><br>OR</h1>
									</div>
									<div class="col-md-3">
										<h2>Download Sample TYPO3 Composer.json</h2>
										<div class="row submit-row">
											<button name="btnDownloadComposer" id="btnDownloadComposer" type="button" class="btn btn-block submit-form" onclick="window.location.href='index.php?downloadFile=Downloads/composer.json';">Download Composer.json Sample</button>
										</div>
									</div>
								<?php
								}
								?>
							</div>							
						</div>
					</div>				
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="contact-form" class="form-container createComposerContainer" data-form-container>
						<div class="input-container">
							<div class="row pull-right">
								<button type="button" class="close btnClose" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="row pull-left">
								<div class="form-separator">
									<?php
									if(!empty($objComposer->extensionName)) {
										echo "<h3>Your extension <strong>\"".$objComposer->extensionName."\"</strong></h3>";
									}
									else {
										echo "<h3>Extension's General Details</h3>";
									}
									?>									
								</div>
							</div>
							<input type="hidden" name="hiddedAction" id="hiddedAction" value="<?php echo $objComposer->hiddedAction; ?>">
							<div class="row">
								<span class="req-input" >
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter your TYPO3 extension key eg., news"> </span>
									<input value="<?php echo $objComposer->getPostData('txtName'); ?>" name="txtName" id="txtExtName1" type="text" data-min-length="3" placeholder="Enter your TYPO3 extension key eg., news" autofocus>
								</span>
							</div>
							<div class="row">
								<span class="req-input" >
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter your composer vendor and package name eg., georgringer/news"> </span>
									<input value="<?php echo $objComposer->getPostData('txtVendorPackage'); ?>" name="txtVendorPackage" type="text" data-min-length="5" placeholder="Enter your composer vendor and package name eg., georgringer/news">
								</span>
							</div>

							<div class="row pull-left">
								<div class="form-separator">
									<h3>Dependencies Management</h3>
								</div>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="TYPO3 Core Version Dependencies eg., 6.2.0-9.5.5"> </span>
									<input value="<?php echo $objComposer->getPostData('txtTYPO3Core'); ?>" name="txtTYPO3Core" type="text" data-min-length="5" placeholder="TYPO3 Core Version Dependencies eg., 6.2.0-9.5.5">
								</span>
							</div>						
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Autoload TYPO3 Classes eg., GeorgRinger\\News\\"> </span>
									<input value="<?php echo $objComposer->getPostData('txtAutoload'); ?>" name="txtAutoload" type="text" data-min-length="5" placeholder="Autoload TYPO3 Classes eg., GeorgRinger\\News\\">
								</span>
							</div>
							<div class="row">
								<div class="col-md-6 nopadding">
									<span class="req-input">
										<span class="input-status" data-toggle="tooltip" data-placement="top" title="Name of extension dependency eg., georgringer/news"> </span>
										<input value="<?php echo $objComposer->getPostData('txtExtName1'); ?>" name="txtExtName1" type="text" placeholder="Name of extension dependency eg., georgringer/news">
									</span>
								</div>
								<div class="col-md-6 nopadding nopadding-right">
									<span class="req-input">
										<span class="input-status" data-toggle="tooltip" data-placement="top" title="Version of extension dependency eg., >=3.0.0"> </span>
										<input value="<?php echo $objComposer->getPostData('txtExtVersion1'); ?>" name="txtExtVersion1" type="text" placeholder="Version of extension dependency eg., >=3.0.0">
									</span>
								</div>
							</div>
							
							<div class="row pull-left">
								<div class="form-separator">
									<h3>Author Details</h3>
								</div>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter Author's Name."> </span>
									<input data-min-length="3" value="<?php echo $objComposer->getPostData('txtAuthorName'); ?>" name="txtAuthorName" type="text" placeholder="Enter Author's Name.">
								</span>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter author's Email"> </span>
									<input value="<?php echo $objComposer->getPostData('txtAuthorEmail'); ?>" name="txtAuthorEmail" type="email" placeholder="Enter Author's Email">
								</span>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter Author's Role"> </span>
									<input value="<?php echo $objComposer->getPostData('txtAuthorRole'); ?>" name="txtAuthorRole" type="text" placeholder="Enter Author's Role">
								</span>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter Author's Website URL"> </span>
									<input value="<?php echo $objComposer->getPostData('txtAuthorURL'); ?>" name="txtAuthorURL" type="text" placeholder="Enter Author's Website URL">
								</span>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter Support/Tickets URL eg., Github, Github etc"> </span>
									<input value="<?php echo $objComposer->getPostData('txtSupport'); ?>" name="txtSupport" type="text" placeholder="Enter Support/Tickets URL eg., Github, Github etc)">
								</span>
							</div>

							<div class="row pull-left">
								<div class="form-separator">
									<h3>Other Details</h3>
								</div>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter license of your TYPO3 extension"> </span>
									<input value="<?php echo $objComposer->getPostData('txtLicense'); ?>" name="txtLicense" type="text" placeholder="Enter license of your TYPO3 extension eg., GPL-3.0">
								</span>
							</div>
							<div class="row">
								<span class="req-input">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter Comma (,) separated keywoards"> </span>
									<input value="<?php echo $objComposer->getPostData('txtKeywords'); ?>" name="txtKeywords" type="text" placeholder="Enter Comma (,) separated keywoards">
								</span>
							</div>
							<div class="row">
								<span class="req-input message-box">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Enter description of your extension"> </span>
									<textarea name="txtDescription" type="textarea" data-min-length="10" placeholder="Enter description of your extension"><?php echo $objComposer->getPostData('txtDescription'); ?></textarea>
							</div>
							<div class="row submit-row">
								<button name="btnCreateComposer" id="btnCreateComposer" type="submit" class="btn submit-form">Create & Download Composer.json</button>
								&nbsp; &nbsp;
								<button name="btnCloseComposer" id="btnCloseComposer" type="button" class="btn submit-form">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>