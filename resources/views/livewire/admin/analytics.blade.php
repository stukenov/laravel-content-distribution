<div class="p-6">
    <h1 class="text-2xl font-bold mb-8">Аналитика</h1>
    
    <!-- Общая статистика -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Всего проектов</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalProjects }}</p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-full">
                    <i class="fas fa-film text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Пользователей</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Проекты по категориям -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4">Проекты по категориям</h2>
            <div class="space-y-4">
                @foreach($projectsByCategory as $category)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">{{ $category->name }}</span>
                        <div class="flex items-center">
                            <span class="text-gray-900 font-medium">{{ $category->projects_count }}</span>
                            <div class="ml-2 w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ ($category->projects_count / $totalProjects) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Популярные теги -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4">Популярные теги</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($popularTags as $tag)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                        {{ $tag->name }}
                        <span class="ml-2 bg-indigo-200 px-2 py-0.5 rounded-full text-xs">
                            {{ $tag->projects_count }}
                        </span>
                    </span>
                @endforeach
            </div>
        </div>
        
        <!-- Последние проекты -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4">Последние добавления</h2>
            <div class="space-y-4">
                @foreach($recentProjects as $project)
                    <div class="flex items-center space-x-4">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-film text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-900">{{ $project->title }}</p>
                            <p class="text-sm text-gray-500">{{ $project->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Статистика по годам -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4">По годам</h2>
            <div class="space-y-4">
                @foreach($projectsByYear as $yearStat)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">{{ $yearStat->year }}</span>
                        <div class="flex items-center">
                            <span class="text-gray-900 font-medium">{{ $yearStat->count }}</span>
                            <div class="ml-2 w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ ($yearStat->count / $totalProjects) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Статистика по странам -->
        <div class="bg-white rounded-xl shadow-sm p-6 col-span-2">
            <h2 class="text-lg font-semibold mb-4">По странам</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach($projectsByCountry as $countryStat)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">{{ $countryStat->country }}</span>
                        <div class="flex items-center">
                            <span class="text-gray-900 font-medium">{{ $countryStat->count }}</span>
                            <div class="ml-2 w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ ($countryStat->count / $totalProjects) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div> 