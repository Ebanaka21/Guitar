<div
    x-data="{ isOpen: false, isVisible: false }"
    x-init="
        window.addEventListener('scroll', function () {
            if (window.scrollY > 800) {
                isVisible = true;
            } else {
                isVisible = false;
            }
        });

        Livewire.on('feedbackSubmitted', () => {
            isOpen = false;
        });
    "
>
    <!-- Кнопка для открытия модального окна -->
    <div
        x-show="isVisible"
        x-transition
        class="fixed bottom-8 right-36 bg-white p-4 rounded-lg shadow-xl border border-gray-200 z-50 max-w-xs"
    >
        <div class="flex flex-col space-y-3">
            <div class="text-gray-800">
                <p class="font-semibold">Не нашли нужный курс?</p>
                <p class="text-sm mt-1">Нашли баг или есть предложения? Напишите нам!</p>
            </div>
            <button
                @click="isOpen = true"
                class="bg-yellow-300 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-orange-600 transition-colors w-full"
            >
                Связаться
            </button>
        </div>
    </div>

    <!-- Модальное окно -->
    <div
        x-show="isOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="isOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4"
        x-cloak
    >
        <div
            x-show="isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.away="isOpen = false"
            class="bg-white rounded-lg shadow-xl w-full max-w-md"
        >
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-800">Обратная связь</h3>
                    <button @click="isOpen = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Форма -->
                <form wire:submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ваше имя</label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-yellow-300"
                            placeholder="Иван Иванов"
                            required
                        >
                        @error('name') <span class="text-red-500 text-sm">{{ $name }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input
                            type="email"
                            id="email"
                            wire:model="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="ivan@example.com"
                            required
                        >
                        @error('email') <span class="text-red-500 text-sm">{{ $email }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Сообщение</label>
                        <textarea
                            id="message"
                            wire:model="message"
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Опишите проблему или предложение..."
                            required
                        ></textarea>
                        @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-2">
                        <button
                            type="button"
                            @click="isOpen = false"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
                        >
                            Отмена
                        </button>
                        <button
                            type="submit"
                            class="px-6 py-2 bg-yellow-300 text-white rounded-lg hover:bg-orange-600 transition-colors flex items-center"
                        >
                            <span>Отправить</span>
                            <svg wire:loading class="animate-spin -mr-1 ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
