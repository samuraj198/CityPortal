<div id="regForm" class="regForm hidden w-full h-full bg-black/80 z-50 flex items-start justify-center fixed left-0 top-0">
    <form method="POST" class="relative bg-white p-10 mt-20 rounded-lg w-[40%] flex flex-col gap-5 items-center justify-center" action="{{ route('register') }}">
        @csrf
        <a onclick="closeRegModal()" class="absolute right-5 top-3 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold">РЕГИСТРАЦИЯ</h2>
        <div class="fioBlock w-full">
            <input id="inputName" required name="fio" type="text" placeholder="Введите ваше ФИО" class="w-full border-[1px] border-black rounded-lg px-4 py-3">
            <p id="fioError" class="text-red-500"></p>
        </div>
        <div class="loginBlock w-full">
            <input id="inputLoginReg" required name="loginReg" type="text" placeholder="Введите ваш логин" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
            <p id="loginRegError" class="text-red-500"></p>
        </div>
        <div class="emailBlock w-full">
            <input id="inputEmail" required name="email" type="text" placeholder="Введите вашу почту" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
            <p id="emailError" class="text-red-500"></p>
        </div>
        <div class="passwordBlock w-full">
            <input id="inputPasswordReg" required name="passwordReg" type="password" placeholder="Введите ваш пароль" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
            <p id="passwordRegError" class="text-red-500"></p>
        </div>
        <div class="confBlock w-full">
            <input id="inputConf" required name="passwordReg_confirmation" type="password" placeholder="Повторите пароль" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
            <p id="confError" class="text-red-500"></p>
        </div>
        <div class="checkBox flex gap-2">
            <input required type="checkbox">
            <p class="text-black/50">Соглашение на обработку персональных данных</p>
        </div>
        <x-button id="regButton" type="submit" text="Зарегистрироваться" />
        <p>Уже есть аккаунт? <a onclick="regToAuthModal()" class="text-button cursor-pointer">Войти</a></p>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p id="regError" class="text-center text-red-500">{{ $error }}</p>
            @endforeach
        @endif
    </form>
</div>
