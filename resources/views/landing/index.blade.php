@extends('layouts.landing')

@section('title', 'Beranda - MAN Pandanaran')

@section('content')
<!-- ─── HERO ──────────────────────────────────────────────────────────────── -->
<section class="hero" id="beranda">
    <div class="hero-pattern"></div>
    <div class="hero-orbs">
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
    </div>
    <div class="hero-content">
        <div>
            <div class="hero-badge">
                <i class="bi bi-star-fill"></i> Akreditasi A — BAN-S/M Unggul
            </div>
            <h1 class="hero-title">
                Madrasah <span class="accent">Berprestasi</span> Berbasis<br>
                Nilai <span class="accent">Qur'ani</span> & Sains Modern
            </h1>
            <p class="hero-subtitle">
                MAN Pandanaran mencetak generasi Muslim intelektual berwawasan global,
                hafizh Qur'an, kompeten di bidang sains-teknologi, dan berjiwa pemimpin.
            </p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-num">1.200+</div>
                    <div class="hero-stat-label">Santri Aktif</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">95+</div>
                    <div class="hero-stat-label">Tenaga Pendidik</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">48+</div>
                    <div class="hero-stat-label">Prestasi Nasional</div>
                </div>
            </div>
            <div class="hero-actions">
                <a href="#ppdb" class="btn-primary-hero">
                    <i class="bi bi-pencil-square"></i> Daftar PPDB 2026/2027
                </a>
                <a href="#program" class="btn-outline-hero">
                    <i class="bi bi-play-circle-fill"></i> Lihat Program Unggulan
                </a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-card-group">
                <div class="hero-card featured">
                    <div class="hero-card-icon ic-gold"><i class="bi bi-book-half"></i></div>
                    <h4>Program Tahfidz Qur'an 30 Juz</h4>
                    <p>Target hafalan terstruktur dengan metode mutqin, didampingi hafizh berpengalaman lulusan Timur Tengah.</p>
                </div>
                <div class="hero-card">
                    <div class="hero-card-icon ic-blue"><i class="bi bi-robot"></i></div>
                    <h4>Lab Robotika & AI</h4>
                    <p>Fasilitas sains mutakhir: robotika IoT, coding, dan kecerdasan buatan.</p>
                </div>
                <div class="hero-card">
                    <div class="hero-card-icon ic-emerald"><i class="bi bi-translate"></i></div>
                    <h4>Bilingual Arab-Inggris</h4>
                    <p>Lingkungan bilingual immersif untuk komunikasi global yang percaya diri.</p>
                </div>
                <div class="hero-card">
                    <div class="hero-card-icon ic-purple"><i class="bi bi-mortarboard-fill"></i></div>
                    <h4>E-Learning Digital</h4>
                    <p>LMS canggih: materi online, kuis interaktif, & pembayaran SPP digital.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── PROGRAM UNGGULAN ──────────────────────────────────────────────────── -->
<section class="section section-alt" id="program">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-badge"><i class="bi bi-stars"></i> Program Unggulan</div>
            <h2 class="section-title">Jalur Pembelajaran <span class="accent">Terbaik</span> untuk Generasi Masa Depan</h2>
            <p class="section-subtitle">Kurikulum terintegrasi antara pendidikan agama Islam yang mendalam dan penguasaan sains teknologi modern.</p>
        </div>
        <div class="programs-grid">
            <div class="program-card reveal">
                <div class="program-card-header">
                    <div class="program-icon">📖</div>
                    <h3>Program Tahfidz Al-Qur'an</h3>
                    <p>Kelas Keagamaan Intensif</p>
                </div>
                <div class="program-card-body">
                    <ul class="program-features">
                        <li>Target 30 Juz bil ghoib bersanad</li>
                        <li>Pembina hafizh lulusan Universitas Al-Azhar Kairo</li>
                        <li>Metode mutqin & murajaah terstruktur harian</li>
                        <li>Beasiswa SPP penuh bagi penghafal Al-Qur'an</li>
                        <li>Wisuda Tahfidz tahunan bersama orang tua</li>
                    </ul>
                </div>
            </div>
            <div class="program-card reveal">
                <div class="program-card-header gold">
                    <div class="program-icon">🤖</div>
                    <h3>Sains, Robotika & Informatika</h3>
                    <p>Kelas MIPA Peminatan Teknologi</p>
                </div>
                <div class="program-card-body">
                    <ul class="program-features">
                        <li>Laboratorium AI, robotika & IoT terpadu</li>
                        <li>Kompetisi sains nasional dan internasional</li>
                        <li>Kemitraan riset dengan universitas top Indonesia</li>
                        <li>Pelatihan koding Python, web, dan otomasi</li>
                        <li>Kunjungan industri teknologi dan pusat riset</li>
                    </ul>
                </div>
            </div>
            <div class="program-card reveal">
                <div class="program-card-header teal">
                    <div class="program-icon">🌐</div>
                    <h3>Bilingual Arab & Inggris</h3>
                    <p>Program Internasional Bahasa</p>
                </div>
                <div class="program-card-body">
                    <ul class="program-features">
                        <li>Lingkungan sekolah bilingual Arab-Inggris</li>
                        <li>Nahwu Shorof dan muhadatsah intensif</li>
                        <li>Persiapan IELTS, TOEFL, dan tes JLPT</li>
                        <li>Pertukaran pelajar ke Yordania & Malaysia</li>
                        <li>Drama dan debat Bahasa Arab tingkat nasional</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── PRESTASI ──────────────────────────────────────────────────────────── -->
@if($prestasi->count())
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-badge gold-badge"><i class="bi bi-trophy-fill"></i> Prestasi Gemilang</div>
            <h2 class="section-title">Jejak <span class="accent">Keberhasilan</span> Santri MAN Pandanaran</h2>
        </div>
        <div class="news-grid">
            @foreach($prestasi as $post)
            <a href="{{ route('post.show', $post->slug) }}" class="news-card reveal">
                <div class="news-thumbnail" style="background: linear-gradient(135deg, #d97706, #f59e0b);">
                    🏆
                    <span class="news-cat-badge prestasi">Prestasi</span>
                </div>
                <div class="news-body">
                    <div class="news-date"><i class="bi bi-calendar3"></i> {{ $post->published_at?->isoFormat('D MMMM YYYY') }}</div>
                    <div class="news-title">{{ $post->title }}</div>
                    <div class="news-excerpt">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}</div>
                    <span class="read-more">Selengkapnya <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ─── BERITA & AGENDA ────────────────────────────────────────────────────── -->
<section class="section section-alt" id="berita">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-badge"><i class="bi bi-newspaper"></i> Berita & Agenda</div>
            <h2 class="section-title">Kabar Terkini <span class="accent">MAN Pandanaran</span></h2>
            <p class="section-subtitle">Ikuti informasi terbaru seputar kegiatan, pengumuman penting, dan agenda madrasah kami.</p>
        </div>
        <div class="news-grid">
            @forelse($recent_posts as $post)
            <a href="{{ route('post.show', $post->slug) }}" class="news-card reveal">
                <div class="news-thumbnail"
                    style="background: linear-gradient(135deg,
                        {{ $post->category === 'prestasi' ? '#d97706,#f59e0b' : ($post->category === 'agenda' ? '#7c3aed,#8b5cf6' : ($post->category === 'pengumuman' ? '#1d4ed8,#3b82f6' : '#047857,#059669')) }});">
                    {{ $post->category === 'prestasi' ? '🏆' : ($post->category === 'agenda' ? '📅' : ($post->category === 'pengumuman' ? '📢' : '📰')) }}
                    <span class="news-cat-badge {{ $post->category }}">{{ ucfirst($post->category) }}</span>
                </div>
                <div class="news-body">
                    <div class="news-date"><i class="bi bi-calendar3"></i> {{ $post->published_at?->isoFormat('D MMMM YYYY') }}</div>
                    <div class="news-title">{{ $post->title }}</div>
                    <div class="news-excerpt">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 110) }}</div>
                    <span class="read-more">Baca selengkapnya <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
            @empty
            <div style="grid-column: span 3; text-align: center; padding: 3rem; color: #94a3b8;">
                <i class="bi bi-newspaper" style="font-size: 3rem;"></i>
                <p style="margin-top: 1rem;">Belum ada berita yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>

        <!-- Agenda -->
        @if($agenda->count())
        <div style="margin-top: 3rem;">
            <h3 style="font-size: 1.3rem; font-weight: 800; margin-bottom: 1.5rem; color: #1e293b;">📅 Agenda Mendatang</h3>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                @foreach($agenda as $ag)
                <div style="background: white; border-radius: 14px; padding: 1.25rem; border: 1px solid #e2e8f0; display: flex; gap: 1rem; align-items: center; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="background: linear-gradient(135deg, #7c3aed, #8b5cf6); border-radius: 12px; width: 56px; height: 56px; flex-shrink: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white;">
                        <div style="font-size: 1.1rem; font-weight: 800; line-height: 1;">{{ $ag->event_date?->format('d') }}</div>
                        <div style="font-size: 0.6rem; text-transform: uppercase;">{{ $ag->event_date?->isoFormat('MMM') }}</div>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 0.9rem; color: #1e293b;">{{ $ag->title }}</div>
                        <div style="font-size: 0.78rem; color: #64748b; margin-top: 2px;">{{ Str::limit($ag->excerpt ?? strip_tags($ag->content), 80) }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- ─── FASILITAS ─────────────────────────────────────────────────────────── -->
<section class="section section-dark" id="fasilitas">
    <div class="container">
        <div class="section-header white-text reveal">
            <div class="section-badge" style="background: rgba(251,191,36,0.15); border-color: rgba(251,191,36,0.3); color: #fbbf24;">
                <i class="bi bi-building-fill"></i> Fasilitas Madrasah
            </div>
            <h2 class="section-title">Infrastruktur <span style="color: #fbbf24;">Modern</span> Berstandar Internasional</h2>
            <p class="section-subtitle">Lingkungan belajar yang kondusif dan canggih untuk mendukung setiap potensi santri.</p>
        </div>
        <div class="facilities-grid">
            <div class="facility-card reveal">
                <div class="facility-icon">🖥️</div>
                <h4>Lab Komputer & AI</h4>
                <p>200 unit komputer high-spec dengan software desain, AI, coding, dan robotika terbaru.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🔬</div>
                <h4>Lab Sains Terpadu</h4>
                <p>Laboratorium fisika, kimia, dan biologi modern dengan instrumen eksperimen standar penelitian.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">📚</div>
                <h4>Perpustakaan Digital</h4>
                <p>Koleksi 50.000+ judul buku, e-book, dan akses jurnal ilmiah internasional berbasis digital.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🕌</div>
                <h4>Masjid & Musalla</h4>
                <p>Masjid megah berkapasitas 1.500 jamaah dengan fasilitas wudhu nyaman dan halaman yang asri.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🏠</div>
                <h4>Asrama Boarding Modern</h4>
                <p>Asrama putra-putri terpisah dengan pembina hafizh/hafizhah, AC, dan ruang belajar 24 jam.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">⚽</div>
                <h4>Lapangan Multi-Sport</h4>
                <p>Lapangan futsal, basket, bulu tangkis indoor, dan area olahraga outdoor berstandar kompetisi.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🎭</div>
                <h4>Auditorium & Aula</h4>
                <p>Auditorium kapasitas 1.000 kursi dengan sistem audio visual canggih untuk event bergengsi.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🍽️</div>
                <h4>Dapur & Kantin Sehat</h4>
                <p>Kantin dengan standar gizi seimbang halal, menu rotasi bergizi, dan kafetaria santri modern.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── PPDB ──────────────────────────────────────────────────────────────── -->
<div class="ppdb-section" id="ppdb">
    <div class="ppdb-content">
        <div class="section-badge gold-badge reveal" style="background: rgba(255,255,255,0.25); border-color: rgba(255,255,255,0.4); color: white; margin-bottom: 1.25rem;">
            <i class="bi bi-pencil-square"></i> PPDB 2026/2027 Telah Dibuka
        </div>
        <h2 class="reveal">Bergabunglah Bersama Keluarga Besar MAN Pandanaran</h2>
        <p class="reveal">Daftarkan putra-putri Anda sekarang dan raih masa depan cerah bersama generasi unggul madrasah kami.</p>
        <div class="ppdb-info-grid">
            <div class="ppdb-info-card reveal">
                <div class="icon">🏅</div>
                <h4>Jalur Tahfidz Qur'an</h4>
                <p>Minimal 5 Juz hafalan. Beasiswa penuh SPP + biaya gedung. Bebas tes tertulis.</p>
            </div>
            <div class="ppdb-info-card reveal">
                <div class="icon">🎓</div>
                <h4>Jalur Prestasi Akademik</h4>
                <p>Ranking 1-3 kelas, juara olimpiade, atau nilai UN di atas rata-rata nasional.</p>
            </div>
            <div class="ppdb-info-card reveal">
                <div class="icon">📝</div>
                <h4>Jalur Reguler & CBT</h4>
                <p>Tes seleksi online berbasis komputer. Dua gelombang pendaftaran tersedia.</p>
            </div>
        </div>
        <a href="{{ route('login') }}" class="btn-ppdb-register reveal">
            <i class="bi bi-pencil-square"></i> Daftar Sekarang — Gratis
        </a>
    </div>
</div>

<!-- ─── KONTAK ────────────────────────────────────────────────────────────── -->
<section class="section section-alt" id="kontak">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-badge"><i class="bi bi-envelope-fill"></i> Hubungi Kami</div>
            <h2 class="section-title">Ada Pertanyaan? <span class="accent">Kami Siap Membantu</span></h2>
        </div>
        <div class="contact-grid">
            <div class="contact-info reveal">
                <h3>Informasi Kontak Madrasah</h3>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <h4>Alamat</h4>
                        <p>Jl. Kaliurang KM 14.5, Ngemplak, Sleman,<br>D.I. Yogyakarta 55584</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="bi bi-telephone-fill"></i></div>
                    <div>
                        <h4>Telepon / WhatsApp</h4>
                        <p>(0274) 895-7721<br>+62 812-3456-7890 (PPDB)</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="bi bi-envelope-at-fill"></i></div>
                    <div>
                        <h4>Email Resmi</h4>
                        <p>info@manpandanaran.sch.id<br>ppdb@manpandanaran.sch.id</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="bi bi-clock-fill"></i></div>
                    <div>
                        <h4>Jam Operasional</h4>
                        <p>Senin – Jumat: 07:00 – 16:00 WIB<br>Sabtu: 07:00 – 12:00 WIB</p>
                    </div>
                </div>
            </div>
            <div class="contact-form reveal">
                <h4 style="font-size: 1rem; font-weight: 800; margin-bottom: 1.5rem; color: #1e293b;">📩 Kirim Pesan</h4>
                @if(session('success'))
                    <div class="flash-message flash-success">✅ {{ session('success') }}</div>
                @endif
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required placeholder="Ahmad Ridwan">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="email@example.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="text" name="phone" class="form-control" placeholder="+62 812 xxxx xxxx">
                    </div>
                    <div class="form-group">
                        <label>Keperluan / Subjek</label>
                        <input type="text" name="subject" class="form-control" required placeholder="Pertanyaan mengenai PPDB 2026">
                    </div>
                    <div class="form-group">
                        <label>Isi Pesan</label>
                        <textarea name="message" class="form-control" rows="4" required placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-send-fill"></i> Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
