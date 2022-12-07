<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatisticsCollection;
use App\Models\CarModel;
use App\Models\OwnerModel;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function addCar(Request $request) {
        CarModel::insert([
            'model' => $request->get('model'),
            'owner_id' => $request->get('car_owner'),
            'price' => $request->get('price'),
            'plate_number' => $request->get('plate_number'),
            'manufacturer_id' => 1
        ]);
        return 'OK';
    }

    public function addOwner(Request $request) {
        OwnerModel::insert([
            'personal_number' => $request->get('ID'),
            'phone_number' => $request->get('phone'),
            'full_name' => $request->get('name'),
            'mail' => $request->get('mail'),
        ]);
        return 'OK';
    }

    public function getCars(Request $request) {
        return new StatisticsCollection(CarModel::getAllCars());
    }

    public function getOwners(Request $request) {
        return  OwnerModel::all();
    }
}
