<?php

namespace App\Http\Controllers;

use App\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hobbies = Hobby::all();

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
        return view('hobby.show')->with([
            'hobby' => $hobby
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
