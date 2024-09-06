<style>
    #autoResizeTextarea {
    max-height: auto; /* Example max height */
    overflow-y: auto; /* Allow scrolling if content exceeds max height */
}
@media (max-width: 768px) {
    #autoResizeTextarea {
        max-height: 400px;
    }
}

@media (min-width: 769px) {
    #autoResizeTextarea {
        max-height: 600px;
    }
}

.containerbtn{
    display: flex;
}

.selesai{
    margin-left: auto;
}
</style>
<?php
$activePage = basename($_SERVER['REQUEST_URI']);

?>
<?php
$jabatan = $satu->id_user;
?>
<div class="page-wrapper">
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text text-danger">Detail Kasus</h3>
                                <form class="mt-4" method="post" action="<?=base_url('home/aksi_ekasus')?>">
                                    <div class="form-group">
                                    <h6 class="card-title">Nama</h6>
                                    <select class="form-control" name="murid" id="kelas">
                         <?php foreach ($murid as $key): ?>
                            <option value="<?= $key->id_user ?>" <?= $key->id_user == $jabatan ? 'selected' : '' ?>>
                            <?= $key->nama ?>
                                </option>
                             <?php endforeach; ?>
                                    </select>
                                    <h6 class="card-title">Kronologi</h6>
                                    <textarea class="form-control" name="kronologi" id="autoResizeTextarea"><?=$satu->kasus?></textarea>
                                    </div>
                                    <div class="containerbtn">
                                <div class="back">
                                <a href="<?=base_url('home/dkasus')?>">
                                <button class="btn btn-primary">Back</button>
                                </a>
                                </div>
                                <div class="selesai">
                                    <input type="hidden" name="id" value="<?=$satu->id_kasus?>">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </a>
                                </div>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
   window.addEventListener('load', function () {
    const textarea = document.getElementById('autoResizeTextarea');

    if (textarea) {
        console.log('Textarea found:', textarea);

        function autoResize() {
            this.style.height = 'auto'; // Reset height
            let newHeight = this.scrollHeight;

            const maxHeight = 600; // Set a reasonable max height
            if (newHeight > maxHeight) {
                newHeight = maxHeight;
            }

            this.style.height = newHeight + 'px';
            console.log('New height set:', this.style.height);
        }

        setTimeout(function() {
            autoResize.call(textarea);
        }, 100); // Adjust this delay as needed

        textarea.addEventListener('input', autoResize, { passive: true });
    } else {
        console.error('Textarea not found!');
    }
});

</script>


