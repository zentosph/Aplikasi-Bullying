<style>
    .btn-status {
        border: none;
        color: white;
        padding: 8px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: background-color 0.3s ease;
    }
    .btn-status-pending {
        background-color: #f5a623; /* Soft orange */
    }
    .btn-status-proses {
        background-color: #007bff; /* Soft blue */
    }
    .btn-status-proses-ke-kepala-sekolah {
        background-color: #6f42c1; /* Soft purple */
    }
    .btn-status-selesai {
        background-color: #28a745; /* Soft green */
    }
    .btn-status:hover {
        opacity: 0.8;
    }
</style>
<?php
$activePage = basename($_SERVER['REQUEST_URI']);

?>
<div cl
<div class="page-wrapper">
<div class="container-fluid">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kasus</h4>
                                <?php if (session()->get('level') == 1) { ?>
                                <a href="<?=base_url('home/t_kasus')?>">
                                    <button class="btn btn-info">Tambah</button>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-dark mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Status</th>
                                            <?php if (session()->get('level') == 1 || session()->get('level') == 4) { ?>
                                            <th scope="col">Aksi</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $no=1;
                                    foreach ($satu as $key) {
                                    ?>
                                    <?php
                                $btnClass = '';
                                switch ($key->status) {
                                    case 'Pending':
                                        $btnClass = 'btn-status btn-status-pending';
                                        break;
                                     case 'Proses':
                                        $btnClass = 'btn-status btn-status-proses';
                                        break;
                                    case 'Proses ke Kepala Sekolah':
                                        $btnClass = 'btn-status btn-status-proses-ke-kepala-sekolah';
                                        break;
                                    case 'Selesai':
                                        $btnClass = 'btn-status btn-status-selesai';
                                        break;
                                }
                                ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $key->nama?></td>
                                            <td><?=$key->kelas?></td>
                                            <td><button class="<?= $btnClass ?>"><?= $key->status ?></button></td>
                                            <td>
                                            <?php if ($activePage === 'kasus') { ?>
                                                <a href="<?=base_url('home/detailkasus/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fa fa-info-circle"></i></button>
                                                </a>
                                                <a href="<?=base_url('home/softdeletekasus/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fa fa-trash"></i></button>
                                                </a>
                                            <?php } ?>
                                            
                                            <?php if ($menu->data == 1) { ?>
                                            

                                            <?php if ($activePage === 'dkasus') { ?>
                                                <a href="<?=base_url('home/editkasus/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                                </a>
                                                <a href="<?=base_url('home/restoreupkasus/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fa fa-recycle"></i></button>
                                                </a>
                                                <a href="<?=base_url('home/softdeletekasus/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fa fa-trash"></i></button>
                                                </a>
                                            <?php } ?>
                                            <?php if ($activePage === 'kasus') { ?>

                                            
                                                <?php if($key->status == "Pending") {?>
                                                <a href="<?=base_url('home/statusproses/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i></button>
                                                </a>
                                                <?php } ?>
                                                <?php if($key->status == "Proses") {?>
                                                <a href="<?=base_url('home/statuspks/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i></button>
                                                </a>
                                                <?php } ?>
                                                <?php if($key->status == "Proses ke Kepala Sekolah" | $key->status == "Pending" | $key->status == "Proses") {?>
                                                <a href="<?=base_url('home/statusselesai/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fas fa-check"></i></button>
                                                </a>
                                                <?php } ?>

                                                <?php if($key->status == "Selesai") {?>
                                                <a href="<?=base_url('home/statuspending/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i></button>
                                                </a>
                                                <?php } ?>

                                                <?php } ?>
                                                <?php if ($activePage === 'skasus') { ?>
                                                <a href="<?=base_url('home/restorekasus/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i></button>
                                                </a>
                                                <a href="<?=base_url('home/deletekasus/'.$key->id_kasus)?>">
                                                    <button class="btn btn-primary"><i class="fa fa-trash"></i></button>
                                                </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>