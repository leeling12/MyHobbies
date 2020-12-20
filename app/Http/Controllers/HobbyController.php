<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Carbon;

class HobbyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']); //if not login, only can access index and show page
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$hobbies = Hobby::all();
        //$hobbies = Hobby::paginate(10);

        //Carbon::

        $hobbies = Hobby::orderBy('created_at', 'DESC')->paginate(10);

        return view('hobby.index')->with([
            'hobbies' => $hobbies
        ]);
        //dd = die + dump
        //dd($hobbies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('store');

        //validation
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
        ]);

        $hobby = new Hobby([
            //'name' => $request->name,
            'name' => $request['name'],
            'description' => $request['description'],
            'user_id' => auth()->id()
        ]);
        $hobby->save();
        //redirect back index page
        return $this->index()->with(
            [
                'message_success' => "The hobby <b>". $hobby->name . "</b> was created."
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        $allTags = Tag::all();
        $usedTags = $hobby->tags; //from Model
        $availableTags = $allTags->diff($usedTags); //different

        return view('hobby.show')->with([
            'hobby' => $hobby,
            'availableTags' => $availableTags,
            'message_success' => Session::get('message_success') //flash session
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby)
    {
        return view('hobby.edit')->with([
            'hobby' => $hobby
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hobby $hobby)
    {
              //validation
            $request->validate([
                'name' => 'required|min:3',
                'description' => 'required|min:5',
            ]);
    
            $hobby->update([
                //'name' => $request->name,
                'name' => $request['name'],
                'description' => $request['description'],
            ]);

            //redirect back index page
            return $this->index()->with(
                [
                    'message_success' => "The hobby <b>". $hobby->name . "</b> was updated."
                ]
            );  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby)
    {
        $oldName = $hobby->name;
        $hobby->delete();

         //redirect back index page
         return $this->index()->with(
             [
                 'message_success' => "The hobby <b>". $oldName . "</b> was deleted."
             ]
         );
    }
}
