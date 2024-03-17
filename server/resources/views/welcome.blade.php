<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Laravel</title>
    </head>
    <body>
    
    <div class="container">
        @foreach($plans as $plan) 
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <h1 class="text-center">{{$plan->name}} </h1>
                    <p class="text-center">formül: topla(görev zorluk derecesi * görev saati) </p>
                    <h3 class="text-center">Toplam Yapılacak İş Saati: {{$plan->duration}} </h3>
                    <h4 class="text-center">Minimum Weeks: {{$plan->minimum_weeks}} </h4>
                    <h5 class="text-center">Developer Count: {{App\Models\Developer::count()}} </h5>
                    <hr>
                
                @foreach($plan->weeks as $week)
                <h1 class="text-center">Hafta: {{$week->week}}</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Provider
                                </th>
                                <th scope="col">
                                    Task ID
                                </th>
                                <th scope="col">    
                                    Task Zorluk
                                </th>
                                <th scope="col">
                                    Task Süre
                                </th>
                                <th scope="col">
                                    Developer
                                </th>
                                <th scope="col">
                                    Developer Süre
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($week->tasks as $task)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th>
                                        {{ $task->provider }}
                                    </th>
                                    <th >
                                        {{ $task->task_id }}
                                    </th>
                                    <th >
                                        {{ $task->difficulty }}
                                    </th>
                                    <th >
                                        {{ $task->duration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $task->developers->first()->name }}    
                                    </td>
                                    <td class="px-6 py-4">
                                    {{$task->developers->first()->pivot->spend_hours . ' saat'}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right">Toplam Çalışma Süresi:</td>
                                <td>{{$week->tasks->sum('developers.0.pivot.spend_hours') . ' saat'}}</td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
                </div>

        <div class="col-2"></div> 
        </div>   
    @endforeach

    </body>
</html>
