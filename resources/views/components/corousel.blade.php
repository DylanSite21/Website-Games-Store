<div class="ultra-slider" id="ultraSlider">
    @php
        $carouselGames = isset($corousel) ? $corousel->take(5) : collect();
    @endphp

    @if ($carouselGames->count() > 0)
        <!-- Slides Container -->
        <div class="ultra-slides" id="ultraSlides">
            @foreach ($carouselGames as $index => $game)
                <div class="ultra-slide {{ $index === 0 ? 'active' : '' }}">
                    <!-- Background Image -->
                    <div class="ultra-bg" style="background-image: url('{{ $game->cover_url }}');"></div>

                    <!-- Overlays -->
                    <div class="ultra-overlay"></div>
                    <div class="ultra-overlay-glow"></div>

                    <!-- Content -->
                    <div class="ultra-content">
                        @if ($game->is_featured ?? false)
                            <span class="ultra-badge">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Featured
                            </span>
                        @endif

                        <h1 class="ultra-title">{{ $game->title }}</h1>

                        <div class="ultra-meta">
                            <span class="ultra-price">Rp {{ number_format($game->price, 0, ',', '.') }}</span>
                            @if ($game->discount_percent ?? 0 > 0)
                                <span class="ultra-discount">-{{ $game->discount_percent }}%</span>
                                <span class="ultra-original-price">Rp
                                    {{ number_format($game->original_price ?? $game->price, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        <p class="ultra-desc">{{ Str::limit($game->description, 150) }}</p>

                        <div class="ultra-actions">
                            <a href="{{ route('game.show', $game) }}" class="ultra-btn primary">
                                <span>Lihat Detail</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                            <form action="{{ route('cart.add', $game) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="ultra-btn secondary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Beli Sekarang
                                </button>
                            </form>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>

        <!-- Navigation -->
        <button class="ultra-nav prev" id="navPrev" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button class="ultra-nav next" id="navNext" aria-label="Next slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Dots -->
        <div class="ultra-dots" id="ultraDots">
            @foreach ($carouselGames as $index => $game)
                <button class="ultra-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                    aria-label="Go to slide {{ $index + 1 }}">
                    <span class="ultra-dot-inner"></span>
                </button>
            @endforeach
        </div>

        <!-- Progress Bar -->
        <div class="ultra-progress">
            <div class="ultra-progress-bar" id="progressBar"></div>
        </div>
    @endif
</div>

<style>
    .ultra-slider {
        position: relative;
        width: 100%;
        height: 85vh;
        min-height: 600px;
        max-height: 900px;
        overflow: hidden;
        background: #0a0a0a;
        font-family: 'Inter', system-ui, sans-serif;
    }

    .ultra-slides {
        display: flex;
        height: 100%;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: transform;
    }

    .ultra-slide {
        min-width: 100%;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }

    /* Background with Ken Burns Effect */
    .ultra-bg {
        position: absolute;
        inset: -2%;
        background-size: cover;
        background-position: center;
        transform: scale(1);
        transition: transform 8s ease;
        filter: brightness(0.6);
    }

    .ultra-slide.active .ultra-bg {
        transform: scale(1.15);
        filter: brightness(0.7);
    }

    /* Overlays */
    .ultra-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg,
                transparent 0%,
                rgba(10, 10, 10, 0.3) 30%,
                rgba(10, 10, 10, 0.85) 75%,
                rgba(10, 10, 10, 0.95) 100%);
    }

    .ultra-overlay-glow {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at bottom, rgba(84, 66, 255, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    /* Content */
    .ultra-content {
        position: absolute;
        bottom: 10%;
        left: 5%;
        right: 5%;
        max-width: 700px;
        color: white;
        z-index: 10;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: none;
    }

    .ultra-slide.active .ultra-content {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
        transition-delay: 0.2s;
    }

    /* Badge */
    .ultra-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 50px;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
    }

    /* Typography */
    .ultra-title {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 800;
        line-height: 0.95;
        margin-bottom: 1rem;
        text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        letter-spacing: -0.02em;
        background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .ultra-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .ultra-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
    }

    .ultra-discount {
        padding: 4px 10px;
        background: #00d4aa;
        color: #000;
        font-size: 0.875rem;
        font-weight: 700;
        border-radius: 4px;
    }

    .ultra-original-price {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.5);
        text-decoration: line-through;
    }

    .ultra-desc {
        font-size: 1.1rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 2rem;
        max-width: 550px;
    }

    /* Buttons */
    .ultra-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .ultra-btn {
        display: inline-flex;
        align-items: center;
        padding: 14px 32px;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .ultra-btn.primary {
        background: white;
        color: #0a0a0a;
    }

    .ultra-btn.primary:hover {
        background: #f0f0f0;
        transform: translateY(-2px);
        box-shadow: 0 10px 40px rgba(255, 255, 255, 0.3);
    }

    .ultra-btn.secondary {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .ultra-btn.secondary:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }

    /* Slide Number */
    .ultra-slide-number {
        position: absolute;
        top: 30px;
        right: 40px;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.6);
        z-index: 10;
        letter-spacing: 1px;
    }

    .ultra-slide-number .current {
        color: white;
        font-weight: 700;
    }

    /* Navigation */
    .ultra-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 20;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .ultra-slider:hover .ultra-nav {
        opacity: 1;
    }

    .ultra-nav.prev {
        left: 25px;
    }

    .ultra-nav.next {
        right: 25px;
    }

    .ultra-nav:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-50%) scale(1.05);
    }

    /* Dots */
    .ultra-dots {
        position: absolute;
        bottom: 35px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 20;
    }

    .ultra-dot {
        width: 40px;
        height: 4px;
        border-radius: 2px;
        background: rgba(255, 255, 255, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        border: none;
        padding: 0;
    }

    .ultra-dot-inner {
        position: absolute;
        inset: 0;
        background: white;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .ultra-dot.active .ultra-dot-inner {
        transform: scaleX(1);
    }

    .ultra-dot:hover {
        background: rgba(255, 255, 255, 0.4);
    }

    /* Progress Bar */
    .ultra-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 20;
    }

    .ultra-progress-bar {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        transition: width 0.1s linear;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .ultra-slider {
            height: 75vh;
            min-height: 500px;
        }

        .ultra-content {
            left: 4%;
            right: 4%;
            bottom: 8%;
        }

        .ultra-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
        }
    }

    @media (max-width: 640px) {
        .ultra-slider {
            height: 70vh;
            min-height: 450px;
        }

        .ultra-content {
            left: 3%;
            right: 3%;
            bottom: 5%;
        }

        .ultra-title {
            font-size: clamp(1.75rem, 6vw, 2.5rem);
        }

        .ultra-actions {
            flex-direction: column;
            align-items: flex-start;
        }

        .ultra-btn {
            width: 100%;
            justify-content: center;
        }

        .ultra-nav {
            display: none;
        }

        .ultra-dot {
            width: 30px;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .ultra-slides,
        .ultra-bg,
        .ultra-content,
        .ultra-btn,
        .ultra-nav,
        .ultra-dot,
        .ultra-progress-bar {
            transition: none !important;
            animation: none !important;
        }
    }

    .ultra-btn:focus-visible,
    .ultra-nav:focus-visible,
    .ultra-dot:focus-visible {
        outline: 2px solid #6366f1;
        outline-offset: 2px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const slides = document.querySelectorAll('.ultra-slide');
        const slidesContainer = document.getElementById('ultraSlides');
        const dots = document.querySelectorAll('.ultra-dot');
        const progressBar = document.getElementById('progressBar');
        const navPrev = document.getElementById('navPrev');
        const navNext = document.getElementById('navNext');

        let currentIndex = 0;
        let slideInterval;
        let progressInterval;
        const autoSlideDelay = 6000; // 6 seconds

        function goToSlide(index) {
            // Update slides
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');

            // Move container
            if (slidesContainer) {
                slidesContainer.style.transform = `translateX(-${index * 100}%)`;
            }

            // Update dots
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });

            // Reset & animate progress bar
            resetProgressBar();

            currentIndex = index;
        }

        function nextSlide() {
            const nextIndex = (currentIndex + 1) % slides.length;
            goToSlide(nextIndex);
        }

        function prevSlide() {
            const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
            goToSlide(prevIndex);
        }

        function resetProgressBar() {
            if (progressBar) {
                progressBar.style.transition = 'none';
                progressBar.style.width = '0%';
                // Force reflow
                void progressBar.offsetWidth;
                progressBar.style.transition = `width ${autoSlideDelay}ms linear`;
                progressBar.style.width = '100%';
            }
        }

        function startAutoSlide() {
            stopAutoSlide();
            slideInterval = setInterval(nextSlide, autoSlideDelay);
            resetProgressBar();
        }

        function stopAutoSlide() {
            if (slideInterval) clearInterval(slideInterval);
            if (progressBar) {
                progressBar.style.transition = 'none';
                progressBar.style.width = '0%';
            }
        }

        // Event Listeners
        if (navNext) navNext.addEventListener('click', () => {
            nextSlide();
            startAutoSlide();
        });
        if (navPrev) navPrev.addEventListener('click', () => {
            prevSlide();
            startAutoSlide();
        });

        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                goToSlide(index);
                startAutoSlide();
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                prevSlide();
                startAutoSlide();
            }
            if (e.key === 'ArrowRight') {
                nextSlide();
                startAutoSlide();
            }
        });

        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;
        const slider = document.getElementById('ultraSlider');

        if (slider) {
            slider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });
            slider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                if (touchStartX - touchEndX > 50) {
                    nextSlide();
                    startAutoSlide();
                }
                if (touchEndX - touchStartX > 50) {
                    prevSlide();
                    startAutoSlide();
                }
            }, {
                passive: true
            });

            // Pause on hover
            // slider.addEventListener('mouseenter', stopAutoSlide);
            // slider.addEventListener('mouseleave', startAutoSlide);
        }

        // Initialize: Set first slide active and START timer immediately
        goToSlide(0);
        startAutoSlide();
    });
</script>
