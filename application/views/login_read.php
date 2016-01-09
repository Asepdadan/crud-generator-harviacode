<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Login Read</h2>
        <table class="table">
	    <tr><td>Npm</td><td><?php echo $npm; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $password; ?></td></tr>
	    <tr><td>Waktu Terakhir</td><td><?php echo $waktu_terakhir; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('login') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>