<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <div>
                   <table class="table">
                       <thead>
                       <tr>
                           <th scope="col">#</th>
                           <th>Марка, модель</th>
                           <th>Гос номер</th>
                           <th>Стоимость за минуту рублей</th>
                           <th>Действия</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach(\App\Models\Auto::all() as $auto)
                            <tr>
                                <td>{{ $auto->id }}</td>
                                <td>{{ $auto->name }}</td>
                                <td>{{ $auto->number }}</td>
                                <td>{{ $auto->cost }}</td>
                                @if($auto->busy_until)
                                    <td>
                                        <button class="btn btn-warning" disabled>Занята до {{ $auto->busy_until }}</button></td>
                                @else
                                    <td>
                                        <form action="{{ route('auto.take') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ auth()->id() }}">
                                            <input class="form-control mb-1" type="number" name="minutes" max="360" placeholder="минуты">
                                            <button type="submit" class="btn btn-primary">Арендовать</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                       @endforeach
                       </tbody>
                   </table>

               </div>
            </div>
        </div>
    </div>
</x-app-layout>
