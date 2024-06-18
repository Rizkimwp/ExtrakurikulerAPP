 <!-- Features Section -->
 <section id="features" class="features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Extrakurikuler</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">
      <div class="row justify-content-between">

        <div class="col-lg-5 d-flex align-items-center">

          <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
            @foreach ($extrakurikuler as $item)

            <li class="nav-item">
                <a class="nav-link @if($item->id === 1) active @endif show" data-bs-toggle="tab" data-bs-target="#features-tab-{{ $item->id }}">
                    <i class="bi bi-binoculars"></i>
                    <div>
                        <h4 class="d-none d-lg-block">{{ $item->nama }}</h4>
                            <p>
                                {{$item->deskripsi}}
                            </p>
                        </div>
                    </a>
                </li>
                @endforeach

            {{-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                <i class="bi bi-box-seam"></i>
                <div>
                  <h4 class="d-none d-lg-block">Unde praesenti mara setra le</h4>
                  <p>
                    Recusandae atque nihil. Delectus vitae non similique magnam molestiae sapiente similique
                    tenetur aut voluptates sed voluptas ipsum voluptas
                  </p>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                <i class="bi bi-brightness-high"></i>
                <div>
                  <h4 class="d-none d-lg-block">Pariatur explica nitro dela</h4>
                  <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                    Debitis nulla est maxime voluptas dolor aut
                  </p>
                </div>
              </a>
            </li> --}}
          </ul><!-- End Tab Nav -->

        </div>

        <div class="col-lg-6">

          <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            @foreach ($extrakurikuler as $item)
            <div class="tab-pane fade @if($item->id === 1) active @endif show" id="features-tab-{{ $item->id }}">
              <img src="{{ $item->gambar }}" alt="" class="img-fluid">
            </div><!-- End Tab Content Item -->
@endforeach
            {{-- <div class="tab-pane fade" id="features-tab-2">
              <img src="{{ asset('assets/img/tabs-2.jpg')}}" alt="" class="img-fluid">
            </div><!-- End Tab Content Item -->

            <div class="tab-pane fade" id="features-tab-3">
              <img src="{{ asset('assets/img/tabs-3.jpg')}}" alt="" class="img-fluid">
            </div><!-- End Tab Content Item -->
          </div> --}}

        </div>

      </div>

    </div>

  </section><!-- /Features Section -->
