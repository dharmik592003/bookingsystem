<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Service;
use App\Models\stay;
use App\Models\car;
use App\Models\yacht;
use App\Models\type;
use App\Models\port;
use App\Models\servicecategory;
use Session;
use Illuminate\Http\Request;

class YachtController extends Controller
{
    public function index()
    {
        $ports =port::all();
        $category = servicecategory::where('id', 3)->first();
        $services = Service::where('category_id', 3)->with('types', 'category')->get()->all();
        $yachts = yacht::all();
        $user = User::where('id', '=', Session::get('loginid'))->first();
        return view('Yacht.index', compact('ports','yachts', 'user', 'services', 'category'));
    }

    public function filter(Request $request)
    {
        $query = yacht::query();

        // Join with bookings table to check availability
        $query->leftJoin('bookings', function ($join) {
            $join->on('yachts.id', '=', 'bookings.Charter_id')
                ->where(function ($query) {
                    $query->where('bookings.Departure', '>=', now())
                          ->orWhereNull('bookings.Departure');
                });
        });

        // Filter by departure
        if ($request->filled('Departure')) {
            $query->where('bookings.Departure', $request->Departure);
        }

        // Filter by arrival
        if ($request->filled('Arrival')) {
            $query->where('bookings.Arrival', $request->Arrival);
        }

        // Ensure only available charters are shown
        $query->whereNull('bookings.id');

        $charters = $query->select('yachts.*')->get();
        return response()->json([
            'status' => 'success',
            'data' => $charters
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'service_id' => 'required|integer',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'length' => 'nullable|numeric',
            'cabins' => 'nullable|integer',
            'guests' => 'nullable|integer',
            'amenities' => 'nullable|string|max:255',
        ]);

        $yacht = new yacht();
        $yacht->name = $request->name;
        $yacht->service_id = $request->service_id;
        $yacht->category_id = $request->category_id;
        $yacht->type_id = $request->type_id;
        $yacht->agency_id = $request->agency_id;
        $yacht->length = $request->length;
        $yacht->cabins = $request->cabins;
        $yacht->guests = $request->guests;
        $yacht->amenities = $request->amenities;
        $yacht->Discount = $request->Discount;

        $serviceImages = [];
        if ($request->has('service_images')) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = rand() . '.' . $extension;
                $path = 'admin/yachts/';
                $image->move($path, $filename);
                $serviceImages[] = "{$path}{$filename}";
            }
            $yacht->service_images = json_encode($serviceImages);
        } else {
            $yacht->service_images = json_encode([]);
        }

        $yacht->save();

        return redirect()->back()->with('success', 'Yacht created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'length' => 'nullable|numeric',
            'cabins' => 'nullable|integer',
            'guests' => 'nullable|integer',
            'amenities' => 'nullable|string|max:255',
        ]);

        $yacht = yacht::findOrFail($id);
        $yacht->name = $request->name;
        $yacht->length = $request->length;
        $yacht->cabins = $request->cabins;
        $yacht->guests = $request->guests;
        $yacht->amenities = $request->amenities;
        $yacht->Discount = $request->Discount;

        $serviceImages = [];
        if ($request->has('service_images') && is_array($request->file('service_images'))) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = rand() . '.' . $extension;
                $path = 'admin/yachts/';
                $image->move($path, $filename);
                $serviceImages[] = "{$path}{$filename}";
            }
            $yacht->service_images = json_encode($serviceImages);
        } else {
            $yacht->service_images = json_encode([]);
        }

        $yacht->save();

        return back()->with('success', 'Yacht updated successfully.');
    }

    public function edit($id)
    {
        $yacht = yacht::findOrFail($id);
        return view('Yachts.edit', compact('yacht'));
    }

    public function destroy($id)
    {
        $yacht = yacht::findOrFail($id);
        if (!empty($yacht->service_images)) {
            $images = json_decode($yacht->service_images, true);
            if (is_array($images)) {
                foreach ($images as $imagePath) {
                    \Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $yacht->delete();

        return redirect()->route('Yachts.index')->with('success', 'Yacht deleted successfully.');
    }
}
