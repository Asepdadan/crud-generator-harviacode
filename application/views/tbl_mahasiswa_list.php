<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Tbl_mahasiswa List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('mahasiswa/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mahasiswa/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mahasiswa/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama</th>
		    <th>Password</th>
		    <th>Tempat Lahir</th>
		    <th>Tanggal Lahir</th>
		    <th>Jenis Kelamin</th>
		    <th>Alamat</th>
		    <th>Direktory Foto</th>
		    <th>Nama Foto</th>
		    <th>No Handphone</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($mahasiswa_data as $mahasiswa)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $mahasiswa->nama ?></td>
		    <td><?php echo $mahasiswa->password ?></td>
		    <td><?php echo $mahasiswa->tempat_lahir ?></td>
		    <td><?php echo $mahasiswa->tanggal_lahir ?></td>
		    <td><?php echo $mahasiswa->jenis_kelamin ?></td>
		    <td><?php echo $mahasiswa->alamat ?></td>
		    <td><?php echo $mahasiswa->direktory_foto ?></td>
		    <td><?php echo $mahasiswa->nama_foto ?></td>
		    <td><?php echo $mahasiswa->no_handphone ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('mahasiswa/read/'.$mahasiswa->npm),'Read'); 
			echo ' | '; 
			echo anchor(site_url('mahasiswa/update/'.$mahasiswa->npm),'Update'); 
			echo ' | '; 
			echo anchor(site_url('mahasiswa/delete/'.$mahasiswa->npm),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
    </body>
</html>