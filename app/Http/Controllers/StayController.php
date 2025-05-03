<?php

namespace App\Http\Controllers;
use App\Models\User;
use Session;
use App\Models\stay;
use App\Models\Service;
use App\Models\type;
use App\Models\servicecategory;
use Illuminate\Http\Request;

class StayController extends Controller
{
    public function index()
    {
        $category = servicecategory::where('id',1)->first();
        $services = Service::where('category_id', 1)->with('type', 'category')->get()->all();
        $stays = stay::all();
        $user = User::where('id', '=', Session::get('loginid'))->first();
        return view('Stays.index', compact('stays','user', 'services','category'));
    }

  
  
       public function filter(Request $request)
    {
        $query = stay::query();
    
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
    
        // Filter by service type
        if ($request->filled('type_id')) {
            $query->whereHas('service.types', function ($q) use ($request) {
                $q->where('id', $request->type_id);
            });
        }
    
        // Check availability based on booking dates
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn = $request->check_in;
            $checkOut = $request->check_out;
    
            $query->whereDoesntHave('service.bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where(function ($query) use ($checkIn, $checkOut) {
                    $query->whereBetween('from', [$checkIn, $checkOut])
                          ->orWhereBetween('to', [$checkIn, $checkOut])
                          ->orWhere(function ($query) use ($checkIn, $checkOut) {
                              $query->where('from', '<=', $checkIn)
                                    ->where('to', '>=', $checkOut);
                          });
                });
            });
        }
    
        // Load related data and get results
        $stays = $query->with('service', 'service.types', 'service.category')->get();
    
        return response()->json([
            'success' => true,
            'data' => $stays
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'service_id' => 'required|integer',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'beds' => 'nullable|integer',
            'baths' => 'nullable|integer',
            'guests' => 'nullable|integer',
            'amenities' => 'nullable|string|max:255',
            'agency_id' => 'required|integer',

        ]);

        $stay = new stay();
        $stay->name = $request->name;
        $stay->service_id = $request->service_id;
        $stay->category_id = $request->category_id;
        $stay->type_id = $request->type_id;
        $stay->beds = $request->beds;
        $stay->baths = $request->baths;
        $stay->guests = $request->guests;
        $stay->amenities = $request->amenities;
        $stay->Discount = $request->Discount;
        $stay->agency_id = $request->agency_id;
        $serviceimage = [];
       

        if ($request->has('service_images') ) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename2 = rand() . '.' . $extension;
                $path = 'admin/services/';
                $image->move($path, $filename2);
                $serviceimage[] = "{$path}{$filename2}";
            }
            $images = json_encode($serviceimage);
            $stay->service_images = $images;
        }

        if (empty($serviceimage)) {
            $stay->service_images = json_encode([]);
        }
        $stay->save();

        return redirect()->back()
            ->with([
                'success' => 'Stay created successfully.'
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'service_id' => 'required|integer',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'beds' => 'nullable|integer',
            'baths' => 'nullable|integer',
            'guests' => 'nullable|integer',
            'amenities' => 'nullable|string|max:255',
            'agency_id' => 'required|integer',

        ]);

        $stay = stay::findOrFail($id);


        $stay->name = $request->name;
        $stay->service_id = $request->service_id;
        $stay->category_id = $request->category_id;
        $stay->type_id = $request->type_id;
        $stay->beds = $request->beds;
        $stay->baths = $request->baths;
        $stay->guests = $request->guests;
        $stay->amenities = $request->amenities;
        $stay->Discount = $request->Discount;
        $stay->agency_id = $request->agency_id;

        $serviceimage = [];
        if ($request->has('service_images') && is_array($request->file('service_images'))) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename2 = rand() . '.' . $extension;
                $path = 'admin/services/';
                $image->move($path, $filename2);
                array_push($serviceimage, $path . $filename2);
            }
            $images = json_encode($serviceimage);
            
            $stay->service_images = $images;
        } else {
            $stay->service_images = json_encode([]);
        }
        $stay->save();

        return redirect()->route('stays.store', [
            'service_id' => $stay->service_id,
            'category_id' => $stay->category_id,
            'type_id' => $stay->type_id,
            'agency_id' => $stay->agency_id
        ])->with('success', 'Stay updated successfully.');
    }

    public function edit($id)
    {
        $stay = stay::with('images')->findOrFail($id);
        return view('Stays.edit', compact('stay'));
    }

    public function destroy($id)
    {
        $stay = stay::where('id',$id)->first();
        if (!empty($stay->service_images)) {
            $images = json_decode($stay->service_images, true);
            if (is_array($images)) {
                foreach ($images as $imagePath) {
                    \Storage::disk('public')->delete($imagePath);
                }
            }
        }

        if (empty($stay->service_images)) {
            $images = json_decode($stay->service_images, true);
            if (is_array($images)) {
                foreach ($images as $imagePath) {
                    \Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $stay->delete();

        return redirect()->route('stays.index')->with('success', 'Stay deleted successfully.');
    }

}
