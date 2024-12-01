<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ secure_asset('build/assets/app-BC_T7R89.css') }}">
    <script src="{{ secure_asset('build/assets/app-z-Rg4TxU.js') }}"></script>
    @include('modals.auth')
    @include('modals.register')
    <style>
        .input-error {
            border-color: red;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.8);
        }
        .input-error:focus {
            outline: none;
            border-color: red;
        }
        @foreach($problems as $problem)
        .card-{{$problem->id}} {
            background-position: center;
            background-size: cover;
            background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.4), rgba(0,0,0,0.8), rgba(0,0,0,1)), url("storage/problems/{{$problem->imgBefore}}");
            background-repeat: no-repeat;
            transition: transform 0.3s ease-in-out;
        }
        .card-{{$problem->id}}:before {
            content: "";
            border-radius: 0.5rem;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.4), rgba(0,0,0,0.8), rgba(0,0,0,1)), url("storage/problems/{{$problem->imgAfter}}");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: -1;
        }
        .card-{{$problem->id}}:hover:before {
            opacity: 1;
        }
        .card-{{$problem->id}}:hover {
            transform: scale(1.03);
        }
        @endforeach
    </style>
    <title>@yield('title')</title>
</head>
<body class="flex flex-col items-center">
    <header class="flex justify-between w-[90%] m-auto mt-10">
        <a href="{{ route('index') }}"><img src="img/logo/logo.svg" alt="Логотип"></a>
        <div class="buttons flex gap-5 items-center">
            @if(auth()->user())
                <a href="{{ secure_url('profile') }}"><x-button bg="bg-button" text="Профиль" /></a>
                <form method="POST" action="{{ secure_url('logout') }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" text="Выйти" bg="bg-black" />
                </form>

            @else
                <x-button onclick="openAuthModal()" bg="bg-button" text="Войти" />
                <x-button onclick="openRegModal()" bg="bg-button" text="Зарегистрироваться" />
            @endif
        </div>
    </header>
    <main class="flex flex-col items-center">
        @yield('content')
    </main>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputLogin = document.getElementById('inputLogin');
        const inputPassword = document.getElementById('inputPassword');
        const authButton = document.getElementById('authButton');

        const loginError = document.getElementById('loginError');
        const passwordError = document.getElementById('passwordError');

        const inputName = document.getElementById('inputName');
        const inputLoginReg = document.getElementById('inputLoginReg');
        const inputEmail = document.getElementById('inputEmail');
        const inputPasswordReg = document.getElementById('inputPasswordReg');
        const inputConf = document.getElementById('inputConf');
        const regButton = document.getElementById('regButton');

        const fioError = document.getElementById('fioError');
        const loginRegError = document.getElementById('loginRegError');
        const emailError = document.getElementById('emailError');
        const passwordRegError = document.getElementById('passwordRegError');
        const confError = document.getElementById('confError');

        function validateLogin() {
            authButton.disabled = true;
            loginError.textContent = '';
            passwordError.textContent = '';
            inputLogin.classList.remove('input-error');
            inputPassword.classList.remove('input-error');
            if (inputLogin.value.trim() === '' || inputPassword.value.trim() === '') {
                authButton.disabled = true;
                inputLogin.classList.remove('input-error');
                inputPassword.classList.remove('input-error');
            } else {
                authButton.disabled = false;
            }

            if (!/^[a-zA-z-_0-9]+$/.test(inputLogin.value.trim()) && inputLogin.value.trim() !== '') {
                authButton.disabled = true;
                inputLogin.classList.add('input-error');
                loginError.textContent = 'Логин должен быть написан на латинице';
            }
            if (inputPassword.value.trim().length < 8 && inputPassword.value.trim() !== '') {
                authButton.disabled = true;
                inputPassword.classList.add('input-error');
                passwordError.textContent = 'Пароль должен состоять минимум из 8 символов';
            }
        }

        function validateReg() {
            regButton.disabled = true;
            fioError.textContent = '';
            loginRegError.textContent = '';
            emailError.textContent = '';
            passwordRegError.textContent = '';
            confError.textContent = '';
            inputLoginReg.classList.remove('input-error');
            inputPasswordReg.classList.remove('input-error');
            inputName.classList.remove('input-error');
            inputEmail.classList.remove('input-error');
            inputConf.classList.remove('input-error');


            if (inputLoginReg.value.trim() === '' || inputPasswordReg.value.trim() === '' || inputName.value.trim() === '' || inputEmail.value.trim() === '' || inputConf.value.trim() === '') {
                regButton.disabled = true;
                inputLoginReg.classList.remove('input-error');
                inputPasswordReg.classList.remove('input-error');
                inputName.classList.remove('input-error');
                inputEmail.classList.remove('input-error');
                inputConf.classList.remove('input-error');
            } else {
                regButton.disabled = false;
            }

            if (!/^[а-яА-яЁё-]+(\s[а-яА-яЁё-]+)*$/.test(inputName.value.trim()) && inputName.value.trim() !== '') {
                regButton.disabled = true;
                inputName.classList.add('input-error');
                fioError.textContent = 'Имя должно быть написано на кириллице';
            }
            if (!/^[a-zA-z-_0-9]+$/.test(inputLoginReg.value.trim()) && inputLoginReg.value.trim() !== '') {
                regButton.disabled = true;
                inputLoginReg.classList.add('input-error');
                loginRegError.textContent = 'Логин должен быть написан на латинице';
            }
            if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/.test(inputEmail.value.trim()) && inputEmail.value.trim() !== '') {
                regButton.disabled = true;
                inputEmail.classList.add('input-error');
                emailError.textContent = 'Неверный формат почты';
            }
            if (inputPasswordReg.value.trim().length < 8 && inputPasswordReg.value.trim() !== '') {
                regButton.disabled = true;
                inputPasswordReg.classList.add('input-error');
                passwordRegError.textContent = 'Пароль должен состоять минимум из 8 символов';
            }
            if (inputPasswordReg.value.trim() !== inputConf.value.trim() && inputConf.value.trim() !== '') {
                regButton.disabled = true;
                inputConf.classList.add('input-error');
                confError.textContent = 'Пароли не совпадают';
            }
        }

        inputLogin.addEventListener('input', validateLogin);
        inputPassword.addEventListener('input', validateLogin);

        inputLoginReg.addEventListener('input', validateReg);
        inputPasswordReg.addEventListener('input', validateReg);
        inputName.addEventListener('input', validateReg);
        inputEmail.addEventListener('input', validateReg);
        inputConf.addEventListener('input', validateReg);

        validateLogin();
        validateReg();
    });

    if (document.getElementById('regError')) {
        openRegModal();
    }
    if (document.getElementById('authError')) {
        openAuthModal();
    }

    let previousCount = null;

    function playSound() {
        const audio = new Audio('sounds/notif.mp3');
        audio.play();
    }

    function updateContent() {
        fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
               const parser = new DOMParser();
               const doc = parser.parseFromString(html, 'text/html');

               const newCount = doc.getElementById('count').textContent;

               if (previousCount !== null && previousCount !== newCount) {
                   playSound();

                   document.getElementById('cards').innerHTML = doc.getElementById('cards').innerHTML;
               }
               document.getElementById('count').textContent = newCount;
               previousCount = newCount;
            })
            .catch(error => console.error('Error fetching content:' ,error));
    }
    setInterval(updateContent, 5000);
    updateContent();

    function openAuthModal() {
        document.getElementById('authForm').classList.remove('hidden');
    }
    function closeAuthModal() {
        document.getElementById('authForm').classList.add('hidden');
    }
    function openRegModal() {
        document.getElementById('regForm').classList.remove('hidden');
    }
    function closeRegModal() {
        document.getElementById('regForm').classList.add('hidden');
    }
    function authToRegModal() {
        closeAuthModal();
        openRegModal();
    }
    function regToAuthModal() {
        closeRegModal();
        openAuthModal();
    }
    function openManagementModal() {
        document.getElementById('categoryManagement').classList.remove('hidden');
    }
    function closeManagementModal() {
        document.getElementById('categoryManagement').classList.add('hidden');
    }
    function openCreateCategoryModal() {
        closeManagementModal();
        document.getElementById('createCategory').classList.remove('hidden');
    }
    function closeCreateCategoryModal() {
        document.getElementById('createCategory').classList.add('hidden');
    }
    function openDeleteCategoryModal() {
        closeManagementModal();
        document.getElementById('deleteCategory').classList.remove('hidden');
    }
    function closeDeleteCategoryModal() {
        document.getElementById('deleteCategory').classList.add('hidden');
    }
    function openCreateProblemModal() {
        document.getElementById('createProblem').classList.remove('hidden');
    }
    function closeCreateProblemModal() {
        document.getElementById('createProblem').classList.add('hidden');
    }
    function openConfModal(id, name) {
        document.getElementById('problemName').textContent = name + '?';
        document.getElementById('problemId').value = id;
        document.getElementById('confModal').classList.remove('hidden');
    }
    function closeConfModal(){
        document.getElementById('confModal').classList.add('hidden');
    }
    function openChangeStatusModal(id) {
        document.getElementById('changeId').value = id;
        document.getElementById('changeStatus').classList.remove('hidden');
    }
    function closeChangeStatusModal() {
        document.getElementById('changeStatus').classList.add('hidden');
    }
</script>
</html>
