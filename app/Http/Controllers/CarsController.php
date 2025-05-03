<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Service;
use App\Models\stay;
use App\Models\car;
use App\Models\type;
use App\Models\servicecategory;
use Session;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {   $category = servicecategory::where('id',2)->first();
        $services = Service::where('category_id', 2)->with('types', 'category')->get()->all();
        $cars = car::all();
        $user = User::where('id', '=', Session::get('loginid'))->first();
        return view('cars.index', compact('cars', 'user', 'services','category'));
    }

    public function filter(Request $request)
    {
        $query = Car::query();
    
        // Only check cars' category (category_id = 2 for cars)
        $query->where('category_id', 2);
    
        // Filter by state
        if ($request->filled('state_id')) {
            $query->whereHas('service', function ($q) use ($request) {
                $q->where('state_id', $request->state_id);
            });
        }
    
        // Filter by city
        if ($request->filled('city_id')) {
            $query->whereHas('service', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }
    
        // Filter by type (hourly, daily, etc.)
        if ($request->filled('type_id')) {
            $query->whereHas('service.type', function ($q) use ($request) {
                $q->where('id', $request->type_id);
            });
        }
    
        // Filter by availability (check_in and check_out)
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn = $request->check_in;
            $checkOut = $request->check_out;
    
            $query->whereDoesntHave('service.bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where(function ($query) use ($checkIn, $checkOut) {
                    $query->where('check_in', '<', $checkOut)
                          ->where('check_out', '>', $checkIn);
                });
            });
        }
    
        // Load related data: service, type, category, and agency
        $cars = $query->with([
            'service' => function ($q) {
                $q->where('category_id', 2) // Ensure only car services are loaded
                  ->with(['type', 'category', 'agency']);
            }
        ])->get();
    
        return response()->json([
            'status' => 'success',
            'data' => $cars
        ]);
    }
    
    
    
    
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'service_id' => 'required|integer',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'seats' => 'nullable|integer',
            'fuel_type' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'doors' => 'nullable|integer',
            'agency_id' => 'required|integer',
        ]);

        $car = new car();
        $car->name = $request->name;
        $car->service_id = $request->service_id;
        $car->category_id = $request->category_id;
        $car->type_id = $request->type_id;
        $car->seats = $request->seats;
        $car->fuel_type = $request->fuel_type;
        $car->transmission = $request->transmission;
        $car->Discount = $request->Discount ?? 0;
        $car->doors = $request->doors;
        $car->agency_id = $request->agency_id;

        $serviceImages = [];
        if ($request->has('service_images')) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = rand() . '.' . $extension;
                $path = 'admin/cars/';
                $image->move($path, $filename);
                $serviceImages[] = "{$path}{$filename}";
            }
            $car->service_images = json_encode($serviceImages);
        } else {
            $car->service_images = json_encode([]);
        }

        $car->save();

        return redirect()->back()->with('success', 'Car created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',

            'seats' => 'nullable|integer',
            'fuel_type' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'doors' => 'nullable|integer',
     
        ]);

        $car = car::findOrFail($id);
        $car->name = $request->name;
        $car->seats = $request->seats;
        $car->fuel_type = $request->fuel_type;
        $car->transmission = $request->transmission;
        $car->Discount = $request->Discount ?? 0;
        $car->doors = $request->doors;
     

        $serviceImages = [];
        if ($request->has('service_images') && is_array($request->file('service_images'))) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = rand() . '.' . $extension;
                $path = 'admin/cars/';
                $image->move($path, $filename);
                $serviceImages[] = "{$path}{$filename}";
            }
            $car->service_images = json_encode($serviceImages);
        } else {
            $car->service_images = json_encode([]);
        }

        $car->save();

        return back()->with('success', 'Car updated successfully.');
    }

    public function edit($id)
    {
        $car = car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function destroy($id)
    {
        $car = car::findOrFail($id);
        if (!empty($car->service_images)) {
            $images = json_decode($car->service_images, true);
            if (is_array($images)) {
                foreach ($images as $imagePath) {
                    \Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }

}
