<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Categories;

class ItemsController extends Controller
{
    public function index()
    {
        $content = [
            // // ini buat apa ya
            // 'items' => Items::with('users','categories')->get()
            'items' => Items::with(['categories'])->get(),
        ];
        
        //return $content;
        // dd($contents);
        $pagecontent = view('items.index',$content);

        // masterpage
        $pagemain = array(
            'title' => 'Master Items',
            'menu' => 'master',
            'submenu' => 'items',
            'pagecontent' => $pagecontent
        );

        return view('masterpage', $pagemain);
    }
    public function create_page()
    {
        $categories = Categories::all();
        //return $categories;
        $content = [
        'categories' => $categories,
            'items' => Items::all(),
        ];
        $pagecontent = view('items.create',$content);
        $pagemain = array(
            'title' => 'Master Items',
            'menu' => 'Master',
            'submenu' => 'Items',
            'pagecontent' => $pagecontent,
        );
  
        return view('masterpage', $pagemain);
      }

      public function save_page(Request $request)
      {
          $request->validate([
            'nameitems' => 'required|max:100',
            'unit' => 'required',
            'brand' => 'required',
            'active' => ''
          ]);
          $active = FALSE;
          if($request->has('active')) {
              $active = TRUE;
          }
      
            $saveItems = New Items;
            $saveItems->nameitems = $request->nameitems; 
            $saveItems->idcategories = $request->idcategories;
            $saveItems->unit = $request->unit;
            $saveItems->brand = $request->brand;
            $saveItems->active = $active;
            $saveItems->save();
            return redirect('items')->with('status_success','New item created');
        }
        public function update_page(Items $item)
        {
            $categories = Categories::all();
             //return $categories;
            $content = [
            'categories' => $categories,
            'items' => Items::find($item->iditems),
        ];
       
            // return $contents;
    
            $pagecontent = view('items.update',$content);
    
            // masterpage
            $pagemain = array(
                'title' => 'Items',
                'menu' => 'items',
                'submenu' => 'items',
                'pagecontent' => $pagecontent,
            );
            return view('masterpage', $pagemain);
        }
        public function update_save(Request $request,Items $items)
            {
            $request->validate([
              'nameitems' => 'required|max:100',
              'unit' => 'required',
              'brand' => 'required',
              'active' => ''
            ]);
            $active = FALSE;
            if($request->has('active')) {
                $active = TRUE;
            }
        
              $updateItems = Items::find($items->iditems);
              $updateItems->nameitems = $request->nameitems; 
              $updateItems->idcategories = $request->idcategories;
              
              $updateItems->unit = $request->unit;
              $updateItems->brand = $request->brand;
              $updateItems->active = $active;
              $updateItems->save();
              return redirect('items')->with('status_success','Update Item');
          }
          public function delete (Items $items)
          {
            $deleteItems = Items::find($items->iditems);
            $deleteItems->delete();
            return redirect('items')->with('status_succes','Delete items');
          }  
}