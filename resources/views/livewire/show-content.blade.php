<div class="m-auto pb-[50px] w-[80%] text-black font-serif">
    @if($category == null)
        @foreach($categories_with_projects as $category)
            <div class="m-auto max-w-[1200px] pt-[30px] pb-[10px]">
                <div class="py-6">
                    <span class="py-8 text-2xl font-bold">{{ $category['name'] }}</span>
                </div>
                <div class="flex flex-wrap justify-start gap-4 font-extrabold">
                    @forelse($category['projects'] as $project)
                        <a href="/content/{{ $project->title }}" class="project-img hover:text-cyan-400 w-[300px]">
                            <img src="{{ asset('storage/' . $project->image) }}"
                                 class="w-[300px] h-[350px] object-cover rounded-xl border-[1px]">
                            <p class="pt-[10px]">{{ $project->title }}</p>
                        </a>
                    @empty
                        <div>
                            <label class="text-[14px] font-light">Данная категория пустая</label>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    @else
        @include('livewire.content')
    @endif
</div>
