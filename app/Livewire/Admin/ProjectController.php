<?php

namespace App\Livewire\Admin;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Projects;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProjectController extends Component
{
    use WithFileUploads;
    public $project;
    public $title;
    public $slug;
    public $description;
    public $content;
    public $image;
    public $trailers = [];
    public $episodes = [];
    public $episodes_count = 0;
    public $slider = 0;
    public $year;
    public $country;
    public $time;
    public $category_id;
    public $allCategories;
    public $slider_image;
    public $genre;
    public $quality;
    public $director;
    public $cast;
    public $subtitles=1;
    public $subtitles_lang;
    public $mande=1;
    public $mande_lang;
    public $author;
    public $update_cause;

    // Свойства для работы с тегами
    public $selectedTags = [];
    public $allTags;
    public $tagSearch = '';
    public $newTagName = '';
    public $filteredTags = [];
    public $showTagDropdown = false;

    // Свойства для автоподсказок стран
    public $countrySearch = '';
    public $showCountryDropdown = false;
    public $filteredCountries = [];
    
    // Список стран
    protected $countries = [
        'Австралия', 'Австрия', 'Азербайджан', 'Албания', 'Алжир', 'Ангола', 'Аргентина', 'Армения',
        'Беларусь', 'Бельгия', 'Болгария', 'Бразилия', 'Великобритания', 'Венгрия', 'Вьетнам',
        'Германия', 'Гонконг', 'Греция', 'Грузия', 'Дания', 'Египет', 'Израиль', 'Индия', 'Индонезия',
        'Иран', 'Ирландия', 'Исландия', 'Испания', 'Италия', 'Казахстан', 'Канада', 'Катар', 'Кипр',
        'Китай', 'Колумбия', 'Корея Южная', 'Латвия', 'Литва', 'Люксембург', 'Малайзия', 'Мексика',
        'Нидерланды', 'Новая Зеландия', 'Норвегия', 'ОАЭ', 'Польша', 'Португалия', 'Россия', 'Румыния',
        'Саудовская Аравия', 'Сербия', 'Сингапур', 'Словакия', 'Словения', 'США', 'Таиланд', 'Тайвань',
        'Турция', 'Узбекистан', 'Украина', 'Финляндия', 'Франция', 'Хорватия', 'Чехия', 'Чили',
        'Швейцария', 'Швеция', 'Эстония', 'Южная Африка', 'Япония'
    ];

    public $newTrailerFile;
    public $newEpisodeFile;

    public function mount($projectId = null)
    {
        $this->allCategories = Category::all();
        $this->allTags = Tag::all();
        
        // Устанавливаем первую доступную категорию по умолчанию
        if (!$projectId) {
            $defaultCategory = Category::first();
            if ($defaultCategory) {
                $this->category_id = $defaultCategory->id;
            }
        }
        
        if ($projectId) {
            $this->project = Projects::findOrFail($projectId);
            $this->title = $this->project->title;
            $this->author = $this->project->author;
            $this->time = $this->project->time;
            $this->category_id = $this->project->category_id;
            $this->slider_image = $this->project->slider_image;
            $this->slug = $this->project->slug;
            $this->description = $this->project->description;
            $this->content = $this->project->content;
            $this->image = $this->project->image;
            
            // Преобразуем трейлеры из JSON в массив
            $this->trailers = json_decode($this->project->trailers ?? '[]', true);
            
            // Преобразуем эпизоды из JSON в массив
            $this->episodes = json_decode($this->project->episodes ?? '[]', true);
            $this->episodes_count = count($this->episodes);
            
            $this->slider = $this->project->slider;
            $this->year = $this->project->year;
            $this->country = $this->project->country;
            $this->genre = $this->project->genre;
            $this->quality = $this->project->quality;
            $this->director = $this->project->director;
            $this->cast = $this->project->cast;
            $this->subtitles = $this->project->subtitles;
            $this->subtitles_lang = $this->project->subtitles_lang;
            $this->mande = $this->project->mande;
            $this->mande_lang = $this->project->mande_lang;
            $this->update_cause = $this->project->update_cause;

            // Загружаем теги проекта
            $this->selectedTags = $this->project->tags->pluck('id')->toArray();

            // Устанавливаем значение поиска страны
            $this->countrySearch = $this->project->country;
        }
    }

    public function addTrailer()
    {
        $this->trailers[] = [
            'url' => '',
            'file' => null
        ];
    }

    public function removeTrailer($index)
    {
        unset($this->trailers[$index]);
        $this->trailers = array_values($this->trailers);
    }

    public function addEpisode()
    {
        $this->episodes[] = '';
        $this->episodes_count = count($this->episodes);
    }

    public function removeEpisode($index)
    {
        unset($this->episodes[$index]);
        $this->episodes = array_values($this->episodes);
        $this->episodes_count = count($this->episodes);
    }

    public function searchTags()
    {
        if (strlen($this->tagSearch) >= 2) {
            $this->filteredTags = Tag::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->tagSearch) . '%'])
                ->whereNotIn('id', $this->selectedTags)
                ->get();
            $this->showTagDropdown = true;
        } else {
            $this->filteredTags = [];
            $this->showTagDropdown = false;
        }
    }
    
    public function addTag($tagId)
    {
        if (!in_array($tagId, $this->selectedTags)) {
            $this->selectedTags[] = $tagId;
        }
        $this->showTagDropdown = false;
        $this->tagSearch = '';
    }
    
    public function removeTag($tagId)
    {
        $this->selectedTags = array_diff($this->selectedTags, [$tagId]);
    }
    
    public function createTag()
    {
        if (!empty($this->newTagName)) {
            $tag = Tag::create([
                'name' => $this->newTagName,
                'slug' => Str::slug($this->newTagName)
            ]);
            
            $this->allTags = Tag::all(); // Обновляем список всех тегов
            $this->addTag($tag->id);
            $this->newTagName = '';
        }
    }

    public function updatedCountrySearch()
    {
        if (strlen($this->countrySearch) > 0) {
            $this->filteredCountries = collect($this->countries)
                ->filter(function($country) {
                    return str_contains(
                        mb_strtolower($country), 
                        mb_strtolower($this->countrySearch)
                    );
                })
                ->take(5)
                ->values()
                ->all();
            $this->showCountryDropdown = true;
        } else {
            $this->filteredCountries = [];
            $this->showCountryDropdown = false;
        }
    }
    
    public function selectCountry($country)
    {
        $this->country = $country;
        $this->countrySearch = $country;
        $this->showCountryDropdown = false;
    }

    public function save()
    {
        // Определяем базовые правила валидации
        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:projects,slug,' . ($this->project ? $this->project->id : 'NULL'),
            'description' => 'required',
            'time' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'trailers' => 'nullable|array',
            'episodes' => 'nullable|array',
            'episodes_count' => 'nullable|integer',
            'slider' => 'nullable|boolean',
            'year' => 'nullable|integer',
            'country' => 'nullable|string',
            'genre' => 'nullable|string',
            'quality' => 'nullable|string',
            'director' => 'nullable|string',
            'cast' => 'nullable|string',
            'subtitles' => 'nullable|boolean',
            'subtitles_lang' => 'nullable|string',
            'mande' => 'nullable|boolean',
            'mande_lang' => 'nullable|string',
            'update_cause' => 'nullable|string',
        ];

        // Добавляем правила для изображений
        if (!$this->project) {
            // Для нового проекта
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['slider_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            // Для редактирования проекта
            if ($this->image && is_object($this->image)) {
                $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            }
            if ($this->slider_image && is_object($this->slider_image)) {
                $rules['slider_image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            }
        }

        // Добавляем правила для видео в трейлерах
        foreach ($this->trailers as $index => $trailer) {
            if (isset($trailer['file']) && $trailer['file']) {
                $rules["trailers.{$index}.file"] = 'mimes:mp4|max:102400'; // 100MB максимум
            }
        }

        $validatedData = $this->validate($rules);

        // Обработка основного изображения
        if ($this->image && is_object($this->image)) {
            $imagePath = $this->image->store('projects', 'public');
            $validatedData['image'] = $imagePath;
        } elseif (!$this->project && !$this->image) {
            throw ValidationException::withMessages([
                'image' => ['Изображение обязательно для нового проекта']
            ]);
        }

        // Обработка изображения для слайдера
        if ($this->slider_image && is_object($this->slider_image)) {
            $slider_imagePath = $this->slider_image->store('projects', 'public');
            $validatedData['slider_image'] = $slider_imagePath;
            $validatedData['slider'] = 1;
        } elseif (!$this->project && !$this->slider_image) {
            throw ValidationException::withMessages([
                'slider_image' => ['Изображение для слайдера обязательно для нового проекта']
            ]);
        }

        // Обработка трейлеров
        $processedTrailers = [];
        foreach ($this->trailers as $trailer) {
            if (isset($trailer['file']) && $trailer['file']) {
                // Если загружен файл, сохраняем его
                $trailerPath = $trailer['file']->store('trailers', 'public');
                $processedTrailers[] = [
                    'url' => asset('storage/' . $trailerPath),
                    'type' => 'file'
                ];
            } elseif (!empty($trailer['url'])) {
                // Если указан URL
                $processedTrailers[] = [
                    'url' => $trailer['url'],
                    'type' => 'url'
                ];
            }
        }
        $validatedData['trailers'] = json_encode($processedTrailers);

        // Сохраняем эпизоды как JSON
        $validatedData['episodes'] = json_encode($this->episodes);
        $validatedData['episodes_count'] = count($this->episodes);

        $validatedData['author'] = Auth::user()->name;
        
        if ($this->project) {
            if (!$this->image) {
                unset($validatedData['image']);
            }
            if (!$this->slider_image) {
                unset($validatedData['slider_image']);
                $validatedData['slider'] = $this->project->slider;
            }
            
            $this->project->update($validatedData);
            $this->project->tags()->sync($this->selectedTags);
        } else {
            $project = Projects::create($validatedData);
            $project->tags()->sync($this->selectedTags);
        }
        
        $this->resetFields();
        session()->flash('message', 'Проект успешно сохранен.');
    }
    
    public function resetFields()
    {
        $this->title = '';
        $this->slug = '';
        $this->description = '';
        $this->content = '';
        $this->image = null;
        $this->trailers = [];
        $this->episodes = [];
        $this->episodes_count = 0;
        $this->slider = 0;
        $this->year = '';
        $this->country = '';
        $this->genre = '';
        $this->quality = '';
        $this->director = '';
        $this->cast = '';
        $this->subtitles = 1;
        $this->subtitles_lang = '';
        $this->mande = 1;
        $this->mande_lang = '';
        $this->slider_image = null;
        $this->category_id = null;
        $this->update_cause = '';
        $this->selectedTags = [];
        $this->tagSearch = '';
        $this->newTagName = '';
        $this->filteredTags = [];
        $this->showTagDropdown = false;
        $this->countrySearch = '';
        $this->showCountryDropdown = false;
        $this->filteredCountries = [];
    }
    
    public function render()
    {
        return view('livewire.admin.project-controller', [
            'categories' => Category::all(),
            'allTags' => $this->allTags,
            'filteredTags' => $this->filteredTags
        ])->layout('components.layouts.admin');
    }

    public function updatedTrailers($value, $key)
    {
        if (str_contains($key, 'file')) {
            $index = explode('.', $key)[0];
            $this->validate([
                "trailers.{$index}.file" => 'required|file|mimetypes:video/mp4|max:102400'
            ]);
        }
    }

    public function updatedEpisodes($value, $key)
    {
        if (is_object($value) && method_exists($value, 'temporaryUrl')) {
            $this->validate([
                "episodes.{$key}" => 'required|file|mimetypes:video/mp4|max:102400'
            ]);
        }
    }

    public function updatedNewTrailerFile()
    {
        $this->validate([
            'newTrailerFile' => 'required|file|mimetypes:video/mp4|max:102400'
        ]);

        $this->trailers[] = [
            'url' => '',
            'file' => $this->newTrailerFile
        ];

        $this->newTrailerFile = null;
    }

    public function updatedNewEpisodeFile()
    {
        $this->validate([
            'newEpisodeFile' => 'required|file|mimetypes:video/mp4|max:102400'
        ]);

        $this->episodes[] = $this->newEpisodeFile;
        $this->episodes_count = count($this->episodes);
        $this->newEpisodeFile = null;
    }
}
