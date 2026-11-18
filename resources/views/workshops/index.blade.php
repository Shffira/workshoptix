@extends('layouts.app')

@section('title', 'WorkshopTIX — Discover Your Next Experience')

@section('content')

@php
    $featured = $workshops->first();
    $remaining = $featured
        ? max(0, $featured->quota - $featured->registered_count)
        : 0;
@endphp
<style>

/* WORKSHOP PUBLIC PAGE */

.workshop-page {
    background: #f8f3eb;
    color: #242323;
    overflow: hidden;
    font-family: inherit;
}

/* HERO */

.ticket-hero {
    min-height: 650px;
    position: relative;
    display: flex;
    align-items: center;
    padding: 65px 6%;
    background: #242323;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    filter: blur(3px);
    transform: scale(1.04);
    opacity: .45;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        110deg,
        rgba(15,15,15,.97),
        rgba(20,20,20,.78)
    );
}

.hero-content {
    width: 100%;
    max-width: 1180px;
    margin: auto;
    position: relative;
    z-index: 2;
}

.hero-ticket {
    display: grid;
    grid-template-columns: 1fr 300px;
    background: #f8f3eb;
    color: #242323;
    border-radius: 12px;
    overflow: hidden;
    min-height: 390px;
}

.hero-ticket-main {
    padding: 40px;
}

.hero-eyebrow,
.hero-countdown-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2px;
}

.hero-eyebrow {
    color: #3854ff;
}

.hero-countdown-label {
    margin-top: 40px;
    color: #777;
}

.hero-ticket-main h1 {
    font-size: clamp(32px, 5vw, 62px);
    font-weight: 900;
    line-height: .98;
    letter-spacing: -2px;
    text-transform: uppercase;
    max-width: 650px;
    margin: 15px 0;
}

.hero-description {
    font-size: 13px;
    color: #777;
    max-width: 500px;
    line-height: 1.7;
}

.hero-details {
    display: flex;
    flex-wrap: wrap;
    gap: 35px;
    margin-top: 35px;
}

.hero-details div {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.hero-details span,
.hero-price-label {
    font-size: 9px;
    letter-spacing: 1.5px;
    color: #888;
}

.hero-details strong {
    font-size: 12px;
}

.hero-bottom {
    border-top: 1px solid #ddd5cb;
    margin-top: 30px;
    padding-top: 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.hero-bottom > div {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.hero-bottom strong {
    font-size: 23px;
}

.ticket-button {
    background: #3854ff;
    color: white;
    text-decoration: none;
    padding: 14px 20px;
    font-size: 12px;
    font-weight: 700;
    display: flex;
    gap: 22px;
    align-items: center;
    transition: .2s;
}

.ticket-button:hover {
    background: #2439ce;
    color: white;
}

/* HERO TICKET STUB */

.hero-ticket-stub {
    background: #252424;
    color: white;
    padding: 25px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.stub-image {
    height: 190px;
    overflow: hidden;
    border-radius: 7px;
}

.stub-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.stub-placeholder {
    background: #3854ff;
    height: 100%;
    display: grid;
    place-items: center;
    text-align: center;
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
}

.stub-divider {
    border-top: 2px dashed #777;
    margin: 20px 0;
}

.stub-info span {
    color: #e36bdd;
    font-size: 9px;
    letter-spacing: 2px;
}

.stub-info h3 {
    font-size: 19px;
    margin: 8px 0;
    text-transform: uppercase;
}

.stub-info p {
    font-size: 12px;
    color: #aaa;
}

.stub-barcode {
    border-top: 1px solid #555;
    padding-top: 15px;
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    letter-spacing: 3px;
}

.hero-caption {
    position: absolute;
    bottom: 20px;
    left: 6%;
    right: 6%;
    display: flex;
    justify-content: space-between;
    color: #aaa;
    font-size: 9px;
    letter-spacing: 2px;
}

/* FEATURED WORKSHOPS */

.featured-section {
    max-width: 1180px;
    margin: auto;
    padding: 90px 25px;
}

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: end;
    margin-bottom: 45px;
    gap: 20px;
}

.section-eyebrow {
    color: #3854ff;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
}

.section-heading h2 {
    font-size: clamp(34px, 5vw, 52px);
    font-weight: 900;
    letter-spacing: -2px;
    margin: 12px 0;
}

.section-heading h2 span,
.workshop-footer h3 span {
    color: #3854ff;
}

.section-heading p {
    font-size: 13px;
    color: #777;
}

.workshop-counter {
    display: flex;
    align-items: center;
    gap: 12px;
    border-left: 1px solid #d7cfc4;
    padding-left: 20px;
}

.workshop-counter strong {
    font-size: 38px;
    color: #3854ff;
}

.workshop-counter span {
    font-size: 9px;
    line-height: 1.6;
    letter-spacing: 1px;
}

/* TICKET LIST */

.workshop-list {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.workshop-ticket {
    position: relative;
    display: grid;
    grid-template-columns: 90px 190px 1fr 190px;
    align-items: center;
    gap: 20px;
    background: #fffaf2;
    border: 1px solid #e4dcd1;
    padding: 22px;
    min-height: 190px;
    overflow: hidden;
    transition: .25s;
}

.workshop-ticket:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
}

.ticket-date {
    display: flex;
    flex-direction: column;
    text-align: center;
    border-right: 1px solid #ddd4c9;
    padding-right: 15px;
}

.ticket-date span {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
}

.ticket-date strong {
    font-size: 42px;
    line-height: 1.2;
    font-weight: 900;
}

.ticket-date small {
    font-size: 10px;
    color: #888;
}

.workshop-image {
    position: relative;
    height: 140px;
    overflow: hidden;
    background: #252424;
}

.workshop-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .4s;
}

.workshop-ticket:hover .workshop-image img {
    transform: scale(1.06);
}

.image-placeholder {
    height: 100%;
    display: grid;
    place-items: center;
    color: white;
    background: linear-gradient(135deg, #3854ff, #e36bdd);
    font-weight: 800;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
}

.image-number {
    position: absolute;
    bottom: 8px;
    left: 8px;
    color: white;
    background: rgba(0,0,0,.65);
    padding: 4px 8px;
    font-size: 10px;
}

.workshop-category {
    color: #3854ff;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.workshop-information h3 {
    font-size: 19px;
    font-weight: 800;
    margin: 9px 0;
}

.workshop-description {
    font-size: 11px;
    color: #888;
    line-height: 1.6;
    margin-bottom: 12px;
}

.workshop-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px 15px;
    color: #777;
    font-size: 10px;
}

.workshop-action {
    border-left: 2px dashed #d5ccc0;
    padding-left: 22px;
    display: flex;
    flex-direction: column;
    gap: 13px;
}

.workshop-action > strong {
    font-size: 20px;
    font-weight: 900;
}

.availability {
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .5px;
}

.status-available {
    color: #31815d;
}

.status-limited {
    color: #d28b20;
}

.status-full {
    color: #c84b4b;
}

.workshop-button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #252424;
    color: white;
    padding: 12px 14px;
    font-size: 11px;
    text-decoration: none;
    font-weight: 700;
    transition: .2s;
}

.workshop-button:hover {
    background: #3854ff;
    color: white;
}

.ticket-notch {
    position: absolute;
    right: 177px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #f8f3eb;
}

.ticket-notch-top {
    top: -9px;
}

.ticket-notch-bottom {
    bottom: -9px;
}

/* CTA */

.cta-section {
    position: relative;
    margin: 0 6% 70px;
    padding: 65px;
    background: #252424;
    color: #fffaf2;
    overflow: hidden;
    border-radius: 8px;
}

.cta-content {
    position: relative;
    z-index: 2;
}

.cta-content > span {
    font-size: 10px;
    color: #e36bdd;
    letter-spacing: 2px;
}

.cta-content h2 {
    font-size: clamp(35px, 5vw, 58px);
    line-height: 1.05;
    font-weight: 900;
    margin: 20px 0;
}

.cta-content p {
    max-width: 450px;
    font-size: 13px;
    line-height: 1.8;
    color: #bbb;
}

.cta-decoration {
    position: absolute;
    right: 35px;
    bottom: -65px;
    font-size: 190px;
    font-weight: 900;
    color: rgba(255,255,255,.045);
}

/* FOOTER */

.workshop-footer {
    border-top: 1px solid #e0d8cd;
    padding: 35px 6%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.workshop-footer h3 {
    font-size: 21px;
    font-weight: 900;
    margin-bottom: 5px;
}

.workshop-footer p,
.footer-right {
    font-size: 11px;
    color: #888;
}

.empty-workshops {
    text-align: center;
    padding: 80px 20px;
    border: 1px dashed #ccc;
}

.pagination-wrapper {
    margin-top: 35px;
}

/* RESPONSIVE */

@media (max-width: 900px) {
    .hero-ticket {
        grid-template-columns: 1fr;
    }

    .hero-ticket-stub {
        display: grid;
        grid-template-columns: 130px 1fr;
        gap: 15px;
    }

    .stub-image {
        height: 120px;
    }

    .stub-divider {
        display: none;
    }

    .stub-barcode {
        grid-column: 1 / -1;
    }

    .workshop-ticket {
        grid-template-columns: 65px 140px 1fr;
    }

    .workshop-action {
        grid-column: 2 / -1;
        border-left: 0;
        border-top: 2px dashed #d5ccc0;
        padding: 15px 0 0;
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
    }

    .workshop-action .availability {
        grid-column: 1 / -1;
    }

    .ticket-notch {
        display: none;
    }
}

@media (max-width: 600px) {
    .ticket-hero {
        padding: 35px 15px 60px;
        min-height: auto;
    }

    .hero-ticket-main {
        padding: 25px 20px;
    }

    .hero-ticket-main h1 {
        font-size: 35px;
    }

    .hero-details {
        gap: 18px;
    }

    .hero-bottom {
        align-items: flex-start;
        flex-direction: column;
    }

    .hero-caption {
        font-size: 7px;
    }

    .featured-section {
        padding: 55px 15px;
    }

    .section-heading {
        align-items: flex-start;
    }

    .workshop-counter {
        display: none;
    }

    .workshop-ticket {
        grid-template-columns: 60px 1fr;
        padding: 15px;
        gap: 13px;
    }

    .ticket-date {
        grid-row: span 2;
        padding-right: 10px;
    }

    .workshop-image {
        height: 160px;
    }

    .workshop-information {
        grid-column: 1 / -1;
    }

    .workshop-action {
        grid-column: 1 / -1;
    }

    .cta-section {
        margin: 0 15px 40px;
        padding: 35px 25px;
    }

    .cta-decoration {
        font-size: 100px;
    }

    .workshop-footer {
        align-items: flex-start;
        flex-direction: column;
    }
}
    
</style>
<div class="workshop-page">

    {{-- HERO SECTION --}}
    @if($featured)
    <section class="ticket-hero">
        <div class="hero-background"
            style="background-image: url('{{ $featured->thumbnail ? Storage::url($featured->thumbnail) : '' }}')">
        </div>

        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="hero-ticket">

                <div class="hero-ticket-main">
                    <span class="hero-eyebrow">WORKSHOPTIX PRESENTS</span>

                    <div class="hero-countdown-label">
                        UPCOMING EXPERIENCE
                    </div>

                    <h1>{{ $featured->title }}</h1>

                    <div class="hero-description">
                        {{ Str::limit($featured->description, 120) }}
                    </div>

                    <div class="hero-details">
                        <div>
                            <span>DATE</span>
                            <strong>{{ $featured->start_at->format('d M Y') }}</strong>
                        </div>

                        <div>
                            <span>TIME</span>
                            <strong>{{ $featured->start_at->format('H:i') }} WIB</strong>
                        </div>

                        <div>
                            <span>LOCATION</span>
                            <strong>{{ $featured->location }}</strong>
                        </div>
                    </div>

                    <div class="hero-bottom">
                        <div>
                            <span class="hero-price-label">STARTING FROM</span>
                            <strong>{{ $featured->formatted_price }}</strong>
                        </div>

                        <a href="{{ route('workshops.show', $featured->slug) }}"
                           class="ticket-button">
                            Get Your Ticket
                            <span>↗</span>
                        </a>
                    </div>
                </div>

                <div class="hero-ticket-stub">
                    <div class="stub-image">
                        @if($featured->thumbnail)
                            <img src="{{ Storage::url($featured->thumbnail) }}"
                                 alt="{{ $featured->title }}">
                        @else
                            <div class="stub-placeholder">
                                {{ $featured->category }}
                            </div>
                        @endif
                    </div>

                    <div class="stub-divider"></div>

                    <div class="stub-info">
                        <span>YOUR EXPERIENCE</span>
                        <h3>{{ $featured->category }}</h3>
                        <p>{{ $featured->speaker }}</p>
                    </div>

                    <div class="stub-barcode">
                        <span>W T X</span>
                        <strong>2026</strong>
                    </div>
                </div>

            </div>
        </div>

        <div class="hero-caption">
            <span>01 / FEATURED WORKSHOP</span>
            <span>DISCOVER. LEARN. EXPERIENCE.</span>
        </div>
    </section>
    @endif


    {{-- FEATURED WORKSHOPS --}}
    <section class="featured-section">

        <div class="section-heading">
            <div>
                <span class="section-eyebrow">FIND YOUR NEXT EXPERIENCE</span>
                <h2>Explore Workshops<span>.</span></h2>
                <p>Temukan pengalaman belajar baru bersama para profesional.</p>
            </div>

            <div class="workshop-counter">
                <strong>{{ $workshops->total() }}</strong>
                <span>AVAILABLE<br>WORKSHOPS</span>
            </div>
        </div>

        @if($workshops->isEmpty())

            <div class="empty-workshops">
                <h3>No Workshops Available</h3>
                <p>Belum ada workshop yang tersedia saat ini.</p>
            </div>

        @else

            <div class="workshop-list">

                @foreach($workshops as $index => $workshop)

                    @php
                        $remaining = max(
                            0,
                            $workshop->quota - $workshop->registered_count
                        );
                    @endphp

                    <article class="workshop-ticket">

                        {{-- TICKET DATE --}}
                        <div class="ticket-date">
                            <span>{{ $workshop->start_at->format('M') }}</span>
                            <strong>{{ $workshop->start_at->format('d') }}</strong>
                            <small>{{ $workshop->start_at->format('Y') }}</small>
                        </div>

                        {{-- TICKET IMAGE --}}
                        <div class="workshop-image">
                            @if($workshop->thumbnail)
                                <img src="{{ Storage::url($workshop->thumbnail) }}"
                                     alt="{{ $workshop->title }}">
                            @else
                                <div class="image-placeholder">
                                    <span>{{ $workshop->category }}</span>
                                </div>
                            @endif

                            <span class="image-number">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>

                        {{-- TICKET DETAILS --}}
                        <div class="workshop-information">

                            <span class="workshop-category">
                                {{ $workshop->category }}
                            </span>

                            <h3>{{ $workshop->title }}</h3>

                            <p class="workshop-description">
                                {{ Str::limit($workshop->description, 115) }}
                            </p>

                            <div class="workshop-meta">
                                <span>
                                    {{ $workshop->start_at->format('H:i') }} WIB
                                    – {{ $workshop->end_at->format('H:i') }} WIB
                                </span>

                                <span>{{ $workshop->location }}</span>

                                <span>{{ $workshop->speaker }}</span>
                            </div>
                        </div>

                        {{-- TICKET PRICE --}}
                        <div class="workshop-action">

                            <div class="availability">
                                @if($remaining <= 0)
                                    <span class="status-full">SOLD OUT</span>
                                @elseif($remaining <= 5)
                                    <span class="status-limited">
                                        {{ $remaining }} SEATS LEFT
                                    </span>
                                @else
                                    <span class="status-available">
                                        {{ $remaining }} SEATS AVAILABLE
                                    </span>
                                @endif
                            </div>

                            <strong>{{ $workshop->formatted_price }}</strong>

                            <a href="{{ route('workshops.show', $workshop->slug) }}"
                               class="workshop-button">
                                @if($remaining <= 0)
                                    View Details
                                @else
                                    Get Ticket
                                @endif
                                <span>↗</span>
                            </a>

                        </div>

                        <div class="ticket-notch ticket-notch-top"></div>
                        <div class="ticket-notch ticket-notch-bottom"></div>

                    </article>

                @endforeach

            </div>

            <div class="pagination-wrapper">
                {{ $workshops->links('components.pagination') }}
            </div>

        @endif

    </section>


    {{-- CALL TO ACTION --}}
    <section class="cta-section">
        <div class="cta-content">
            <span>YOUR NEXT EXPERIENCE STARTS HERE</span>

            <h2>
                Inspiring Minds.<br>
                Creating Experiences.
            </h2>

            <p>
                Temukan workshop menarik, kembangkan kemampuan,
                dan dapatkan tiket digitalmu dengan mudah.
            </p>
        </div>

        <div class="cta-decoration">
            WTX
        </div>
    </section>


    {{-- FOOTER --}}
    <footer class="workshop-footer">
        <div>
            <h3>WorkshopTIX<span>.</span></h3>
            <p>Discover. Learn. Experience.</p>
        </div>

        <div class="footer-right">
            © {{ date('Y') }} WorkshopTIX. All rights reserved.
        </div>
    </footer>

</div>

@endsection
