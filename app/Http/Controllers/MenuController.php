<?php

namespace App\Http\Controllers;

use App\Menu;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menu= Menu::all();
        
        return view('menu.menu')->with('menus',$menu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'image'=>'image | required | max:2047',
        ]);


        $menu= new Menu;

        $menu->name= $request->name;

        $fileNameWithExt= $request->file('image')->getClientOriginalName();
        //Get file name only
        $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //Get extension only
        $extension= $request->file('image')->getClientOriginalExtension();
        //File name to store
        $fileNameToStore=$fileName.'_'.time().'.'.$extension;
        //Upload Image
        $path=$request->file('image')->storeAs('public/menu_images',$fileNameToStore);

        $menu->image= $fileNameToStore;
        $menu->save();

        return redirect('/menu');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
