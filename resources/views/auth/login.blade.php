<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleries - Login</title>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    @error('invalidCredentials')
        <div>{{ $message }}</div>
    @enderror
</body>
</html>
