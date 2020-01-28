@extends('layouts.frontEnd')

@section('content')
  <!-- Banner start -->
  <div class="banner banner-bg-color">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{ asset('dist/img/banner.jpg') }}" alt="banner">
          <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
            <div class="carousel-content container">
              <div class="text-center">
                <div id="typed-strings">
                  <p>Bergabung dengan kami</p>
                </div>
                <h1 class="typed-text">&nbsp;
                  <span id="typed"></span>
                </h1>
                <p data-animation="animated fadeInUp delay-10s">
                  KSU NIAGA MANDIRI SEJAHTERA
                </p>
                <a data-animation="animated fadeInUp delay-10s"
                   href="{{ url('https://play.google.com/store/apps/details?id=co.multipayment') }}"
                   class="btn btn-lg btn-round btn-theme">
                  Download Aplikasinya sekarang
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- banner end -->

  <!-- services start -->
  <div class="services content-area-2 bg-grea">
    <div class="container">
      <div class="main-title">
        <h1>Layanan <span>Kami</span></h1>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="fa fa-star"></i>
            <div class="media-body">
              <h5>Program kemitraan</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="fa fa-font-awesome"></i>
            <div class="media-body">
              <h5>Jaminan pembelian</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="flaticon-graphic"></i>
            <div class="media-body">
              <h5>System e-commerce</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="fa fa-briefcase"></i>
            <div class="media-body">
              <h5 class="mt-0">Penyuluhan</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="fa fa-user"></i>
            <div class="media-body">
              <h5>Pendampingan</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="fa fa-users"></i>
            <div class="media-body">
              <h5>Keagenan</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="fa fa-legal"></i>
            <div class="media-body">
              <h5>Legal bisnis</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="media services-info">
            <i class="fa fa-lock"></i>
            <div class="media-body">
              <h5>Aman terpercaya</h5>
              <p>Deskirpsi</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- services end -->

  <!-- portfolio start -->
  <div class="portfolio-area content-area-8">
    <div class="container-fluid">
      <div class="main-title">
        <h1><span>Our</span> portfolio</h1>
        <ul class="list-inline-listing filters filteriz-navigation">
          <li class="active btn filtr-button filtr" data-filter="all">Gallery</li>
        </ul>
      </div>
      <div class="row filter-portfolio">
        <div class="cars">
          @foreach($imageName as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 col-pad filtr-item" data-category="1" style="min-height: 250px">
              <div class="property-box">
                <div class="property-thumbnail">
                  <a href="#" class="property-img">
                    <img src="{{ asset('dist/img/gallery/'. $item) }}" alt="portfolio" class="img-fluid"
                         style="height: 200px">
                  </a>
                  <div class="property-overlay">
                    <div class="property-magnify-gallery">
                      <a href="{{ asset('dist/img/gallery/'. $item) }}" class="overlay-link">
                        <i class="fa fa-search-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- portfolio end -->

  <!-- Counters start -->
  <div class="counters overview-bgi">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="counter-box">
            <i class="fa fa-archive"></i>
            <h1 class="counter">{{ $stup }}</h1>
            <h5>Stup Tersedia</h5>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="counter-box">
            <i class="fa fa-users"></i>
            <h1 class="counter">{{ $online }}</h1>
            <h5>Member Active</h5>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="counter-box">
            <i class="fa fa-users"></i>
            <h1 class="counter">{{ $user }}</h1>
            <h5>Total Member</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Counters end -->


  <!-- Agent start -->
  <div class="agent content-area-2">
    <div class="container">
      <div class="main-title">
        <h1><span>Team </span> Management</h1>
      </div>
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="agent-2">
            <div class="agent-photo">
              <img src="{{ asset('dist/img/agent/t1.jpg') }}" alt="avatar" class="img-fluid">
            </div>
            <div class="agent-details">
              <h6>Christian Anton H</h6>
              <p>ketua</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="agent-2">
            <div class="agent-photo">
              <img src="{{ asset('dist/img/agent/t2.jpg') }}" alt="avatar" class="img-fluid">
            </div>
            <div class="agent-details">
              <h6>Baiquni Ahmad</h6>
              <p>Manager</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="agent-2">
            <div class="agent-photo">
              <img src="{{ asset('dist/img/agent/t3.jpg') }}" alt="avatar" class="img-fluid">
            </div>
            <div class="agent-details">
              <h6>Surya atmaja putra</h6>
              <p>Administrator</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="agent-2">
            <div class="agent-photo">
              <img src="{{ asset('dist/img/agent/t4.jpg') }}" alt="avatar" class="img-fluid">
            </div>
            <div class="agent-details">
              <h6>Febrianto Dwi Putra</h6>
              <p>Direktur Utama</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Agent end -->

  <!-- Testimonial 1 start -->
  <div class="testimonial-1 overview-bgi">
    <div class="container">
      <div class="row">
        <div class="offset-lg-2 col-lg-9">
          <div class="testimonial-inner">
            <header class="testimonia-header">
              <h1>Deskripsi <span>Lebah</span></h1>
            </header>
            <div id="carouselExampleIndicators7" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <div class="avatar">
                        <img src="{{ asset('dist/img/tawon.png') }}" alt="avatar-2" class="img-fluid rounded"
                             style="background-color: #ffffff">
                      </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <div class="author-name">
                        Lebah Madu Trigona Sp
                      </div>
                      <p class="lead">
                        Madu adalah salah satu produk primadona HHBK (Hasil Hutan Bukan Kayu)di Indonesia. Banyaknya
                        manfaat madu bagi kesehatan, kecantikan dan lainlain menyebabkan permintaan pasar terhadap madu
                        alam dan madu budidaya cukup tinggi. Dalam situasi seperti ini, budidaya lebah madu Trigona sp
                        menjadi salah satu pilihan. Lebah kecil yang tidak memiliki sengat ini tidak hanya menghasilkan
                        madu, tetapi juga propolis yang memiliki nilai ekonomi cukup tinggi.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <div class="avatar">
                        <img src="{{ asset('dist/img/tawon2.png') }}" alt="avatar" class="img-fluid rounded"
                             style="background-color: #ffffff">
                      </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <div class="author-name">
                        Ciri-Ciri Morfologi
                      </div>
                      <p class="lead">
                        Lebah trigona berwarna hitam dan berukuran kecil, dengan panjang tubuh antara 3-4 mm, serta
                        rentang sayap 8 mm. Lebah pekerja memiliki kepala besar dan rahang panjang. Sedang lebah ratu
                        berukuran 3-4 kali ukuran lebah pekerja, perut besar mirip laron, berwarna kecoklatan dan
                        mempunyai sayap pendek. Lebah ini tidak mempunyai sengat (stingless bee). Dalam kehidupan dan
                        perkembangannya lebah sangat dipengaruhi oleh faktor lingkungan, meliputi suhu, kelembaban
                        udara, curah hujan dan ketinggian tempat. Disamping itu ketersedian pakan sangat menentukan
                        keberhasilan budidaya lebah trigona.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <div class="avatar">
                        <img src="{{ asset('dist/img/tawon3.png') }}" alt="avatar-3" class="img-fluid rounded">
                      </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <div class="author-name">
                        Budidaya Lebah Klanceng Yang Menguntungkan
                      </div>
                      <p class="lead">
                        elalui program kemandirian dari Koperasi Niaga Mandiri Sejahtera kami menawarkan program
                        kemitraan pemeliharaan Lebah Madu Klanceng yang menguntungkan. Peternak dapat membeli stup lebah
                        dengan harga yang terjangkau dengan jaminan pembelian kembali stup setelah berumur 3 bulan.
                        Dengan adanya program ini di harapkan peternak bisa mendapatkan keuntungan yang lebih dengan
                        cara yang sangat murah. Karena pembeliharaan lebah madu klanceng hanya membutuhkan bunga-bunga
                        untuk makanannya.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators7" role="button" data-slide="prev">
                <div class="slider-mover-left" aria-hidden="true">
                  <i class="fa fa-angle-left"></i>
                </div>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators7" role="button" data-slide="next">
                <div class="slider-mover-right" aria-hidden="true">
                  <i class="fa fa-angle-right"></i>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Testimonial 1 end -->

  <!-- Blog start -->
  <div class="blog content-area-2">
    <div class="container">
      <div class="main-title">
        <h1><span>Lebah Klanceng</span></h1>
        <p>Alur Budidaya</p>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="blog-1">
            <div class="blog-photo">
              <img src="{{ asset('dist/img/blog/blog1.jpg') }}" alt="blog" class="img-fluid">
            </div>
            <div class="detail">
              <h3>
                Persiapan Pra Budidaya.
              </h3>
              <p>
                Sebelum membudiayakan Lebah Klanceng terlebih dahulu calon peternak harus mempersiapkan tanaman bunga
                dan lokasi stup di rumah / kebun.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="blog-1">
            <div class="blog-photo">
              <img src="{{ asset('dist/img/blog/blog2.jpg') }}" alt="blog" class="img-fluid">
            </div>
            <div class="detail">
              <h3>
                Membeli Stup Lebah
              </h3>
              <p>
                Menjadi anggota koperasi Niaga Mandiri Sejahtera, Dengan mengikuti ADARTnya kemudian membeli stup dari
                agen yang ditunjuk.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="blog-1">
            <div class="blog-photo">
              <img src="{{ asset('dist/img/blog/blog3.jpg') }}" alt="blog" class="img-fluid">
            </div>
            <div class="detail">
              <h3>
                Mendapatkan Bimbingan
              </h3>
              <p>
                Selama menjadi anggota peternak Lebah Klanceng dari KSU NMS akan mendapat bimbingan dan arahan dari
                petugas dan agen
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="blog-1">
            <div class="blog-photo">
              <img src="{{ asset('dist/img/blog/blog4.jpg') }}" alt="blog" class="img-fluid">
            </div>
            <div class="detail">
              <h3>
                Mendapatkan Hasil Usaha
              </h3>
              <p>
                Setelah stup berumur 3 bulan peternak boleh menjual kembali kepada Koperasi NMS dengan harga dan
                ketentuan yang telah disepakati bersama.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Blog end -->

  <!-- partner start -->
  <div class="container partner">
    <div class="row">
      <div class="multi-carousel" data-items="1,3,5,6" data-slide="1" id="multiCarousel" data-interval="1000">
        <div class="multi-carousel-inner">
          @foreach($imagePartner as $item)
            <div class="item">
              <div class="pad15">
                <img src="{{ asset('dist/img/partner/'.$item) }}" alt="brand">
              </div>
            </div>
          @endforeach
        </div>
        <a class="multi-carousel-indicator leftLst" aria-hidden="true">
          <i class="fa fa-angle-left"></i>
        </a>
        <a class="multi-carousel-indicator rightLst" aria-hidden="true">
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- partner end -->

  <!-- Footer start -->
  <footer class="footer">
    <div class="container footer-inner">
      <div class="row text-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="footer-item">
            <h4>Kontak Kami</h4>
            <ul class="contact-info">
              <li>
                Jl. PK. Bangsa Ruko Stadion Brawijaya Blok G2, Kediri
              </li>
              <li>
                Email: <a href="mailto:info@themevessel.com">niagamandirisejahtera@gmail.com</a>
              </li>
              <li>
                Phone: <a href="tel:+0477-85x6-552">(0354) 741 6566</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-12">
          <p class="copy">&copy; 2019 <a href="#" target="_blank">Apis Meli</a>. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end -->
@endsection