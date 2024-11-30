<div id="confModal" class="confModal hidden fixed top-0 left-0 w-full h-full bg-black/80 flex justify-center items-start z-50">
    <div class="block p-10 bg-white rounded-lg mt-20 flex flex-col gap-5 items-center">
        <h2 class="text-2xl font-bold text-center">Вы уверены, что хотите удалить заявку <p id="problemName"></p></h2>
        <div class="buttons flex items-center gap-5">
            <form method="POST"  action="{{ secure_url('deleteProblem') }}">
                @csrf
                @method('DELETE')
                <input type="text" name="id" id="problemId" value="" class="hidden">
                <x-button text="Да" type="submit" />
            </form>
            <x-button text="Нет" onclick="closeConfModal()" bg="bg-black" />
        </div>
    </div>
</div>
