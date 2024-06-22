<section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Blog</h2>
      <p>Dengan mengikuti blog ini, Anda akan selalu terupdate dengan berbagai kegiatan dan pencapaian di Sekolah SDIT AL-ISTIQOMAH.</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row g-5">
        @if ($posts->isNotEmpty())
        @foreach ($posts as $item)
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
                <i class="icon"> <img src="{{ $item->image }}" alt="" height="100px" width="100px"></i>
                <div>
                    <h3>{{ $item->judul }}</h3>
                    <p>{{ $item->excerpt }}</p>
                    <a href="service-details.html" class="read-more stretched-link">Selengkapnya..<i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div><!-- End Service Item -->
        @endforeach
        @else
        <h3 class="text-center">Belum ada postingan blog</h3>
        @endif
      </div>

    </div>

  </section><!-- /Services Section -->
