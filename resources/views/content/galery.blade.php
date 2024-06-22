 <!-- Features Details Section -->
 <section  class="features-details section" id="pricing">
    <div class="container section-title" data-aos="fade-up">
        <h2>Dokumentasi Galeri</h2>
        <p>Dokumentasi Agenda Kegiatan Extrakurikuler SDIT AL-ISTIQOMAH</p>
      </div><!-- End Section Title -->

    <div class="container">
        @foreach ($galery as $item )


      <div class="row gy-4 justify-content-between features-item">

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <img src="{{ $item->gambar }}" class="img-fluid" alt="">
        </div>

        <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
          <div class="content">
            <h3>{{ $item->nama }}</h3>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
            </p>
            <a href="#" class="btn more-btn">Selengkapnya</a>
          </div>
        </div>

      </div><!-- Features Item -->

      @endforeach

    </div>

  </section><!-- /Features Details Section -->
