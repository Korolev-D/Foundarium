<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarUserStoreRequest;
use App\Http\Resources\CarUserResource;
use App\Models\CarUser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CarUserResource::collection(CarUser::with('cars')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return CarUserResource
     */
    public function store(CarUserStoreRequest $request)
    {
        dd($request);
        $carUser = CarUser::create($request->validated());
        return new CarUserResource($carUser);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CarUserResource
     */
    public function show($id)
    {
        return new CarUserResource(CarUser::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return CarUserResource
     */
    public function update(CarUserStoreRequest $request, $id)
    {
        $carUser = CarUser::find($id);
        $carUser->update($request->validated());
        return new CarUserResource($carUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carUser = CarUser::find($id);
        $carUser->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
