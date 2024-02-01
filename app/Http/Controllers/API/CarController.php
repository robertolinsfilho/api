<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Car;
use Validator;
use App\Http\Resources\Car as CarResource;
use App\Repositories\InterfaceCarRepository;
class CarController extends BaseController
{

    protected $carRepository;

    public function __construct(InterfaceCarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = $this->carRepository->allCar();


        return $this->sendResponse(CarResource::collection($car), 'Carros listados com sucesso.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'color' => 'required',
            'model' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $car = $this->carRepository->storeCar($input);

        return $this->sendResponse([$input], $car);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($id)) {
            return $this->sendError('Carro não encontrado.');
        }
        $car = $this->carRepository->findCar($id);
        return $this->sendResponse(new CarResource($car), 'Carro cadastrado com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required',
            'name' => 'required',
            'color' => 'required',
            'model' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $car = $this->carRepository->updateCar($input, $input['id']);


        return $this->sendResponse([$input], $car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = $this->carRepository->destroyCar($id);

        return $this->sendResponse([], $car);
    }
}
