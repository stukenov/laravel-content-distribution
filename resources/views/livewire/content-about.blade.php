<div class="w-[1200px] mx-auto text-black font-serif flex mt-10">
    <div class="text-[16px] max-w-[33%] w-full">
        <img src="{{ asset('storage/' . $project->image) }}"
             class="w-[300px] h-[350px] object-cover shadow-sm rounded-[10px] mb-[20px]">
        <div class="space-y-2 text-gray-700">
            <div class="flex items-center">
                <span class="font-semibold w-32">Quality:</span>
                <span>{{ $project->quality }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold w-32">Episodes:</span>
                <span>
                    @php
                        $episodesCount = 0;
                        if ($project->episodes) {
                            $episodes = is_array($project->episodes) ? $project->episodes : json_decode($project->episodes, true);
                            $episodesCount = is_array($episodes) ? count($episodes) : 0;
                        }
                    @endphp
                    {{ $episodesCount }} {{ $episodesCount > 0 ? ($episodesCount == 1 ? 'эпизод' : ($episodesCount < 5 ? 'эпизода' : 'эпизодов')) : 'эпизодов' }}
                </span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold w-32">M&E tracks:</span>
                <span>{{ $project->mande ? 'Yes' : 'No' }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold w-32">M&E tracks lang:</span>
                <span>{{ $project->mande_lang ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold w-32">Year:</span>
                <span>{{ $project->year }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold w-32">Country:</span>
                <span>{{ $project->country }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold w-32">Genre:</span>
                <a class="text-blue-500 hover:text-blue-700 transition-colors" href="/about">{{ $project->genre }}</a>
            </div>
            <div class="flex items-center">
                <span class="font-semibold w-32">Director:</span>
                <a class="text-blue-500 hover:text-blue-700 transition-colors" href="/about">{{ $project->director }}</a>
            </div>
            @if($project->tags && count($project->tags) > 0)
            <div class="flex items-center mt-4">
                <span class="font-semibold w-32">Tags:</span>
                <div class="flex flex-wrap gap-2">
                    @foreach($project->tags as $tag)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="max-w-[66%] w-full">
        <h1 class="text-3xl font-bold mb-6">{{ $project->title }}</h1>
        
        <!-- Трейлеры -->
        @php
            $trailers = json_decode($project->trailers, true) ?? [];
        @endphp
        @if(count($trailers) > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Трейлеры</h2>
                
                <!-- Кнопки для трейлеров -->
                <ul class="flex gap-4 mb-4 trailer-buttons">
                    @foreach($trailers as $index => $trailer)
                        <li id="trailer{{ $index + 1 }}" 
                            class="text-center content-center w-[150px] h-[50px] flex items-center justify-center {{ $index === 0 ? 'bg-amber-300' : 'bg-white' }} cursor-pointer rounded-md shadow-sm hover:bg-amber-200 transition-colors"
                            onclick="changeVideo('{{ $trailer['url'] }}', this, {{ $index }})">
                            Трейлер {{ $index + 1 }}
                        </li>
                    @endforeach
                </ul>
                
                <!-- Видео плеер -->
                <div class="relative pb-[56.25%] h-0 bg-gray-100 rounded-lg overflow-hidden mb-6">
                    @if(count($trailers) > 0)
                        @if(str_contains($trailers[0]['url'], 'youtube.com') || str_contains($trailers[0]['url'], 'youtu.be'))
                            <iframe id="video-frame" class="absolute top-0 left-0 w-full h-full"
                                    src="{{ $trailers[0]['url'] }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        @else
                            <video id="video-player" class="absolute top-0 left-0 w-full h-full" controls>
                                <source src="{{ $trailers[0]['url'] }}" type="video/mp4">
                                Ваш браузер не поддерживает видео.
                            </video>
                        @endif
                    @endif
                </div>
            </div>
        @endif

        <!-- Описание -->
        <div class="prose max-w-none">
            <p class="text-gray-700 leading-relaxed">
                {{ $project->description }}
            </p>
        </div>

        <script>
            function changeVideo(videoUrl, element, index) {
                const iframe = document.getElementById('video-frame');
                const videoPlayer = document.getElementById('video-player');
                
                if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
                    if (videoPlayer) {
                        videoPlayer.style.display = 'none';
                    }
                    if (iframe) {
                        iframe.style.display = 'block';
                        iframe.src = videoUrl;
                    }
                } else {
                    if (iframe) {
                        iframe.style.display = 'none';
                    }
                    if (videoPlayer) {
                        videoPlayer.style.display = 'block';
                        videoPlayer.src = videoUrl;
                        videoPlayer.load();
                    }
                }
                
                // Обновляем стили кнопок
                const buttons = document.querySelectorAll('.trailer-buttons li');
                buttons.forEach(button => {
                    button.classList.remove('bg-amber-300');
                    button.classList.add('bg-white');
                });
                
                element.classList.add('bg-amber-300');
                element.classList.remove('bg-white');
            }
        </script>
    </div>
</div>
