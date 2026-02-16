<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Управление проектами</h1>
            <div class="flex gap-4">
                <a href="/admin/post" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Новый проект
                </a>
                <a href="/admin/content" class="inline-flex items-center px-4 py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-file-alt mr-2"></i>
                    Контент
                </a>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Список проектов</h2>
            <div class="flex gap-4">
                <div class="relative">
                    <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click="showOrderModal"
                    >
                        <i class="fas fa-sort-amount-down mr-2"></i>
                        Сортировка: {{$selected_order}}
                    </button>
                    @if($show_order_modal)
                        <div class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical">
                                @foreach($orders as $key=>$sort)
                                    <button
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        type="button" 
                                        wire:click="orderby({{$key}})"
                                    >
                                        {{$sort}}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="relative">
                    <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click="showSortModal"
                    >
                        <i class="fas fa-sort mr-2"></i>
                        По: {{$selected_sort}}
                    </button>
                    @if($show_sort_modal)
                        <div class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical">
                                @foreach($sorts as $key=>$sort)
                                    <button
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        type="button" 
                                        wire:click="sortby({{$key}})"
                                    >
                                        {{$sort}}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Изображение</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Описание</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Категория</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Автор</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Год</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Страна</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($projects as $project)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$loop->iteration}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{$project->slug}}" class="h-10 w-10 rounded-md object-cover">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $project->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $project->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->category ? $project->category->name : 'Нет категории' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->year }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->country }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.redact',['projectId' => $project->id]) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50">
                                        <i class="fas fa-edit mr-1"></i> Редактировать
                                    </a>
                                    <button 
                                        class="inline-flex items-center px-3 py-1 border border-transparent text-white bg-red-600 rounded-md hover:bg-red-700"
                                        wire:click="delete({{ $project->id }})" 
                                        wire:confirm="Вы уверены, что хотите удалить этот проект?">
                                        <i class="fas fa-trash mr-1"></i> Удалить
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $projects->links() }}
        </div>
    </div>
</div>
