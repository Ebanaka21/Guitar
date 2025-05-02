<header id="header">
    <nav class=" z-50 w-full  py-3 bg-gradient-to-r from-yellow-300 to-black text-white">
        <div class="container mx-auto">
          <div class="w-full flex flex-col lg:flex-row">
              <div class="flex justify-between lg:flex-row">
                <a href="{{route ("welcome")}}">
                    <img src="{{ asset('storage/img/logo.svg') }}" height="100px" width="100px" alt="Логотип" class=" hover:scale-110"></a>
                  <div class="flex lg:hidden items-center gap-5">
                  </div>
              </div>
              <div class="hidden w-full lg:flex lg:pl-11 items-center text-center gap-9 " id="navbar-with-secondary-icon">
              <a class="" href="{{ route('products.index') }}" >Наши Курсы</a>
              <a class="" href="#inorect" >Часто задаваемые вопросы</a>
              </div>
              <div class="flex items-center gap-3 lg:flex-row">
            <!-- Иконка для переключения темы -->

                <a href="{{ route('cart.index') }}" class="flex items-center justify-center text-gray-500 transition-all duration-300 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height=35" viewBox="0 0 24 24" style="fill: rgba(192, 192, 192);transform: ;msFilter:;"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg>
                  </a>
                  <a href="javascript:;"
                      class="flex items-center justify-center text-gray-500 transition-all duration-300  hover:scale-100">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(192, 192, 192) ;transform: ;msFilter:;"><path d="M5 12H4v8a2 2 0 0 0 2 2h5V12H5zm13 0h-5v10h5a2 2 0 0 0 2-2v-8h-2zm.791-5A4.92 4.92 0 0 0 19 5.5C19 3.57 17.43 2 15.5 2c-1.622 0-2.705 1.482-3.404 3.085C11.407 3.57 10.269 2 8.5 2 6.57 2 5 3.57 5 5.5c0 .596.079 1.089.209 1.5H2v4h9V9h2v2h9V7h-3.209zM7 5.5C7 4.673 7.673 4 8.5 4c.888 0 1.714 1.525 2.198 3H8c-.374 0-1 0-1-1.5zM15.5 4c.827 0 1.5.673 1.5 1.5C17 7 16.374 7 16 7h-2.477c.51-1.576 1.251-3 1.977-3z"></path></svg>
                          <path
                              d="M5 11H19M5 11C4.05719 11 3.58579 11 3.29289 10.7071C3 10.4142 3 9.94281 3 9V8C3 7.05719 3 6.58579 3.29289 6.29289C3.58579 6 4.05719 6 5 6H19C19.9428 6 20.4142 6 20.7071 6.29289C21 6.58579 21 7.05719 21 8V9C21 9.94281 21 10.4142 20.7071 10.7071C20.4142 11 19.9428 11 19 11M5 11L5 17C5 18.8856 5 19.8284 5.58579 20.4142C6.17157 21 7.11438 21 9 21H15C16.8856 21 17.8284 21 18.4142 20.4142C19 19.8284 19 18.8856 19 17V11M12 6V21M12 6V4.5M12 6H9V4.5C9 3.67157 9.67157 3 10.5 3C11.3284 3 12 3.67157 12 4.5M12 6H15V4.5C15 3.67157 14.3284 3 13.5 3C12.6716 3 12 3.67157 12 4.5"
                              stroke="currentColor" stroke-width="1.6"></path>
                      </svg>
                  </a>
                  <div class="dropdown relative inline-flex">
                      <button type="button" data-target="dropdown-2"
                          class="dropdown-toggle inline-flex justify-center items-center gap-1 text-sm text-gray-500 rounded-full cursor-pointer font-semibold text-center shadow-xs transition-all duration-300 hover:text-gray-900">
                      </button>

                      <div x-data="{ open: false }" class="relative">
                        <!-- Кнопка для открытия меню -->
                        <button @click="open = !open" class="flex items-center focus:outline-none">
                            <!-- Иконка пользователя -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(192, 192, 192 );transform: ;msFilter:;"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>
                            <svg class="dropdown-open:rotate-180 w-2.5 h-2.5" width="16" height="16" viewBox="0 0 16 16" style="fill: rgba(192, 192, 192 );"
                              fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                          </svg>
                        </button>


                        <!-- Выпадающее меню -->
                        <div x-show="open" @click.away="open = false" class="dropdown-menu rounded-xl shadow-lg bg-gray-700 absolute right-0 top-full w-max mt-2 z-40" aria-labelledby="dropdown-2">
                            <ul class="py-2">

                                <!-- Пункты меню для всех пользователей -->
                                    @auth
                                    <li>
                                        <p  class="block px-6 py-2 hover:bg-gray-500 text-white font-medium">Привет, {{ Auth::user()->name }}!</p>
                                        <a class="block px-6 py-2 hover:bg-gray-500 text-white font-medium" href="{{ route('dashboard') }}">
                                            Личный кабинет
                                        </a>
                                    </li>
                                    <li>
                                        <a class="block px-6 py-2 hover:bg-gray-500 text-white font-medium" href={{ route('profile.edit') }}">
                                            Профиль
                                        </a>
                                    </li>
                                    <!-- Форма для выхода -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                @endauth
                                <li>
                                    <a class="block px-6 py-2 hover:bg-gray-500 text-white font-medium" href="javascript:;">
                                        Уведомления
                                    </a>
                                </li>

                                <!-- Пункты меню для авторизованных пользователей -->
                                @auth
                                    <li>
                                        <a class="block px-6 py-2 hover:bg-white text-red-500 font-medium" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>
                                    </li>
                                    <!-- Форма для выхода -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                @endauth

                                <!-- Пункты меню для неавторизованных пользователей -->
                                @guest
                                    <li>
                                        <a class="block px-6 py-2 hover:bg-gray-500 text-white font-medium" href="{{ route('login') }}">
                                            Войти
                                        </a>
                                    </li>
                                    <li>
                                        <a class="block px-6 py-2 hover:bg-gray-500 text-white font-medium" href="{{ route('register') }}">
                                            Зарегистрироваться
                                        </a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        </nav>
</header>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const themeToggleButton = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');

    // Проверяем текущую тему из localStorage
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Устанавливаем начальную тему
    if (currentTheme === 'dark') {
        document.body.classList.add('dark');
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    }

    // Обработчик нажатия на кнопку для переключения темы
    themeToggleButton.addEventListener('click', () => {
        document.body.classList.toggle('dark');

        // Переключаем иконки
        if (document.body.classList.contains('dark')) {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
            localStorage.setItem('theme', 'dark');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
            localStorage.setItem('theme', 'light');
        }
    });
});

    </script>
