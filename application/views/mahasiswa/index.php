<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Daftar Mahasiswa</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
  <form class="form-inline" action="<?php echo site_url('mahasiswa/index/') ?>" method="post">
      <input class="form-control" type="text" name="search" value="" placeholder="Search...">
      <input class="btn btn-default" type="submit" name="filter" value="Go">
  </form>
    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Nama</th>
        <th width="200">No Telp</th>
        <th>Mata Kuliah</th>
        <th>
          <a class="btn btn-primary" href="<?php echo site_url('mahasiswa/create/') ?>">
            Tambah
          </a>
        </th>
      </thead>
      <?php if(isset($mahasiswa)) { ?>
      <tbody>
        <?php foreach($mahasiswa as $row) { ?>
        <tr>
          <td><?php echo $start+=1 ?></td>
          <td><?php echo $row->nama ?></td>
          <td><?php echo $row->no ?></td>
          <td><?php echo $row->nama_matkul ?></td>
          <td>
            <?php echo form_open('mahasiswa/destroy/'.$row->id); ?>
            <a class="btn btn-info" href="<?php echo site_url('mahasiswa/edit/'.$row->id) ?>">
              Ubah
            </a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
            <?php echo form_close() ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <?php echo $links; 
      }
      else
      {
        echo "Tidak Ada Data";
      } ?>
  
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>