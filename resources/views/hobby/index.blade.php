@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
            
                @isset($filter)
                     <div class="card-header">Filtered hobbies by 
                        <span style="font-size: 105%" class="badge badge-{{ $filter->style }}">{{ $filter->name }}</span>
                        <span class="float-right"><a href="/hobby">Show All Hobbies</a></span>
                     </div>
                @else
                     <div class="card-header">All the hobbies</div>
                @endisset

                <div class="card-body">
                   <ul class="list-group">
                       @foreach($hobbies as $hobby)
                            <li class="list-group-item">
                                <a style="color:black;" title="Show Details" href="/hobby/{{$hobby->id}}"><b>{{ $hobby->name }}</b></a>
                                @auth
                                <a class="btn btn-sm btn-light ml-2" href="/hobby/{{$hobby->id}}/edit"><i class="fas fa-edit"></i>Edit Hobby</a>
                                @endauth

                                <span class="mx-2">Posted by: <a href="/user/{{$hobby->user->id}}">{{ $hobby->user->name }}</a> ({{ $hobby->user->hobbies->count() }} Hobbies)</span>
                                

                            @auth
                            <form class="float-right" style="display: inline" action="/hobby/{{$hobby->id}}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                            </form>
                            @endauth
                            <!-- display date -->
                            <span class="float-right mx-2"> {{ $hobby->created_at->diffForHumans()}}</span>
                            @foreach($hobby->tags as $tag)
                                <a href="/hobby/tag/{{$tag->id}}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                            @endforeach
                            </li>
                        @endforeach
                   </ul>
                </div>
            </div>

            <div class="mt-3">
                {{ $hobbies->links() }}
            </div>

            @auth
            <div class="mt-2">
                <a class="btn btn-success btn-sm" href="/hobby/create"><i class="fas fa-pus-circle"></i>Create new Hobby</a>
            </div>
            @endauth

        </div>
    </div>
</div>
@endsection
