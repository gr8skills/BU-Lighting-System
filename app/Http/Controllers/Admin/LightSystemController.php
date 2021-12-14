<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MassDestroyLightRequest;
use App\Http\Requests\StoreLightRequest;
use App\Http\Requests\UpdateLightRequest;
use App\LightSystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Response;

class LightSystemController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('light_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lights = LightSystem::all();
        return view('admin.lights.index', compact('lights'));
    }


    public function create()
    {
        abort_if(Gate::denies('light_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.lights.create');

    }


    public function store(StoreLightRequest $request)
    {
        $light = LightSystem::create($request->all());
        return redirect()->route('admin.lights.index');
    }


    public function show(LightSystem $light)
    {
        abort_if(Gate::denies('light_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.lights.show', compact('light'));

    }

    public function edit(LightSystem $light)
    {
        abort_if(Gate::denies('light_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.lights.edit', compact('light'));
    }


    public function update(UpdateLightRequest $request, LightSystem $light)
    {
        $light->update($request->all());
        return redirect()->route('admin.lights.index');
    }


    public function destroy(LightSystem $light)
    {
        abort_if(Gate::denies('light_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $light->delete();
        return back();

    }

    public function massDestroy(MassDestroyLightRequest $request)
    {
        LightSystem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function onAllLights()
    {
       $lights = LightSystem::all();
       if (count($lights) > 0){
           foreach ($lights as $light){
               $light->update(['status'=>1]);
           }
           return back();
       }
    }

    public function offAllLights()
    {
       $lights = LightSystem::all();
       if (count($lights) > 0){
           foreach ($lights as $light){
               $light->update(['status'=>0]);
           }
           return back();
       }
    }

    public function directLightStatus($id)
    {
        $light = LightSystem::find($id);
        if (isset($light)){
            $status = $light->status;
            return response()->json([
                'code'=>777,
                'light-status'=>$status,
            ]);
        }else{
            return response()->json([
                'code' => 100,
                'light-status'=>'Light Not found',
            ]);
        }

    }

    public function directLightSwitch($id,$switch)
    {
        if ($switch == 0 || $switch == 1){
            $light = LightSystem::find($id);
            if (isset($light)){
                $light->update(['status'=>$switch]);
                return response()->json([
                    'code'=>777,
                    'light-status'=>$light->status,
                ]);
            }else{
                return response()->json([
                    'code' => 100,
                    'light-status'=>'Light Not found',
                ]);
            }
        }else{
            return response()->json([
                'code'=>100,
                'light-status'=>'This light can only be switched ON or OFF',
            ]);
        }

    }

    public function toggleONOFF()
    {
        $data = \request()->all();
        $id = key($data);
        $light = LightSystem::find($id);
        if (isset($light) && !is_null($light)){
            $light->status==1?$light->update(['status'=>0]):$light->update(['status'=>1]);
        }
        return back();
    }
}
