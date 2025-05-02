@auth
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <textarea name="content" class="w-full border rounded p-2" required></textarea>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">
        Отправить
    </button>
</form>
@else
<p>Чтобы оставить комментарий, <a href="{{ route('login') }}" class="text-blue-500">войдите</a>.</p>
@endauth
