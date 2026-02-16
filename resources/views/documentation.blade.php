<x-layouts.guest>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-black">Документация по Laravel</h1>

        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2 text-black">Основные команды Laravel</h2>
            <div class="mb-4">
                <h3 class="font-bold text-black">Создание проекта</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">composer create-project laravel/laravel example-app</code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Запуск сервера</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">php artisan serve</code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Работа с миграциями</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black"># Создание миграции
php artisan make:migration create_users_table

# Запуск миграций
php artisan migrate

# Откат последней миграции
php artisan migrate:rollback

# Откат всех миграций и повторный запуск
php artisan migrate:refresh

# Сброс всех миграций и запуск заново
php artisan migrate:fresh</code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Создание моделей и контроллеров</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black"># Создание модели
php artisan make:model User

# Создание контроллера
php artisan make:controller UserController

# Создание ресурсного контроллера
php artisan make:controller UserController --resource

# Создание API контроллера
php artisan make:controller API/UserController --api

# Создание Livewire компонента
php artisan make:livewire ShowContent</code></pre>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2 text-black">Основные концепции Laravel</h2>
            <div class="mb-4">
                <h3 class="font-bold text-black">Маршрутизация (routes/web.php)</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);</code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Модели (app/Models)</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">class User extends Model
{
    protected $fillable = ['name', 'email'];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}</code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Миграции</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamps();
    });
}</code></pre>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2 text-black">Работа с базой данных</h2>
            <div class="mb-4">
                <h3 class="font-bold text-black">Eloquent запросы</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">// Получение всех записей
$users = User::all();

// Поиск по условию
$user = User::where('email', 'test@example.com')->first();

// Создание
User::create(['name' => 'John']);

// Обновление
$user->update(['name' => 'Jane']);

// Удаление
$user->delete();</code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Отношения</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">// One-to-Many
public function posts()
{
    return $this->hasMany(Post::class);
}

// Many-to-Many
public function roles()
{
    return $this->belongsToMany(Role::class);
}</code></pre>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2 text-black">Middleware и Валидация</h2>
            <div class="mb-4">
                <h3 class="font-bold text-black">Middleware</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">// Регистрация middleware
protected $middleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
];

// Использование в маршрутах
Route::get('/admin', function () {
    // ...
})->middleware('auth');</code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Валидация</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
    ]);
}</code></pre>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2 text-black">Blade шаблоны и кэширование</h2>
            <div class="mb-4">
                <h3 class="font-bold text-black">Blade шаблоны</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black"><x-layouts.guest>
    <div class="container">
        @foreach($users as $user)
            <div>{{ $user['name'] }}</div>
        @endforeach
    </div>
</x-layouts.guest></code></pre>
            </div>
            <div class="mb-4">
                <h3 class="font-bold text-black">Кэширование</h3>
                <pre class="bg-gray-100 p-2 rounded"><code class="text-black">// Кэширование
Cache::put('key', 'value', 3600);

// Получение из кэша
$value = Cache::get('key');</code></pre>
            </div>
        </div>
    </div>
</x-layouts.guest> 