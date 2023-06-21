<!DOCTYPE html>
<html>

<head></head>

<body>
    <div>
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>