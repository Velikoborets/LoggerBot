<h3>Жми кнопку и генерируй исключение</h3>
<form action="{{ route('showError') }}" method="POST">
    @csrf
    <button type="submit">Сгенерировать исключение</button>
</form>
