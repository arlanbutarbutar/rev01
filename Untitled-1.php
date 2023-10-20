<div class="col-sm-12">
   <div class="card">
      <div class="card-body">
         <h5 class="card-title"><?= $r['nama_bengkel'] ?> / <?= $r['alamat'] ?></h5><br>
         <div class="row">
            <div class="col-sm-6"><img class="rounded" src="<?php
                                                            if (file_exists("superadmin/berkas/" . $r['id_bengkel'] . ".jpg")) {
                                                               echo "superadmin/berkas/" . $r['id_bengkel'] . ".jpg";
                                                            } else {
                                                               echo "superadmin/berkas/kosong.png";
                                                            }
                                                            ?>" alt="Bengkel" width="100%" height="250px"></div>
            <div class="6">
               <h4><u>Deskripsi</u></h4>
               <p class="card-text">
               <p><?= $r['deskripsi'] ?></p>
               <p id="alamat">
                  <string>Alamat : </strong><?= $r['alamat'] ?>
               </p>
               <p><strong>Jam Buka : </strong><?= $r['jam_buka'] ?> s/d <?= $r['jam_tutup'] ?> WITA</p>
               <p><a href="detail_bengkel.php?id=<?= $r['id_bengkel'] ?>"><u>Selengkapnya...</u></a></p>
               </p>
            </div>
         </div>

      </div>
   </div>