<div id="createProblem" class="createProblem hidden w-full h-full bg-black/80 z-50 flex items-start justify-center fixed left-0 top-0">
    <form enctype="multipart/form-data" method="POST" class="relative bg-white p-10 mt-20 rounded-lg w-[40%] flex flex-col gap-5 items-center justify-center" action="{{ route('createProblem') }}">
        @csrf
        <a onclick="closeCreateProblemModal()" class="absolute right-5 top-3 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold">Создание проблемы</h2>
        <input required name="name" type="text" placeholder="Введите ваш логин" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
        <textarea name="description" placeholder="Опишите вашу проблему" class="w-full border-[1px] border-black rounded-lg px-3 py-2 min-h-[150px]"></textarea>
        <select class="w-full border-[1px] border-black rounded-lg px-3 py-2" name="category_id">
            <option disabled selected hidden>Выберите категорию проблемы</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="file" name="imgBefore">
        <x-button type="submit" text="Создать" />
    </form>
</div>
