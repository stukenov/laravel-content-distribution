<div class="w-full h-[500px] bg-gray-200">

        <div class="relative m-auto">
            <!-- Контейнер для картинок -->
            <div class="h-[500px] flex overflow-hidden" id="image-container">
                @foreach ($images as $image)
                    <a href="/content/{{ $image->title }}" class="min-w-full h-full bg-cover bg-top"
                       style="background-image: url('{{  $image -> slider_image }}');" id="slide-{{ $image -> slider_image }}"></a>

                @endforeach
            </div>
            <!-- Контейнер для кнопок -->
            <div class="bg-cyan-600  opacity-100 w-[250px] absolute top-0  right-[5%] bottom-0 justify-end flex">
                <div class="h-full  w-full grid content-end ">
                    <div class="bg-blue-800 initial w-full h-full"></div>
                    <div class="pb-[10px]">
                        @foreach ($images as $index => $image)
                            <button class="flex w-full h-[55px] border-b-1 border-b-blue-400 justify-items-start p-[10px] items-center  slide-button"
                                    data-index="{{ $index }}" onmouseover="scrollToImage({{ $index }})">
                                <div class="w-[30px] h-[35px] bg-blue-100 rounded-tl-[10px] rounded-br-[10px] rounded-[2px] mr-[10px] items-center flex justify-center">-</div>
                                <div class="text-start font-stretch-200% mt-[-8px] pt-0 pl-[2px]">
                                    <div class="text-[10px]">{{$image->slug}}</div>
                                    <div class="font-bold text-[16px]">{{$image->title}}</div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    function scrollToImage(index) {
        const container = document.getElementById('image-container');
        container.scroll({
            left: container.offsetWidth * index,
            behavior: 'smooth'
        });

        // Удаляем активный фон со всех кнопок
        document.querySelectorAll('.slide-button').forEach(button => {
            button.style.backgroundColor = ''; // Сбрасываем цвет фона
            button.style.color = ''; // Сбрасываем цвет текста
            button.style.opacity = '1'; // Устанавливаем непрозрачность текста
        });

        // Добавляем активный фон текущей кнопке
        const activeButton = document.querySelector(`.slide-button[data-index="${index}"]`);
        activeButton.style.backgroundColor = '#3b82f6'; // Фон активной кнопки
        activeButton.style.color = 'white'; // Цвет текста активной кнопки
        activeButton.style.opacity = '1'; // Явная непрозрачность текста
    }

    // По умолчанию выделяем первый слайд при загрузке страницы
    document.addEventListener('DOMContentLoaded', () => {
        scrollToImage(0);
    });
</script>
