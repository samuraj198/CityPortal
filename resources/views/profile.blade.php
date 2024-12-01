@extends('layouts.main')
@section('title', 'Main Page')
@section('content')
    <div class="buttons flex gap-20 items-center mt-20">
        @if(auth()->user()->hasRole('User'))
            @include('modals.createProblem')
            <x-button onclick="openCreateProblemModal()" text="Создать заявку" />
            <h2 class="text-2xl font-bold">МОИ ЗАЯВКИ</h2>
        @elseif(auth()->user()->hasRole('Admin'))
            @include('modals.categoryManagement')
            @include('modals.createCategory')
            @include('modals.deleteCategory')
            <x-button onclick="openManagementModal()" text="Управление категориями" />
            <h2 class="text-2xl font-bold">ВСЕ ЗАЯВКИ</h2>
        @endif
            <form method="GET">
                <select onchange="this.form.submit()" class="w-full border-[1px] border-black rounded-lg px-3 py-2 cursor-pointer" name="status">
                    <option value="">Все</option>
                    <option value="Новая" {{ request('status') == 'Новая' ? 'selected' : '' }}>Новые</option>
                    <option value="Решена" {{ request('status') == 'Решена' ? 'selected' : '' }}>Решенные</option>
                    <option value="Отклонена" {{ request('status') == 'Отклонена' ? 'selected' : '' }}>Отклоненные</option>
                </select>
            </form>
    </div>
    <div class="cards mt-10 flex flex-col gap-10 items-center mb-10">
        @forelse($problems as $problem)
            <div class="card w-[1600px] h-[250px] shadow-2xl rounded-lg flex justify-between">
                <div class="imgAndInf flex gap-5">
                    <img class="w-[450px] h-[250px] object-cover rounded-l-lg" src="storage/problems/{{ $problem->imgBefore }}" alt="">
                    <div class="infAndData relative py-2">
                        <div class="inf">
                            <h2 class="text-2xl font-bold">{{ \Illuminate\Support\Str::limit($problem->name, 40) }}
                            @if(auth()->user()->hasRole('Admin'))
                                <span class="text-black/50 text-sm">({{ $problem->user->login }})</span>
                            @endif
                            </h2>
                            <p class="text-black/50">{{ $problem->category->name }}</p>
                            <p style="display: -webkit-box;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;" class="break-words w-[900px]">{{ $problem->description }}</p>
                        </div>
                       <div class="data text-black/50 absolute bottom-0 w-[200px] mb-2">
                           {{ $problem->created_at->setTimezone('Europe/Moscow')->addHour()->format('d.m.Y H:i') }}
                       </div>
                    </div>
                </div>
                <div class="buttons p-2 flex flex-col justify-between items-end">
                    @if($problem->status == 'Новая')
                        @include('modals.confModal')
                        <img class="w-[58px] h-[58px]" src="img/icons/new.svg" alt="">
                        @if(auth()->user()->hasRole('User'))
                            <a class="cursor-pointer w-[50px] h-[50px]" onclick="openConfModal({{ $problem->id }}, '{{ $problem->name }}')"><img src="img/icons/trash.svg" alt=""></a>
                        @else
                            @include('modals.changeStatus')
                            <x-button onclick="openChangeStatusModal({{ $problem->id }})" text="Изменить статус" />
                        @endif
                    @elseif($problem->status == 'Решена')
                        <img class="w-[58px] h-[58px]" src="img/icons/resolve.svg" alt="">
                    @else
                        <img class="w-[58px] h-[58px]" src="img/icons/cancel.svg" alt="">
                    @endif
                </div>
            </div>
        @empty
            <p class="text-red-500 text-center">Нет заявок</p>
        @endforelse
        @if($errors->any())
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>
@endsection
