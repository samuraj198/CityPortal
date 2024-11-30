<div id="createCategory" class="createCategory hidden fixed top-0 left-0 w-full h-full bg-black/80 flex justify-center items-start z-50">
    <form method="POST" class="block relative p-10 bg-white rounded-lg mt-20 flex flex-col gap-5 items-center" action="{{ url('createCategory') }}">
        @csrf
        <a onclick="closeCreateCategoryModal()" class="absolute right-2 top-0 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold">Напишите название новой категории</h2>
        <input required name="name" type="text" placeholder="Введите название новой категории" class="w-full border-[1px] border-black rounded-lg px-3 py-2">
        <x-button text="Создать" type="submit" />
    </form>
</div>
