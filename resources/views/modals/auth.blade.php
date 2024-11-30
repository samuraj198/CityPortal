<div id="authForm" class="authForm hidden w-full h-full bg-black/80 z-50 flex items-start justify-center fixed left-0 top-0">
    <form method="POST" class="relative bg-white p-10 mt-20 rounded-lg w-[40%] flex flex-col gap-5 items-center justify-center" action="{{ url('auth') }}">
        @csrf
        <a onclick="closeAuthModal()" class="absolute right-5 top-3 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold">АВТОРИЗАЦИЯ</h2>
        <div class="loginBlock w-full">
            <input id="inputLogin" required name="login" type="text" placeholder="Введите ваш логин" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
            <p id="loginError" class="text-red-500"></p>
        </div>
        <div class="passwordBlock w-full">
            <input id="inputPassword" required name="password" type="password" placeholder="Введите ваш пароль" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
            <p id="passwordError" class="text-red-500"></p>
        </div>
        <x-button id="authButton" type="submit" text="Войти" />
        <p>Нет аккаунта? <a onclick="authToRegModal()" class="text-button cursor-pointer">Зарегистрироваться</a></p>
        @if(session('authError'))
            <p id="authError" class="text-red-500 text-center">{{ session('authError') }}</p>
        @endif
    </form>
</div>
