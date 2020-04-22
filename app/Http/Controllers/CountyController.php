<?php

namespace App\Http\Controllers;

use App\State;
use App\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = County::paginate(20);
        $deleted_mode = false;
        return view('county.index',compact('counties','deleted_mode'));
    }

    public function deleted() {

        $counties = County::onlyTrashed()->paginate(20);
        $deleted_mode = true;
        return view('county.index',compact('counties','deleted_mode'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $edit_mode = false;
        $county = [];
        return view('county.create',compact('states','edit_mode','county'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name'=>'required|unique:counties,name',
            'state' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->fail($validator->errors());

        }

        $county = new County;
        $county->name = $request->name;
        $county->state_id = $request->state;
        $county->save();

        return $this->success("{{route('service.index'}}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = State::all();
        $edit_mode = true;
        $county = County::find($id);
        return view('county.create',compact('states','edit_mode','county'));
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
        $validator=Validator::make($request->all(), [
            'name'=>'required|unique:counties,name,'.$id,
            'state' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->fail($validator->errors());

        }

        $county = County::find($id);
        $county->name = $request->name;
        $county->state_id = $request->state;
        $county->save();

        return $this->success("{{route('service.index'}}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $county = County::find($id);
        $county->delete();
        return redirect()->route('county.index');

    }

    public function restore($id)
    {
        $county = County::onlyTrashed()->where('id',$id)->first();
        $county->restore();
        return redirect()->route('county.index');


    }

    public function getServices(County $county) {
        return view('county.services',compact('county'));
    }
}
