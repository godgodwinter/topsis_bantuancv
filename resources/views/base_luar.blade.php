<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bantuan Covid19 - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset("Arsha/") }}/assets/img/favicon.png" rel="icon">
  <link href="{{ asset("Arsha/") }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("Arsha/") }}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset("Arsha/") }}/assets/css/style.css" rel="stylesheet">

  @yield('csshere')
  <!-- =======================================================
  * Template Name: Arsha - v4.1.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ url('/')}}">Bantuan <I>Covid19</I></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="{{ asset("Arsha/") }}/assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/')}}/#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#services">Pengambilan</a></li>
          {{-- <li><a class="getstarted scrollto" href="{{ url('/')}}/cari">Cari</a></li> --}}

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>SISTEM PENDUKUNG KEPUTUSAN PENYALURAN BANTUAN DANA COVID</h1>
          <h2> KEPADA PENDUDUK DESA BANGELAN MENGGUNAKAN METODE TOPSIS</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="{{ url('/')}}/login" class="btn-get-started scrollto">Masuk</a>
            {{-- <a href="{{ url('/')}}/cari" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Cari NIK</span></a> --}}
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ asset("Arsha/") }}/assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cliens Section ======= -->
    <section id="cliens" class="cliens section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset("Arsha/") }}/assets/img/clients/malang.svg" class="img-fluid" alt="">
          </div>



        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Tentang <b><i>Sistem</i></b></h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
                Kementrian sosial berupayah Menyalurkan bantuan covid ke Desa di kabupaten Malang dan sekitarnya termasuk desa Bangelan. Pemerintah menyalurkan bantuan covid untuk para penduduk yang benar-benar terdampak covid sebagai upaya pemulihan perekonomian.
            </p>
            <p>
                Pemberian bantuan covid di berikan tiap bulan. Data-data penerima bantuan tersebut diproses dengan cara memberikan point-point pada setiap keriteria-keriteria yang ditentukan oleh Pemerintah yang di Kelola oleh perangkat desa. Proses Pemberian bantuan covid memunculkan permasalahan dimana data banyak yang tertumpuk belum terkomputerisasi membuat selama ini penyaluran ada yang terlewatkan mendapat bantuan covid atau datanya tidak sesuai kriteria tetapi tetap menjadi penerima bantuan covid.
            </p>

          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
                Berdasarkan jurnal yang ditulis Sembiring, Fauzi, Khalifah, Khotimah dan Rubiati (2020), yang berjudul “Sistem Pendukung Keputusan Penerima Bantuan Covid 19 menggunakan Metode Simple Additive Weighting (SAW) (Studi Kasus : Desa Sundawenang)”. Menerangkan bahwa pemberian penyaluran dana bantuan covid kepada penduduk desa bangelan membutuhkan sistem pendukung keputusan yang diharapkan bisa menentukan keputusan akhir agar mempermudah penyaluran penerima yang sesuai sasaran.
            </p>
            <P>
                Berdasarkan uraian pemasalahan diatas dan referensi dari riset sebelumnya maka diperlukan pembuatan <b>“Sistem Pendukung Keputusan Penyaluran Dana Bantuan Covid Kepada Penduduk Desa Bangelan Menggunakan <i>Metode TOPSIS</i>”</b>. Dengan harapan sistem yang dibangun dapat membantu memberikan penilaian yang tepat dan efektif.
            </P>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Tata Cara Pengambilan</h2>
          <p>Pengambilan bantuan dapat di ambil oleh orang yang bersangkutan atau diwakilkan orang dalam satu KK.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
                <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Persyaratan</a></h4>
              <p>KK Asli, KTP Asli orang yang bersangkutan, dan atau KTP Asli wakil dan surat pengambilan.</p>
            </div>
          </div>


          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Datang Ke Balai desa</a></h4>
              <p>Pada hari dan waktu yang telah di tentukan pada surat pengambilan.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
                <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Proses Pengambilan</a></h4>
              <p>Menyerahkan Persyaratan dan mendapat Bantuan.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

  <!-- ======= Footer ======= -->
  <footer id="footer">



    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>2021</span></strong>.
        &copy; Copyright Template by <strong><span>Arsha</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset("Arsha/") }}/assets/vendor/aos/aos.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset("Arsha/") }}/assets/js/main.js"></script>

</body>

</html>
