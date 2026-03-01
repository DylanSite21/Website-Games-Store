<div class="ultra-slider">
    @if ($games && count($games) > 0)

        @foreach ($games as $index => $game)
            <input type="radio" name="ultra-slider" id="ultra-slide{{ $index }}"
                {{ $index === 0 ? 'checked' : '' }}>
        @endforeach

        <div class="ultra-slides">
            @foreach ($games as $index => $game)
                <div class="ultra-slide">
                    <div class="ultra-bg" style="background-image: url('{{ $game->cover_url }}');"></div>

                    <div class="ultra-overlay"></div>

                    <div class="ultra-content">
                        <h1>{{ $game->title }}</h1>
                        <p>{{ Str::limit($game->description, 120) }}</p>
                        <a href="{{ route('game.show', $game) }}" class="ultra-btn">
                            Explore Game
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation -->
        <button class="ultra-nav prev" onclick="changeUltra(-1)">&#10094;</button>
        <button class="ultra-nav next" onclick="changeUltra(1)">&#10095;</button>

        <!-- Dots -->
        <div class="ultra-dots">
            @foreach ($games as $index => $game)
                <label for="ultra-slide{{ $index }}" class="ultra-dot"></label>
            @endforeach
        </div>

        <!-- Progress -->
        {{-- <div class="ultra-progress">
            <div class="ultra-progress-bar"></div>
        </div> --}}

    @endif
</div>

<style>
    .ultra-slider {
        position: relative;
        width: 100%;
        height: 70vh;
        overflow: hidden;
        background: #000;
    }

    .ultra-slider input {
        display: none;
    }

    .ultra-slides {
        display: flex;
        height: 100%;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .ultra-slide {
        min-width: 100%;
        position: relative;
        overflow: hidden;
    }

    .ultra-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transform: scale(1);
        transition: transform 6s ease;
    }

    .ultra-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top,
                rgba(0, 0, 0, 0.85) 0%,
                rgba(0, 0, 0, 0.6) 40%,
                rgba(0, 0, 0, 0.3) 70%,
                transparent 100%);
    }

    .ultra-content {
        position: absolute;
        bottom: 120px;
        left: 8%;
        max-width: 600px;
        color: white;
        z-index: 5;
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s ease;
    }

    .ultra-content h1 {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        text-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
    }

    .ultra-content p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .ultra-btn {
        padding: 14px 40px;
        border-radius: 50px;
        font-weight: 600;
        background: linear-gradient(45deg, #0099ff, #0400ff);
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .ultra-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 81, 47, 0.5);
    }

    /* Navigation */
    .ultra-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        font-size: 1.6rem;
        cursor: pointer;
        z-index: 10;
    }

    .ultra-nav.prev {
        left: 30px;
    }

    .ultra-nav.next {
        right: 30px;
    }

    .ultra-nav:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Dots */
    .ultra-dots {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 15px;
    }

    .ultra-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: 0.3s;
    }

    .ultra-dot.active {
        background: white;
        transform: scale(1.3);
    }

    /* Progress Bar */
    .ultra-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
    }

    .ultra-progress-bar {
        height: 100%;
        width: 0%;
        background: white;
        transition: width 5s linear;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const radios = Array.from(document.querySelectorAll('input[name="ultra-slider"]'));
        const slides = document.querySelector('.ultra-slides');
        const progressBar = document.querySelector('.ultra-progress-bar');
        const dots = document.querySelectorAll('.ultra-dot');

        let current = 0;
        let timer;

        function updateSlider() {
            slides.style.transform = `translateX(-${current * 100}%)`;

            document.querySelectorAll('.ultra-content').forEach((content, i) => {
                content.style.opacity = i === current ? '1' : '0';
                content.style.transform = i === current ? 'translateY(0)' : 'translateY(40px)';
            });

            document.querySelectorAll('.ultra-bg').forEach((bg, i) => {
                bg.style.transform = i === current ? 'scale(1.1)' : 'scale(1)';
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === current);
            });

            progressBar.style.width = '0%';
            setTimeout(() => progressBar.style.width = '100%', 50);

            radios[current].checked = true;
        }

        function nextSlide() {
            current = (current + 1) % radios.length;
            updateSlider();
        }

        window.changeUltra = function(direction) {
            current = (current + direction + radios.length) % radios.length;
            updateSlider();
            resetTimer();
        };

        function resetTimer() {
            clearInterval(timer);
            timer = setInterval(nextSlide, 5000);
        }

        resetTimer();
        updateSlider();

    });
</script>
