@extends('dashboard');

@section('content')


<div class="container">
<h1>Reminder</h1>
    <form action="/expenses/new" class="basic-form">
        <button>Add Reminder</button>
        <!--button-- class="sub-action" id="quickDelete">Delete</!--button-->
    </form>
    <div class="global-spacer"> 
        <h4 class="load-in">Next Dependency</h4>

        <div class="load-in card-item">
            <div class="upper">

                <div class="title">
                    <h3>{{ oneRowText($nextDep->title) }}</h3>
                </div>
        
            </div>

            <div class="under">

                <div class="icon">
                </div>

                <div class="amount" style="margin-top: 5px;">
                    {{ dynamicFutureDate($nextDep->until) }}
                </div>

                <div class="date" style="margin-top: 5px;">
                    {{ $nextDep->costs ?? 'no costs' }}  {{ $nextDep->costs ? $user->setting->currency->short : '' }}
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
