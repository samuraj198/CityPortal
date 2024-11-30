<div id="categoryManagement" class="categoryManagement hidden fixed top-0 left-0 w-full h-full bg-black/80 flex justify-center items-start z-50">
    <div class="block relative p-10 bg-white rounded-lg mt-20 flex flex-col gap-5 items-center">
        <a onclick="closeManagementModal()" class="absolute right-2 top-0 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold">Выберите то, что хотите сделать с категорией</h2>
        <div class="buttons flex gap-5">
            <x-button text="Создать" onclick="openCreateCategoryModal()" />
            <x-button text="Удалить" onclick="openDeleteCategoryModal()" bg="bg-black" />
        </div>
    </div>
</div>
