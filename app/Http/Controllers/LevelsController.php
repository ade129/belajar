<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Levels;
use Illuminate\Http\Request;
use Validator;


class LevelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contents = [
        'levels' => Levels::all(),
        ];

        $pagecontent = view('levels.index',$contents);

        //masterpage

        $pagemain = array(
            'title' => 'Levels',
            'menu' => 'rak',
            'submenu' => 'levels',
            'pagecontent' => $pagecontent
            );

        return view('masterpage', $pagemain);
        
    }

    public function create_page()
    {
        $pagecontent = view('levels.create');
    //masterpage

    $pagemain = array(
        'title' => 'Levels',
        'menu' => 'levels',
        'submenu' => 'levels',
        'pagecontent' => $pagecontent
        );
        
        return view('masterpage', $pagemain);
    }

    public function save_page(Request $request)
    {
        $request->validate([
            
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'created_by' => 'required',
            'active' => ''
          ]);
          $active = FALSE;
          if($request->has('active')) {
              $active = TRUE;
          }
      
          $saveLevels = New Levels;
          $saveLevels->code = $request->code;
          $saveLevels->name = $request->name;
          $saveLevels->description = $request->description;
          $saveLevels->created_by = $request->created_by;
          $saveLevels->active = $active;
          $saveLevels->save();           
          return redirect('levels')->with('status_success','New Level Created');
        
    }

    public function update_page()
    {
        # code...
    }
}
