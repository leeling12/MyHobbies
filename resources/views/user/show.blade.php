@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header" style="font-size: 150%">{{ $user->name }}</div>

                <div class="card-body">
                   <p><b>My Motto:</b><br>{{ $user->motto }}</p>
                   <p class="mt-2"><b>Abour Me:</b><br>{{ $user->about_me }}</p>

                   @if($user->hobbies->count() > 0)
                    <h5 class="mt-4">Hobbies of {{ $user->name }} </h5>
                    <ul class="list-group">
                            @foreach($user->hobbies as $hobby)
                                    <li class="list-group-item">
                                        <a style="color:black;" title="Show Details" href="/hobby/{{$hobby->id}}"><b>{{ $hobby->name }}</b></a>
                                    
                                        <!-- display date -->
                                        <span class="float-right mx-2"> {{ $hobby->updated_at->diffForHumans()}}</span>

                                        <!-- display tags -->
                                        <br>
                                        @foreach($hobby->tags as $tag)
                                            <a href="/hobby/tag/{{$tag->id}}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                        @endforeach
                                    </li>
                                @endforeach
                    </ul>
                @else
                    <p>{{ $user->name }} has not created any hobbies yet.</p>
                @endif

                </div>
            </div>

  
            <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-left"></i> Back to Overview</a>
            </div>
        </div>
    </div>
</div>
@endsection
