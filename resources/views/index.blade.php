@extends('layouts.main')
@section('title', 'Main Page')
@section('content')
    <div class="counter flex gap-5 mt-20 items-center">
        <h2 class="text-2xl font-bold">РЕШЕННЫЕ ЗАЯВКИ</h2>
        <p class="count px-3 py-2 bg-button/50 rounded-full text-white" id="count">{{ $count }}</p>
    </div>
    <div class="cards mt-10 flex gap-10" id="cards">
        @forelse($problems as $problem)
            <div class="card-{{$problem->id}} w-[450px] h-[630px] shadow-2xl rounded-lg flex items-end">
                <div class="inf text-white p-2 w-full">
                    <h2 class="text-2xl font-bold">{{ $problem->name }}</h2>
                    <p class="text-white/50">{{ $problem->category->name }}</p>
                    <p class="text-end text-white/50 w-full">{{ $problem->updated_at->setTimezone('Europe/Moscow')->addHour()->format('d.m.Y H:i')}}</p>
                </div>
            </div>
        @empty
            <p class="text-red-500 text-center">Нет решенных заявок</p>
        @endforelse
    </div>
@endsection
