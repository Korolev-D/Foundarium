<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CarResource::collection(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return CarResource
     */
    public function store(CarStoreRequest $request)
    {
        $car = Car::create($request->validated());
        return new CarResource($car);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CarResource
     */
    public function show($id)
    {
        return new CarResource(Car::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return CarResource
     */
    public function update(CarStoreRequest $request, $id)
    {
        $car = Car::find($id);
        $car->update($request->validated());
        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return response('null', Response::HTTP_NO_CONTENT);
    }
}
