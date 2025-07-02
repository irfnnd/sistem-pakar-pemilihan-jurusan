@extends('layouts.user')

@section('title', 'Dashboard Pengguna')

@section('content')
    <!-- Hero section -->
    <section id="beranda"
        class="relative overflow-hidden bg-primary text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px]">
        <div class="container">
            <div class="-mx-5 flex flex-wrap items-center">
                <div class="w-full px-5">
                    <div class="scroll-revealed mx-auto max-w-[780px] text-center">
                        <h1
                            class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                            Sistem Pakar Pemilihan Jurusan Berdasarkan Minat & Bakat
                        </h1>

                        <p class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                            Temukan jurusan yang tepat untuk masa depan Anda dengan sistem pakar berbasis AI yang
                            menggunakan metode Forward dan Backward Chaining untuk analisis minat dan bakat yang akurat.
                        </p>

                        <ul class=" flex flex-wrap items-center justify-center gap-4 md:gap-5">
                            <li>
                                <a href="{{ route('konsultasi.index') }}"
                                    class="inline-flex items-center justify-center rounded-md bg-primary-color text-primary px-5 py-3 text-center text-base font-medium shadow-md hover:bg-primary-light-5 md:px-7 md:py-[14px]"
                                    role="button">Mulai Konsultasi</a>
                            </li>

                            <!-- <li>
                            <a
                              href="javascript:void(0)"
                              class="video-popup flex items-center gap-4 rounded-md bg-primary-color/[0.15] px-5 py-3 text-base font-medium text-primary-color hover:bg-primary-color hover:text-primary md:px-7 md:py-[14px]"
                              role="button"
                              ><i class="lni lni-play text-lg/none"></i>Lihat</a
                            >
                          </li> -->
                        </ul>
                    </div>
                </div>
                <div class="w-full px-5">
                    <div class="scroll-revealed relative z-10 mx-auto max-w-[845px]">
                        <figure class="mt-16">
                            <img src="assets/img/hero.png" alt="Sistem Pakar Pemilihan Jurusan"
                                class="mx-auto max-w-full rounded-t-xl rounded-tr-xl" />
                        </figure>

                        <div class="absolute -left-9 bottom-0 z-[-1]">
                            <img src="assets/img/dots.svg" alt class="w-[120px] opacity-75" />
                        </div>

                        <div class="absolute -right-6 -top-6 z-[-1]">
                            <img src="assets/img/dots.svg" alt class="w-[120px] opacity-75" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About section -->
    <section id="about" class="section-area">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="w-full">
                    <figure class="scroll-revealed mx-auto max-w-[500px]">
                        <img src="assets/img/about.jpg" width="350" alt="Tentang Sistem Pakar EduChoice" class="rounded-xl" />
                    </figure>
                </div>

                <div class="w-full">
                    <div class="scroll-revealed">
                        <h6 class="mb-2 block text-lg font-semibold text-primary">
                            Tentang EduChoice
                        </h6>
                        <h2 class="mb-6">
                            Sistem Pakar Terpercaya untuk Memilih Jurusan yang Tepat
                        </h2>
                    </div>

                    <div class="tabs scroll-revealed">
                        <nav class="tabs-nav flex flex-wrap gap-4 my-8" role="tablist" aria-label="Tentang sistem tabs">
                            <button type="button"
                                class="tabs-link inline-block py-2 px-4 rounded-md text-body-light-12 dark:text-body-dark-12 bg-body-light-12/10 dark:bg-body-dark-12/10 text-inherit font-medium hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                                data-web-toggle="tabs" data-web-target="tabs-panel-profile" id="tabs-list-profile"
                                role="tab" aria-controls="tabs-panel-profile">
                                Profil Sistem
                            </button>
                        </nav>

                        <div class="tabs-content mt-4" id="tabs-panel-profile" tabindex="-1" role="tabpanel"
                            aria-labelledby="tabs-list-profile">
                            <p>
                                EduChoice adalah sistem pakar yang dirancang khusus untuk membantu siswa menentukan jurusan
                                kuliah yang paling sesuai dengan minat dan bakat mereka. Sistem ini menggunakan teknologi
                                artificial intelligence dengan metode Forward dan Backward Chaining untuk memberikan
                                rekomendasi yang akurat.
                            </p>
                            <p>
                                Dengan database yang komprehensif dan algoritma yang teruji, EduChoice telah membantu ribuan
                                siswa menemukan jalur pendidikan yang tepat untuk masa depan yang cerah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Methods section -->
    <section id="metode" class="section-area">
        <div class="container">
            <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
                <h6 class="mb-2 block text-lg font-semibold text-primary">
                    Metode Analisis
                </h6>
                <h2 class="mb-6">Forward & Backward Chaining</h2>
                <p>
                    Sistem kami menggunakan dua metode inference engine yang powerful untuk memberikan rekomendasi jurusan
                    yang akurat berdasarkan data minat dan bakat Anda.
                </p>
            </div>

            <div class="row">
                <div class="scroll-revealed col-12 sm:col-6 lg:col-6">
                    <div
                        class="rounded-xl py-12 px-9 bg-body-light-1 dark:bg-body-dark-12/10 text-center shadow-card-1 hover:shadow-lg">
                        <div class="mb-8">
                            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="lni lni-arrow-right text-primary text-3xl"></i>
                            </div>
                            <h4 class="text-xl font-semibold mb-4">Forward Chaining</h4>
                            <p class="text-body-light-11 dark:text-body-dark-11">
                                Metode inferensi yang bekerja dari fakta-fakta yang diketahui (minat dan bakat) menuju
                                kesimpulan (rekomendasi jurusan). Sistem akan menganalisis jawaban Anda untuk menghasilkan
                                rekomendasi yang sesuai.
                            </p>
                        </div>
                        <div class="pt-4">
                            <h6 class="font-semibold text-primary mb-3">Keunggulan:</h6>
                            <ul class="text-left space-y-2">
                                <li class="flex items-start gap-2">
                                    <i class="lni lni-checkmark-circle text-primary mt-1"></i>
                                    <span>Analisis berbasis data faktual</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="lni lni-checkmark-circle text-primary mt-1"></i>
                                    <span>Rekomendasi yang objektif</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="lni lni-checkmark-circle text-primary mt-1"></i>
                                    <span>Proses inferensi yang sistematis</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="scroll-revealed col-12 sm:col-6 lg:col-6">
                    <div
                        class="rounded-xl py-12 px-9 bg-body-light-1 dark:bg-body-dark-12/10 text-center shadow-card-1 hover:shadow-lg">
                        <div class="mb-8">
                            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="lni lni-arrow-left text-primary text-3xl"></i>
                            </div>
                            <h4 class="text-xl font-semibold mb-4">Backward Chaining</h4>
                            <p class="text-body-light-11 dark:text-body-dark-11">
                                Metode inferensi yang bekerja mundur dari tujuan (jurusan yang diinginkan) untuk mencari
                                fakta-fakta pendukung. Berguna untuk memvalidasi pilihan jurusan yang sudah ada di pikiran
                                Anda.
                            </p>
                        </div>
                        <div class="pt-4">
                            <h6 class="font-semibold text-primary mb-3">Keunggulan:</h6>
                            <ul class="text-left space-y-2">
                                <li class="flex items-start gap-2">
                                    <i class="lni lni-checkmark-circle text-primary mt-1"></i>
                                    <span>Validasi pilihan yang sudah ada</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="lni lni-checkmark-circle text-primary mt-1"></i>
                                    <span>Analisis kelayakan jurusan</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="lni lni-checkmark-circle text-primary mt-1"></i>
                                    <span>Penjelasan yang detail</span>
                                </li>
                                <li class="hidden">
                                    <i class="lni lni-checkmark-circle text-primary mt-1"></i>
                                    <span>Penjelasan yang detail</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Consultation section -->
    <section id="konsultasi" class="section-area bg-body-light-1 dark:bg-body-dark-12/10">
        <div class="container">
            <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
                <h6 class="mb-2 block text-lg font-semibold text-primary">
                    Metode Konsultasi
                </h6>
                <h2 class="mb-6">Temukan Jurusan Impian Anda</h2>
                <p>
                    Ikuti langkah-langkah sederhana untuk mendapatkan rekomendasi jurusan yang tepat berdasarkan minat dan
                    bakat Anda.
                </p>
            </div>

            <div class="row">
                <div class="scroll-revealed col-12 lg:col-4">
                    <div class="text-center mb-8 lg:mb-0">
                        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-primary-color py-2">1</span>
                        </div>
                        <h4 class="text-xl font-semibold mb-3">Isi Kuesioner</h4>
                        <p class="text-body-light-11 dark:text-body-dark-11">
                            Jawab pertanyaan tentang minat, bakat, dan preferensi karir Anda dengan jujur dan lengkap.
                        </p>
                    </div>
                </div>

                <div class="scroll-revealed col-12 lg:col-4">
                    <div class="text-center mb-8 lg:mb-0">
                        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-primary-color py-2">2</span>
                        </div>
                        <h4 class="text-xl font-semibold mb-3">Analisis AI</h4>
                        <p class="text-body-light-11 dark:text-body-dark-11">
                            Sistem akan menganalisis jawaban Anda menggunakan Forward dan Backward Chaining.
                        </p>
                    </div>
                </div>

                <div class="scroll-revealed col-12 lg:col-4">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-primary-color py-2">3</span>
                        </div>
                        <h4 class="text-xl font-semibold mb-3">Dapatkan Hasil</h4>
                        <p class="text-body-light-11 dark:text-body-dark-11">
                            Terima rekomendasi jurusan yang sesuai dengan penjelasan detail dan tingkat kesesuaian.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="javascript:void(0)"
                    class="inline-flex items-center justify-center rounded-md bg-primary text-primary-color px-5 py-3 text-base font-medium shadow-md hover:bg-primary-light-5"
                    role="button">
                    <i class="lni lni-rocket mr-4"></i>
                    Mulai Konsultasi Sekarang
                </a>
            </div>
        </div>
    </section>
@endsection
{{-- {{ Auth::user()->name }} --}}
