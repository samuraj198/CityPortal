<div id="deleteCategory" class="deleteCategory hidden fixed top-0 left-0 w-full h-full bg-black/80 flex justify-center items-start z-50">
    <form method="POST" class="block relative p-10 bg-white rounded-lg mt-20 flex flex-col gap-5 items-center" action="{{ secure_url('deleteCategory') }}">
        @csrf
        @method('DELETE')
        <a onclick="closeDeleteCategoryModal()" class="absolute right-2 top-0 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold">Выберите ненужную категорию</h2>
        <select class="w-full border-[1px] border-black rounded-lg px-3 py-2" name="id" id="">
            <option disabled selected hidden>Список категорий</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <x-button text="Удалить" bg="bg-black" type="submit" />
    </form>
</div>
