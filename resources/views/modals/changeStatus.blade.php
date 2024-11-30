<div id="changeStatus" class="changeStatus hidden w-full h-full bg-black/80 z-50 flex items-start justify-center fixed left-0 top-0">
    <form enctype="multipart/form-data" method="POST" class="relative bg-white p-10 mt-20 rounded-lg w-[40%] flex flex-col gap-5 items-center justify-center" action="{{ url('changeStatus') }}">
        @csrf
        <a onclick="closeChangeStatusModal()" class="absolute right-5 top-3 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold">Изменение статуса</h2>
        <input class="hidden" name="id" value="" id="changeId">
        <select class="w-full border-[1px] border-black rounded-lg px-3 py-2" name="status" id="newStatus">
            <option disabled selected hidden>Выберите новый статус заявки</option>
            <option value="Решена">Решена</option>
            <option value="Отклонена">Отклонена</option>
        </select>
        <textarea id="reason" name="reason" placeholder="Опишите вашу проблему" class="hidden w-full border-[1px] border-black rounded-lg px-3 py-2 min-h-[150px]"></textarea>
        <input id="imgAfter" type="file" name="imgAfter" class="hidden">
        <x-button id="changeButton" type="submit" text="Изменить" />
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newStatus = document.getElementById('newStatus');
        const reason = document.getElementById('reason');
        const imgAfter = document.getElementById('imgAfter');
        const changeButton = document.getElementById('changeButton');

        function changeStatus() {
            changeButton.disabled = true;
            if (newStatus.value === 'Решена') {
                changeButton.disabled = false;
                imgAfter.classList.remove('hidden');
                reason.classList.add('hidden');
                imgAfter.setAttribute('required', 'required');
                reason.removeAttribute('required', 'required');
            }
            if (newStatus.value === 'Отклонена') {
                changeButton.disabled = false;
                imgAfter.classList.add('hidden');
                reason.classList.remove('hidden');
                imgAfter.removeAttribute('required', 'required');
                reason.setAttribute('required', 'required');
            }
        }

        newStatus.addEventListener('change', changeStatus);
        changeStatus();
    });
</script>
