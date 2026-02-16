<div>
    <div class="min-h-screen bg-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 space-y-6">
                    <form wire:submit.prevent="save" class="space-y-6">
                        <!-- Основная информация -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="grid grid-cols-12 gap-6">
                                <!-- Левая колонка -->
                                <div class="col-span-8 space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Название</label>
                                            <input type="text" wire:model="title" 
                                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @error('title') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                                            <input type="text" wire:model="slug"
                                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @error('slug') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                                            <select wire:model="category_id"
                                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Описание</label>
                                        <textarea wire:model="description" rows="4"
                                                  class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                        @error('description') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Контент</label>
                                        <textarea wire:model="content" rows="4"
                                                  class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                        @error('content') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Правая колонка (Теги) -->
                                <div class="col-span-4 space-y-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($selectedTags as $tagId)
                                            @php
                                                $tag = $allTags->firstWhere('id', $tagId);
                                            @endphp
                                            @if($tag)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                    {{ $tag->name }}
                                                    <button type="button" wire:click="removeTag({{ $tagId }})" class="ml-2 text-blue-600 hover:text-blue-800">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <div class="relative">
                                        <input type="text" wire:model="tagSearch" wire:keyup="searchTags" 
                                               placeholder="Поиск тегов..." 
                                               class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        
                                        @if($showTagDropdown && count($filteredTags) > 0)
                                            <div class="absolute z-10 mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-200">
                                                <ul class="max-h-60 rounded-lg py-1 text-base overflow-auto focus:outline-none sm:text-sm">
                                                    @foreach($filteredTags as $tag)
                                                        <li class="cursor-pointer select-none relative py-2 px-3 hover:bg-blue-50" 
                                                            wire:click="addTag({{ $tag->id }})">
                                                            {{ $tag->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <input type="text" wire:model="newTagName" placeholder="Новый тег" 
                                               class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <button type="button" wire:click="createTag" 
                                                class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Медиа -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Основное изображение -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Основное изображение</label>
                                    <div class="flex flex-col items-center">
                                        <div class="w-full aspect-video border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden mb-4 bg-gray-50 hover:border-blue-500 transition-colors">
                                            @if($image)
                                                @if(is_object($image) && method_exists($image, 'temporaryUrl'))
                                                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                                @else
                                                    <img src="{{ asset('storage/' . $image) }}" class="w-full h-full object-cover">
                                                @endif
                                            @else
                                                <label class="w-full h-full cursor-pointer">
                                                    <input type="file" wire:model="image" class="hidden" accept="image/*">
                                                    <div class="flex flex-col items-center justify-center h-full">
                                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                                        <p class="text-sm text-gray-500">Нажмите или перетащите изображение</p>
                                                    </div>
                                                </label>
                                            @endif
                                        </div>
                                        @error('image') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Изображение для слайдера -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Изображение для слайдера</label>
                                    <div class="flex flex-col items-center">
                                        <div class="w-full aspect-video border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden mb-4 bg-gray-50 hover:border-blue-500 transition-colors">
                                            @if($slider_image)
                                                @if(is_object($slider_image) && method_exists($slider_image, 'temporaryUrl'))
                                                    <img src="{{ $slider_image->temporaryUrl() }}" class="w-full h-full object-cover">
                                                @else
                                                    <img src="{{ asset('storage/' . $slider_image) }}" class="w-full h-full object-cover">
                                                @endif
                                            @else
                                                <label class="w-full h-full cursor-pointer">
                                                    <input type="file" wire:model="slider_image" class="hidden" accept="image/*">
                                                    <div class="flex flex-col items-center justify-center h-full">
                                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                                        <p class="text-sm text-gray-500">Нажмите или перетащите изображение</p>
                                                    </div>
                                                </label>
                                            @endif
                                        </div>
                                        @error('slider_image') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Трейлеры -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex justify-end mb-4">
                                <button type="button" wire:click="addTrailer" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                    <i class="fas fa-film mr-2"></i>
                                    Добавить трейлер
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($trailers as $index => $trailer)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-center justify-end mb-2">
                                            <button type="button" wire:click="removeTrailer({{ $index }})" 
                                                    class="inline-flex items-center p-2 border border-transparent rounded-full text-red-600 hover:bg-red-100">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @if(isset($trailer['file']) && $trailer['file'])
                                            <div class="mb-4">
                                                <video controls class="w-full rounded-lg shadow-sm">
                                                    <source src="{{ $trailer['file']->temporaryUrl() }}" type="video/mp4">
                                                    Ваш браузер не поддерживает видео.
                                                </video>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">URL видео</label>
                                            <input type="url" wire:model="trailers.{{ $index }}.url" 
                                                   placeholder="https://example.com/video.mp4"
                                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        </div>
                                        @if(!isset($trailer['file']) || !$trailer['file'])
                                            <div class="mt-4">
                                                <label class="block cursor-pointer">
                                                    <div class="flex flex-col items-center justify-center w-full h-20 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition-colors">
                                                        <input type="file" wire:model="trailers.{{ $index }}.file" class="hidden" accept=".mp4">
                                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-xl mb-1"></i>
                                                        <p class="text-xs text-gray-500">Загрузить файл</p>
                                                    </div>
                                                </label>
                                            </div>
                                        @endif
                                        @error("trailers.{$index}.file") 
                                            <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                @endforeach

                                @if(count($trailers) > 0)
                                    <div class="order-last">
                                        <label class="block cursor-pointer">
                                            <div class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition-colors">
                                                <input type="file" wire:model="newTrailerFile" class="hidden" accept=".mp4">
                                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                                <p class="text-sm text-gray-500">Загрузить новый трейлер</p>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Эпизоды -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex justify-end mb-4">
                                <button type="button" wire:click="addEpisode"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                    <i class="fas fa-tv mr-2"></i>
                                    Добавить эпизод
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($episodes as $index => $episode)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-700">Эпизод {{ $index + 1 }}</span>
                                            <button type="button" wire:click="removeEpisode({{ $index }})" 
                                                    class="inline-flex items-center p-2 border border-transparent rounded-full text-red-600 hover:bg-red-100">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @if(is_object($episode) && method_exists($episode, 'temporaryUrl'))
                                            <div class="mb-4">
                                                <video controls class="w-full rounded-lg shadow-sm">
                                                    <source src="{{ $episode->temporaryUrl() }}" type="video/mp4">
                                                    Ваш браузер не поддерживает видео.
                                                </video>
                                            </div>
                                        @endif
                                        <div>
                                            <input type="url" wire:model="episodes.{{ $index }}" 
                                                   placeholder="https://example.com/episode.mp4"
                                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 mb-4">
                                            @if(!is_object($episode) || !method_exists($episode, 'temporaryUrl'))
                                                <label class="block cursor-pointer">
                                                    <div class="flex flex-col items-center justify-center w-full h-20 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition-colors">
                                                        <input type="file" wire:model="episodes.{{ $index }}" class="hidden" accept=".mp4">
                                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-xl mb-1"></i>
                                                        <p class="text-xs text-gray-500">Загрузить файл</p>
                                                    </div>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                @if(count($episodes) > 0)
                                    <div class="order-last">
                                        <label class="block cursor-pointer">
                                            <div class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition-colors">
                                                <input type="file" wire:model="newEpisodeFile" class="hidden" accept=".mp4">
                                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                                <p class="text-sm text-gray-500">Загрузить новый эпизод</p>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Дополнительная информация -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Дата</label>
                                    <input type="text" wire:model="time"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Год</label>
                                    <input type="text" wire:model="year"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Страна</label>
                                    <div class="relative">
                                        <input type="text" wire:model.live="countrySearch"
                                               placeholder="Начните вводить название страны..."
                                               class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        
                                        @if($showCountryDropdown && count($filteredCountries) > 0)
                                            <div class="absolute z-10 mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-200">
                                                <ul class="max-h-60 rounded-lg py-1 text-base overflow-auto focus:outline-none sm:text-sm">
                                                    @foreach($filteredCountries as $filteredCountry)
                                                        <li class="cursor-pointer select-none relative py-2 px-3 hover:bg-blue-50"
                                                            wire:click="selectCountry('{{ $filteredCountry }}')">
                                                            {{ $filteredCountry }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Жанр</label>
                                    <input type="text" wire:model="genre"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Качество</label>
                                    <input type="text" wire:model="quality"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Режиссер</label>
                                    <input type="text" wire:model="director"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Актеры</label>
                                    <input type="text" wire:model="cast"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Языки субтитров</label>
                                    <input type="text" wire:model="subtitles_lang"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Языки M&E треков</label>
                                    <input type="text" wire:model="mande_lang"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Причина обновления</label>
                                    <input type="text" wire:model="update_cause"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="flex items-center space-x-6">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="subtitles" 
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Субтитры</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="mande" 
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">M&E треки</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="slider" 
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Показывать в слайдере</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Кнопки действий -->
                        <div class="flex justify-end gap-4">
                            <button type="button" wire:click="resetFields" 
                                    class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <i class="fas fa-undo mr-2"></i>
                                Сбросить
                            </button>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
