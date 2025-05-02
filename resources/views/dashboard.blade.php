@include('partials.header')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-container>
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8">Мои занятия</h1>

            <!-- Табы для переключения между активными и завершенными занятиями -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button id="activeTab" class="border-b-2 border-indigo-500 text-indigo-600 px-1 py-4 text-sm font-medium">
                        Активные
                    </button>
                    <button id="completedTab" class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium">
                        Завершенные
                    </button>
                </nav>
            </div>

            <!-- Активные занятия -->
            <div id="activeSection">
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold">Текущие занятия</h2>
                        <p class="text-sm text-gray-500 mt-1">Предстоящие и активные записи</p>
                    </div>

                    @if($activePurchases->isEmpty())
                        <div class="p-6 text-center text-gray-500">
                            Нет активных занятий
                        </div>
                    @else
                        <div class="divide-y divide-gray-200">
                            @foreach($activePurchases as $purchase)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-center">
                                    <!-- Изображение продукта -->
                                    <div class="w-20 h-20 flex-shrink-0 mb-4 md:mb-0">
                                        <img src="{{ asset('storage/' . $purchase->product->image) }}"
                                             alt="{{ $purchase->product->name }}"
                                             class="w-full h-full object-cover rounded-lg">
                                    </div>

                                    <!-- Информация о занятии -->
                                    <div class="flex-1 md:ml-6">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                            <div>
                                                <h3 class="text-lg font-medium">{{ $purchase->product->name }}</h3>
                                                <p class="text-gray-600">Бренд: {{ $purchase->brand->name }}</p>
                                                <p class="text-gray-600 mt-1">
                                                    <span class="font-medium">{{ $purchase->product->price }} ₽</span> ×
                                                    <span class="font-medium">{{ $purchase->quantity }} шт.</span>
                                                </p>
                                            </div>

                                            <!-- Дата и время -->
                                            <div class="mt-4 md:mt-0 md:text-right">
                                                <p class="text-gray-600">
                                                    <span class="font-medium">{{ $purchase->date->format('d.m.Y') }}</span> в
                                                    <span class="font-medium">{{ $purchase->time_slot }}</span>
                                                </p>
                                                <p class="text-sm {{ $purchase->status === 'confirmed' ? 'text-green-600' : 'text-yellow-600' }}">
                                                    {{ $purchase->status === 'confirmed' ? 'Подтверждено' : 'Ожидает подтверждения' }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Действия -->
                                        <div class="mt-4 flex space-x-4">
                                            <button onclick="cancelPurchase({{ $purchase->id }})"
                                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                Отменить
                                            </button>
                                            <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                Подробнее
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Завершенные занятия -->
            <div id="completedSection" class="hidden">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold">История занятий</h2>
                        <p class="text-sm text-gray-500 mt-1">Завершенные и пройденные записи</p>
                    </div>

                    @if($completedPurchases->isEmpty())
                        <div class="p-6 text-center text-gray-500">
                            Нет завершенных занятий
                        </div>
                    @else
                        <div class="divide-y divide-gray-200">
                            @foreach($completedPurchases as $purchase)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-center">
                                    <!-- Изображение продукта -->
                                    <div class="w-20 h-20 flex-shrink-0 mb-4 md:mb-0">
                                        <img src="{{ asset('storage/' . $purchase->product->image) }}"
                                             alt="{{ $purchase->product->name }}"
                                             class="w-full h-full object-cover rounded-lg">
                                    </div>

                                    <!-- Информация о занятии -->
                                    <div class="flex-1 md:ml-6">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                            <div>
                                                <h3 class="text-lg font-medium">{{ $purchase->product->name }}</h3>
                                                <p class="text-gray-600">Бренд: {{ $purchase->brand->name }}</p>
                                                <p class="text-gray-600 mt-1">
                                                    <span class="font-medium">{{ $purchase->product->price }} ₽</span> ×
                                                    <span class="font-medium">{{ $purchase->quantity }} шт.</span>
                                                </p>
                                            </div>

                                            <!-- Дата и время -->
                                            <div class="mt-4 md:mt-0 md:text-right">
                                                <p class="text-gray-600">
                                                    <span class="font-medium">{{ $purchase->date->format('d.m.Y') }}</span> в
                                                    <span class="font-medium">{{ $purchase->time_slot }}</span>
                                                </p>
                                                <p class="text-sm text-green-600">
                                                    Завершено
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Действия -->
                                        <div class="mt-4 flex space-x-4">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                Подробнее
                                            </a>
                                            <button onclick="repeatPurchase({{ $purchase->id }})"
                                                    class="text-green-600 hover:text-green-800 text-sm font-medium">
                                                Повторить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-container>

@include('partials.footer')

<script>
    // Переключение между табами
    document.getElementById('activeTab').addEventListener('click', function() {
        document.getElementById('activeSection').classList.remove('hidden');
        document.getElementById('completedSection').classList.add('hidden');
        this.classList.add('border-indigo-500', 'text-indigo-600');
        this.classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('completedTab').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('completedTab').classList.remove('border-indigo-500', 'text-indigo-600');
    });

    document.getElementById('completedTab').addEventListener('click', function() {
        document.getElementById('activeSection').classList.add('hidden');
        document.getElementById('completedSection').classList.remove('hidden');
        this.classList.add('border-indigo-500', 'text-indigo-600');
        this.classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('activeTab').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('activeTab').classList.remove('border-indigo-500', 'text-indigo-600');
    });

    // Отмена покупки
    function cancelPurchase(purchaseId) {
        if (!confirm('Вы уверены, что хотите отменить эту запись?')) return;

        fetch(`/purchases/${purchaseId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Ошибка при отмене записи');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Произошла ошибка');
        });
    }

    // Повтор покупки
    function repeatPurchase(purchaseId) {
        fetch(`/purchases/${purchaseId}/repeat`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/cart'; // Перенаправляем в корзину
            } else {
                alert(data.message || 'Ошибка при повторной записи');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Произошла ошибка');
        });
    }
</script>
