<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MassDestroyLightRequest;
use App\Http\Requests\StoreLightRequest;
use App\Http\Requests\UpdateLightRequest;
use App\LightSystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
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
}
