<?php

namespace App\Http\Controllers;

use App\Item;
use App\Menu;

use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin',['except'=>['index','search','show']]);
    }
    /**
     * Display a listing of the items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item= Item::paginate(12);
        
        return view('items.food')->with('items',$item); 
    }


    /**
     * Show the form for creating a new item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu= Menu::all();
        return view('items.create')->with('menus',$menu);
    }


    /**
     * Store an item in storage and redirect to food.blade.php
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'price'=>'required',
            'image'=>'image | required | max:2047',
        ]);


        $item= new Item;
        
        $item->name= $request->name;

        $fileNameWithExt= $request->file('image')->getClientOriginalName();
        //Get file name only
        $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //Get extension only
        $extension= $request->file('image')->getClientOriginalExtension();
        //File name to store
        $fileNameToStore=$fileName.'_'.time().'.'.$extension;
        //Upload Image
        $path=$request->file('image')->storeAs('public/items_images',$fileNameToStore);

        $item->price= $request->price;
        $item->image= $fileNameToStore;
        $item->menus_id= $request->menus_id;
        //print_r($item->menus_id);
        $item->save();

        $items= Item::paginate(12);
        
        return view('items.food')->with('items',$items); 
    }

    /**
     * Display the items of the specified menu .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu= Menu::find($id);
        $name=$menu->name;
        $items=$menu->Item;
        return view('menu.item')->with(compact('name','items'));
    }




    public function search(Request $request)
    {
        $request->validate([
            'query'=>'required | min:3'
        ]);

        $value=$request->input('query');

        //yo manually search gareko hamle searching installation nagrda kheri ko 
        // $item=Item::where('name', 'LIKE', '%'.$value.'%')
        //           ->orWhere('price' ,'LIKE','%'.$value.'%' )->get();
        
        $item=Item::search($value)->get();

        return view('items.search-results')->with('items',$item);
    }
 



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=Item::find($id);
        $menus=Menu::all();
        return view('items.edit',compact('item','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=> 'required',
            'price'=>'required',
        ]);


        $item= Item::find($id);

        $item->name= $request->name;
        
        $item->price= $request->price;
        
        $item->menus_id= $request->menus_id;
        //print_r($item->menus_id);
        $item->save();

        $items= Item::paginate(12);
        
        return view('items.food')->with('items',$items); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
