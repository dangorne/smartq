<!DOCTYPE html>
<html lang="en">
	<head>
		<title> Smart Queue</title>
		<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand glyphicon glyphicon-flag" href="<?php echo site_url(''); ?>"> SmartQueue</a>
	    </div>

	    <ul class="nav navbar-nav navbar-right">

				<li><a href="<?php echo site_url(''); ?>"><span class="glyphicon glyphicon-edit"></span> <?php echo $this->session->userdata['username']; ?></a></li>

				<li><a href="#" id="editSubscriber" data-toggle="modal" data-target="#editModal"><span class="glyphicon glyphicon-edit"></span> Edit</a></li>
				<li><a href="<?php echo site_url('logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	    </ul>
	  </div>
	</nav>

	<body>
