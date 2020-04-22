<?php

namespace App\Http\Controllers;

use App\State;
use App\County;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(20);
        $deleted_mode = false;
        return view('service.index',compact('services','deleted_mode'));
    }

    public function deleted() {

        $services = Service::onlyTrashed()->paginate(20);
        $deleted_mode = true;
        return view('service.index',compact('services','deleted_mode'));


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
        $counties = [];
        $service = [];
        return view('service.create',compact('states','edit_mode','counties','service'));

    }

    public function getCounties(Request $request,$id)
    {
        $term = $request->has('search') ? $request->input('search') : '';        
        return $counties = County::where('state_id', $id)->whereRaw('name LIKE "%' . $term . '%"')->orderBy('name', 'asc')->get();

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
            'name'=>'required|unique:services,name',
            'counties'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->fail($validator->errors());

        }
        
        $service = new Service;
        $service->name = $request->name;
        $service->save();
        $service->counties()->sync($request->counties);

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
        $service = Service::find($id);
        $states = State::all();
        $edit_mode = true;
        $counties = $service->counties;
        return view('service.create',compact('states','edit_mode','counties','service'));

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
        $service = Service::find($id);

        $validator=Validator::make($request->all(), [
            'name'=>'required|unique:services,name,'.$id,
            'counties'=>'required',

        ]);

        if ($validator->fails()) {
            return $this->fail($validator->errors());

        }
        
        $service->name = $request->name;
        $service->save();
        $service->counties()->sync($request->counties);

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
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('service.index');

    }

    public function restore($id)
    {
        $service = Service::onlyTrashed()->where('id',$id)->first();
        $service->restore();
        return redirect()->route('service.index');


    }
}
