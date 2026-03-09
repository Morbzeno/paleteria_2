<h1>Recuperar contraseña</h1>

@if (session('status'))
    <div>
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <label>Email</label>
    <input type="email" name="email" required>

    <button type="submit">
        Enviar enlace de recuperación
    </button>
</form>