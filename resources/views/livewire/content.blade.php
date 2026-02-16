<div>
    <div class="m-auto max-w-[1200px] pt-[30px] pb-[10px]">

        <div class="py-6">
            <span class="py-8 text-2xl font-bold">{{$category_name}}</span>
        </div>

        <div class="flex flex-wrap justify-start gap-4 font-extrabold">

            @forelse($projects as $project)
                <a href="/content/{{ $project->title }}" class="project-img hover:text-cyan-400 w-[300px]">
                    <img src="{{ asset('storage/' . $project->image) }}" class="w-[300px] h-[350px] object-cover rounded-xl">
                    <p class="pt-[10px]">{{ $project->title }}</p>
                </a>
            @empty
                <div>
                    <p>Внимание! Обнаружена ошибка</p>
                    <label class="text-[14px] font-light">По данному адресу публикаций на сайте не найдено, либо у Вас нет доступа для просмотра информации по данному адресу.</label>
                </div>
            @endforelse
        </div>
    </div>


</div>
