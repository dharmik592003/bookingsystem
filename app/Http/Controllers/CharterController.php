<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\stay;
use App\Models\car;
use App\Models\charter;
use App\Models\type;
use App\Models\servicecategory;
use App\models\airport;
use Session;
use Illuminate\Http\Request;

class CharterController extends Controller
{
    public function index()
    {
        $category = servicecategory::where('id', 4)->first();
        $services = Service::where('category_id', 4)->with('type', 'category')->get()->all();
        $charters = charter::all();
$ports = airport::all();
        $user = User::where('id', '=', Session::get('loginid'))->first();
        return view('Charters.index', compact('charters','ports', 'user', 'services', 'category'));
    }

    public function filter(Request $request)
    {
        $query = charter::query();

        // Join with bookings table to check availability
        $query->leftJoin('bookings', function ($join) {
            $join->on('charters.id', '=', 'bookings.Charter_id')
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

        $charters = $query->select('charters.*')->get();
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
            'duration_hours' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'amenities' => 'nullable|string|max:255',
        ]);

        $charter = new charter();
        $charter->name = $request->name;
        $charter->service_id = $request->service_id;
        $charter->category_id = $request->category_id;
        $charter->type_id = $request->type_id;
        $charter->agency_id = $request->agency_id;
        $charter->duration_hours = $request->duration_hours;
        $charter->Discount = $request->Discount;
        $charter->capacity = $request->capacity;
        $charter->amenities = $request->amenities;

        $serviceImages = [];
        if ($request->has('service_images')) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = rand() . '.' . $extension;
                $path = 'admin/charters/';
                $image->move($path, $filename);
                $serviceImages[] = "{$path}{$filename}";
            }
            $charter->service_images = json_encode($serviceImages);
        } else {
            $charter->service_images = json_encode([]);
        }

        $charter->save();

        return redirect()->back()->with('success', 'Charter created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'duration_hours' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'amenities' => 'nullable|string|max:255',
        ]);

        $charter = charter::findOrFail($id);
        $charter->name = $request->name;
        $charter->duration_hours = $request->duration_hours;
        $charter->capacity = $request->capacity;
        $charter->amenities = $request->amenities;
        $charter->Discount = $request->Discount;

        $serviceImages = [];
        if ($request->has('service_images') && is_array($request->file('service_images'))) {
            foreach ($request->file('service_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = rand() . '.' . $extension;
                $path = 'admin/charters/';
                $image->move($path, $filename);
                $serviceImages[] = "{$path}{$filename}";
            }
            $charter->service_images = json_encode($serviceImages);
        } else {
            $charter->service_images = json_encode([]);
        }

        $charter->save();

        return back()->with('success', 'Charter updated successfully.');
    }

    public function edit($id)
    {
        $charter = charter::findOrFail($id);
        return view('Charters.edit', compact('charter'));
    }

    public function destroy($id)
    {
        $charter = charter::findOrFail($id);
        if (!empty($charter->service_images)) {
            $images = json_decode($charter->service_images, true);
            if (is_array($images)) {
                foreach ($images as $imagePath) {
                    \Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $charter->delete();

        return redirect()->route('Charters.index')->with('success', 'Charter deleted successfully.');
    }
}
