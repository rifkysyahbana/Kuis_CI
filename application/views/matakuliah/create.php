<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Tambah Data Matakuliah</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
  <?php echo form_open_multipart('matakuliah/store'); ?>

	<div class="form-group">
      <label for="Jabatan">Mata Kuliah</label>
      <input type="text" class="form-control" id="matakuliah" name="matakuliah" placeholder="Masukkan Mata Kuliah"
		value="<?php echo set_value('matakuliah'); ?>">  
    </div>

	<?php echo $error; ?>    

	<a class="btn btn-info" href="<?php echo site_url('matakuliah/') ?>">Kembali</a>
    <button type="submit" class="btn btn-primary">OK</button>
  <?php echo form_close() ?>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>