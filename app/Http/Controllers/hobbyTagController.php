<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class hobbyTagController extends Controller
{
    public function getFilteredHobbies($tag_id){
        //die('hobbies filtered for tag no '.$tag_id);
        $tag = new Tag();
        //findOrFail ->handle exception, 404 not found
        $hobbies = $tag::findOrFail($tag_id)->filteredHobbies()->paginate(10);
    
        $filter = $tag::find($tag_id);

        return view('hobby.index', [
            'hobbies' => $hobbies,
            'filter' => $filter
        ]);
    }
}
