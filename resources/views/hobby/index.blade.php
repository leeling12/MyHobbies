@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">All the hobbies</div>

                <div class="card-body">
                   <ul class="list-group">
                       @foreach($hobbies as $hobby)
                            <li class="list-group-item">
                                <a style="color:black;" title="Show Details" href="/hobby/{{$hobby->id}}"><b>{{ $hobby->name }}</b></a>
                                @auth
                                <a class="btn btn-sm btn-light ml-2" href="/hobby/{{$hobby->id}}/edit"><i class="fas fa-edit"></i>Edit Hobby</a>
                                @endauth

                                <a href="/user/{{$hobby->user->id}}"><span class="mx-2">Posted by: {{ $hobby->user->name }} ({{ $hobby->user->hobbies->count() }} Hobbies)</span></a>
                                

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
                                <a href=""><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
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
