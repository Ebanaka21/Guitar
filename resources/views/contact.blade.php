<form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Ваше имя</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div>
        <label for="message">Сообщение</label>
        <textarea name="message" id="message" rows="4" required></textarea>
    </div>

    <button type="submit">Отправить</button>
</form>
