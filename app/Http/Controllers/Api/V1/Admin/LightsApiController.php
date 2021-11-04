<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLightRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateLightRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\LightResource;
use App\Http\Resources\Admin\UserResource;
use App\LightSystem;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LightsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('light_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LightResource(LightSystem::all());

    }

    public function store(StoreLightRequest $request)
    {
        $light = LightSystem::create($request->all());

        return (new LightResource($light))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(LightSystem $light)
    {
        abort_if(Gate::denies('light_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LightResource($light);

    }

    public function update(UpdateLightRequest $request, LightSystem $light)
    {
        $light->update($request->all());

        return (new LightResource($light))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(LightSystem $light)
    {
        abort_if(Gate::denies('light_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $light->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
