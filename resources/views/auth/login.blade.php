<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-orange-400 via-orange-500 to-amber-500">

    <div class="bg-white/90 backdrop-blur p-8 rounded-xl shadow-lg w-full max-w-md">

        {{-- TITLE --}}
        <h2 class="text-2xl font-bold text-center mb-1 text-orange-600">
            Welcome Back
        </h2>
        <p class="text-center text-gray-500 mb-6">
            Login to Aspiration System
        </p>

        <form method="POST" action="/login">
            @csrf

            {{-- ROLE --}}
            <label class="block mb-1 text-sm font-semibold text-gray-700">
                Login as
            </label>
            <select name="role" id="role"
                    class="w-full p-2 mb-4 border rounded focus:ring-2 focus:ring-orange-400"
                    required onchange="toggleClass()">
                <option value="">-- Select Role --</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>

            {{-- NAME --}}
            <label class="block mb-1 text-sm font-semibold text-gray-700">
                Name
            </label>
            <input type="text" name="name" placeholder="Your name"
                   class="w-full p-2 mb-4 border rounded
                          focus:ring-2 focus:ring-orange-400"
                   required>

            {{-- CLASS (ONLY STUDENT) --}}
            <div id="classField" class="hidden">
                <label class="block mb-1 text-sm font-semibold text-gray-700">
                    Class
                </label>
                <input type="text" name="class" placeholder="e.g. XII RPL"
                       class="w-full p-2 mb-4 border rounded
                              focus:ring-2 focus:ring-orange-400">
            </div>

            {{-- PASSWORD --}}
            <label class="block mb-1 text-sm font-semibold text-gray-700">
                Password
            </label>
            <input type="password" name="password" placeholder="••••••••"
                   class="w-full p-2 mb-4 border rounded
                          focus:ring-2 focus:ring-orange-400"
                   required>

            {{-- ERROR --}}
            @if ($errors->any())
                <p class="text-red-500 text-sm mb-3 text-center">
                    {{ $errors->first() }}
                </p>
            @endif

            {{-- BUTTON --}}
            <button
                class="w-full py-2 rounded text-white font-semibold
                       bg-gradient-to-r from-orange-500 to-amber-500
                       hover:from-orange-600 hover:to-amber-600
                       transition duration-200">
                Login
            </button>
        </form>

        {{-- FOOTER --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} School Aspiration System
        </p>
    </div>

<script>
function toggleClass() {
    const role = document.getElementById('role').value;
    const classField = document.getElementById('classField');

    if (role === 'student') {
        classField.classList.remove('hidden');
    } else {
        classField.classList.add('hidden');
    }
}
</script>

</body>
</html>