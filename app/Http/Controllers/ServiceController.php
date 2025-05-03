<?php

namespace App\Http\Controllers;
use App\Models\agency;
use App\Models\service;
use App\Models\servicecategory;
use App\Models\User;
use App\Models\country;
use App\Models\type;
use App\Models\stay;
use App\Models\charter;
use App\Models\yacht;
use App\Models\car;
use App\Models;
use Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Session;

use Illuminate\Http\Request;

class ServiceController extends Controller implements HasMiddleware
{
   public static function middleware(): array
   {
      return [
         new Middleware('permission:Service View', ['index']),
         new Middleware('permission:Service Edit', ['edit']),
         new Middleware('permission:Service Create', ['create']),
         new Middleware('permission:Service Delete', ['delete']),
      ];
   }

   public function index()
   {
      $country = country::where('id', '=', '102')->get();
      $servicecount = servicecategory::all()->count();
      $servicecategory = servicecategory::get()->all();  
      // $agencyservicecount = service::where('agency_id', '=', Session::get('agency_id'))->count();
      $user = User::where('id', '=', Session::get('loginid'))->first();

      $userscount = User::all()->count() - 1;

      if (Session::get('loginid') == 1) {
         $services = servicecategory::get()->all();
         return view('admin.services-admin', ['user' => $user, 'total' => $servicecount, 'usercount' => $userscount, 'services' => $services]);
      } elseif (Session::get('customer_id') == 2) {
         $services = servicecategory::with('getservices')->get()->all();
         return view('user.services-customer', ['country' => $country, 'total' => $servicecount, 'usercount' => $userscount, 'services' => $services, 'user' => $user]);
      } elseif (Session::get('customer_id') == 3) {
         $agencyservices = service::where('agency_id', '=', Session::get('agency_id'))->with('category')->get()->all();
         // $agencyservice = service::where('agency_id', '=', Session::get('agency_id'))->get();
         // $agencyservicecount = service::where('agency_id', '=', Session::get('agency_id'))->count();
         // return view('services-agency', ['total' => $agencyservicecount, 'usercount' => $userscount, 'services' => $agencyservice, 'user' => $user]);
         return view('agency.services-agency', ['total' => 0, 'user' => $user, 'category' => $servicecategory, 'services' => $agencyservices]);
      }

   }




   public function getcategory(Request $request)
   {

      $states = Servicecategory::where('id', $request->id)->get();

      if ($states) {
         return response()->json(['id' => $states]);

      }
      $data = $states;
      // dd($states);->with($data)
      return view('student')->with($data);
   }






   public function Store(Request $request)
   { 

      if ((Session::get("customer_id")) == 1) {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
            'bannerimage' => 'required|mimes:png,jpg,jpeg,webp',
         ]);
         if ($validator->passes()) {
            if ($request->has('bannerimage')) {
               $file = $request->file('bannerimage');
               $extension = $file->getClientOriginalExtension();
               $filename = time() . '.' . $extension;
               $path = 'admin/services/';
               $file->move($path, $filename);
               $service = new servicecategory();
               $service->name = $request->name;
               $service->desc = $request->desc;
               $service->comissionpay = $request->comissionpay;
               $service->deductioncut = $request->deductioncut;
               $service->photo = $path . $filename;
               $service->save();
            }
            return back();
         }
         if ($validator->fails()) {
            return redirect('services')->withErrors($validator)->withInput();
         }

      } elseif ((Session::get("customer_id")) == 3) {

         $validator = Validator::make($request->all(), [
            'name' => 'required|unique:services,name',
            'desc_company' => 'required',
            'sub_service_desc' => 'required',
         ]);

         if ($validator->passes()) {

            $type1 = new type();
            $type1->name = $request->typename;
            $type1->category_id = $request->category_id;
            $type1->desc = $request->sub_service_desc;
            $type1->category_id = $request->category_id;
            $type1->pilot_price = $request->pilot_price;
            $type1->landing_fees = $request->landing_fees;
            $type1->dockage_price = $request->dockage_price;
            $type1->booking_type = $request->booking_type;
            $type1->booking_time = $request->time_slot;
            $type1->price = $request->price;
            $type1->toll = $request->toll;
            $type1->fuel_cost = $request->fuel_cost;
            $type1->room_service = $request->room_service;
            $type1->laundry_fees = $request->laundry_fees;

            $type1->agency_id = session('agency_id');
            $type1->price = $request->price;

            $type1->save();
            $bannerimages = [];
            if ($request->has('bannerimage')) {
               $image = $request->file('bannerimage');
               $extension = $image->getClientOriginalExtension();
               $filename2 = rand() . '.' . $extension;
               $path = 'admin/services/';
               $image->move($path, $filename2);
               $bannerimages = $path . $filename2;
            }

            $service = new service();
            $service->name = $request->name;
            $service->desc = $request->desc_company;
            $service->category_id = $request->category_id;
            $service->address = $request->address;
            $service->email = $request->email;
            $service->booking_start = $request->start_time;
            $service->booking_end = $request->end_time;
            $service->number = $request->number;
            $service->country_id = 102;
            $service->comapny_details = $request->desc_company;
            $service->state_id = $request->state_id;
            $service->city_id = $request->city_id;
            $service->agency_id = session('agency_id');
            $images = json_encode($bannerimages);
            $service->banner_photo = $images;

            $serviceimage = [];
            if ($request->has('serviceimage')) {
               foreach ($request->file('serviceimage') as $image) {
                  $extension = $image->getClientOriginalExtension();
                  $filename2 = rand() . '.' . $extension;
                  $path = 'admin/services/';
                  $image->move($path, $filename2);
                  array_push($serviceimage, $path . $filename2);
               }
               $images = json_encode($serviceimage);
               $service->service_images = $images;
               $service->type_id = $type1->id;
               $service->save();
               return redirect('services');
            }
         }

         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
         }
      }
   }

   public function Create()
   {
      $type = type::where('agency_id', Session::get('agency_id'))->get()->all();
      $country = country::where('id', '=', '102')->where('id', '=', '102')->get();
      $user = User::where('id', '=', Session::get('loginid'))->first();
      $servicecategory = servicecategory::get()->all();
      return view('services.addservices', ['types' => $type, 'user' => $user, 'category' => $servicecategory, 'country' => $country]);
   }
   public function edit_agency_service($id)
   {
      $user = User::where('id', '=', Session::get('loginid'))->first();
      $details = service::where('id', $id)->first();
      if ($details) {
         $servicecategory = servicecategory::get()->all();
         $country = country::where('id', '=', '102')->where('id', '=', '102')->get()->all();
         return view('services.edit', ['user' => $user, 'details' => $details, 'category' => $servicecategory, 'country' => $country]);
      }
   }

   public function update_agency_service(Request $request, $id)
   {
      $service = service::where('id', $id)->first();
      if ($service) {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
            'bannerimage' => 'required|mimes:png,jpg,jpeg,webp',
         ]);
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
         }
         $type1 = new type();
         $type1->name = $request->typename;
         $type1->desc = $request->sub_service_desc;
         $type1->category_id = $request->category_id;
         $type1->pilot_price = $request->pilot_price;
         $type1->landing_fees = $request->landing_fees;
         $type1->dockage_price = $request->dockage_price;
         $type1->pricing = $request->pricing;
         $type1->toll = $request->toll;
         $type1->fuel_cost = $request->fuel_cost;
         $type1->room_service = $request->room_service;
         $type1->laundry_fees = $request->laundry_fees;
         $type1->agency_id = session('agency_id');
         $type1->price = $request->price;

         $type1->save();
          if ($request->has('bannerimage')) {
            $file = $request->file('bannerimage');
            $extension = $file->getClientOriginalExtension();
            $filename2 = rand() . '.' . $extension;
            $path = 'admin/services/';
            $file->move($path, $filename2);
            $bannerimages = [$path . $filename2];
          }
            $service->name = $request->name;
            $service->desc = $request->desc;
            $service->comapny_details = $request->desc_company;
            $service->address = $request->address;
            $service->number = $request->number;
            $service->email = $request->email;
            $service->category_id = $request->category_id;
            $service->country_id = 102;
            $service->state_id = $request->state_id;
            $service->city_id = $request->city_id;
            $service->agency_id = session('agency_id');
            $images = json_encode($bannerimages);
            $service->banner_photo = $images;

         }
         $serviceimage = [];
         if ($request->has('serviceimage')) {
            foreach ($request->file('serviceimage') as $image) {
               $extension = $image->getClientOriginalExtension();
               $filename2 = rand() . '.' . $extension;
               $path = 'admin/services/';
               $image->move($path, $filename2);
               array_push($serviceimage, $path . $filename2);
            }
            $images = json_encode($serviceimage);
            $service->service_images = $images;
            $service->type_id = $type1->id;
            $service->save();
            return back()->with('success', 'Service updated successfully');
         }
     
      else {
         return back()->with('error', 'Service not found');
      }
   }


   public function destroy_agency_service($id)
   {

      $service = service::where('id', $id)->first();
      if ($service) {
         $service->delete();
         return back()->with('success', 'Service deleted successfully');
      } else {
         return back()->with('error', 'Service not found');
      }

   }


   public function getservice($name)
   {
      $country = country::where('id', '=', '102')->get()->all();
      $user = User::where('id', '=', Session::get('loginid'))->first();

      if (Session::get('loginid') == 1) {
         $servicecategory = servicecategory::get()->all();
         $category = ServiceCategory::where('name', '=', $name)->pluck('id')->first();
         $services = type::where('category_id', '=', $category)->with('get_type')->get()->all();
         return view('sub-services.index')->with(['country' => $country, 'services' => $services, 'category' => $servicecategory, 'user' => $user]);
      } elseif (Session::get('customer_id') == 2) {
         $categoryId = ServiceCategory::where('name', '=', $name)->pluck('id')->first();
         if ($categoryId) {
            $services = Service::where('category_id', '=', $categoryId)
               ->with(['category', 'agency.city', 'agency.state', 'agency.country'])
               ->get();
            return view('sub-services.index')->with(['country' => $country, 'services' => $services, 'user' => $user]);
         } else {
            $services = [];
         }
      }
   }


   public function getservice_user($name, $service_name)
   {
      $country = country::where('id', '=', '102')->where('id', '=', '102')->get()->all();
      $ser_id = Service::where('name', $service_name)->pluck('id')->first();
      $agencyId = Service::where('name', $service_name)->pluck('agency_id')->first();
      $type_id = Service::where('name', $service_name)->pluck('type_id')->first();
      $cat_id = Service::where('name', $name)->pluck('id')->first();
      $user = User::where('id', '=', Session::get('loginid'))->first();
      if (Session::get('loginid') == 1) {
         $servicecategory = servicecategory::get()->all();
         $category = ServiceCategory::where('name', '=', $name)->pluck('id')->first();
         $services = type::where('category_id', '=', $category)->with('get_type')->get()->all();
         return view('sub-services.index', ['services' => $services, 'category' => $servicecategory, 'user' => $user]);
      }
      if (Session::get('customer_id') == 3) {
         $categoryid = servicecategory::where('name', '=', $name)->get('id');
         $categid = servicecategory::where('name', '=', $name)->pluck('id')->first();
         if ($name == 'stays') {
            $agencyId = Session::get('agency_id');
            $sub_services = stay::where('agency_id', $agencyId)->where('service_id',$ser_id)->with('get_service')->get()->all();
            $category_name = $name;
            $cat_id = $categid;
            $serv_id = $ser_id;
            $type = $type_id;
            $agency = $agencyId;
            $info = [
               'category_id' => $cat_id,
               'service_id' => $serv_id,
               'type_id' => $type,
               'agency_id' => $agency,
            ];
            if (blank($sub_services)) {
               $sub_services = [];
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'user' => $user]);
            } else {
               $services = Service::where('id', $ser_id)->with('agency')->first();
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'services' => $services, 'user' => $user]);
            }
         }
          elseif ($name == 'Cars') {

            $category_name = $name;
            $cat_id = $categid;
            $serv_id = $ser_id;
            $type = $type_id;
            $agencyId = Session::get('agency_id');
            $sub_services = car::where('agency_id', $agencyId)->where('service_id',$ser_id)->with('get_service')->get();
            $info = [
               'category_id' => $cat_id,
               'service_id' => $serv_id,
               'type_id' => $type,
               'agency_id' => $agencyId,
            ];
            if (blank($sub_services)) {
               $sub_services = [];
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'user' => $user]);
            } else {
               $services = Service::where('id', $ser_id)->with('agency')->first();
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'services' => $services, 'user' => $user]);
            }
         } elseif ($name == 'Yacht') {
           
            $category_name = $name;
            $cat_id = $categid;
            $serv_id = $ser_id;
            $type = $type_id;
            $agencyId = Session::get('agency_id');
            $sub_services = yacht::where('agency_id', $agencyId)->where('service_id',$ser_id)->with('get_service')->get();
            $info = [
               'category_id' => $cat_id,
               'service_id' => $serv_id,
               'type_id' => $type,
               'agency_id' => $agencyId,
            ];
            if (blank($sub_services)) {
               $sub_services = [];
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'user' => $user]);
            } else {
               $services = Service::where('id', $ser_id)->with('agency')->first();
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'services' => $services, 'user' => $user]);
            }
         } elseif ($name == 'Charter') {
            $category_name = $name;
            $cat_id = $categid;
            $serv_id = $ser_id;
            $type = $type_id;
            $agencyId = Session::get('agency_id');
            $sub_services = charter::where('agency_id', $agencyId)->where('service_id',$ser_id)->with('get_service')->get();
            $info = [
               'category_id' => $cat_id,
               'service_id' => $serv_id,
               'type_id' => $type,
               'agency_id' => $agencyId,
            ];
            if (blank($sub_services)) {
               $sub_services = [];
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'user' => $user]);
            } else {
               $services = Service::where('id', $ser_id)->with('agency')->first();
               return view('sub-services.index')->with(['info' => $info, 'categoryName' => $category_name, 'country' => $country, 'allServices' => $sub_services, 'services' => $services, 'user' => $user]);
            }
         }


      } 
      elseif (Session::get('customer_id') == 2) {
         $categoryId = ServiceCategory::where('name', '=', $name)->pluck('id')->first();
         if ($categoryId == 1) {

            $services = Service::where('category_id', '=', $categoryId)->where('name', '=', $service_name)
               ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
               ->first();
               $agency_id = Service::where('name', '=', $service_name)->pluck('agency_id');
               $stay = Stay::where('agency_id', $agency_id)->with('type')->get()->all();

            return view('sub-services.index', ['stays'=>$stay,'country' => $country, 'services' => $services, 'user' => $user]);
         } 
          elseif ($categoryId == 2) {

            $services = Service::where('category_id', '=', $categoryId)->where('name', '=', $service_name)
               ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
               ->first();
               $agency_id = Service::where('name', '=', $service_name)->pluck('agency_id');
               $stay = car::where('agency_id', $agency_id)->with('get_type')->get()->all();

            return view('sub-services.index', ['stays'=>$stay,'country' => $country, 'services' => $services, 'user' => $user]);
         }
          elseif ($categoryId == 3) {

            $services = Service::where('category_id', '=', $categoryId)->where('name', '=', $service_name)
               ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
               ->first();
               $agency_id = Service::where('name', '=', $service_name)->pluck('agency_id');
               $stay = yacht::where('agency_id', $agency_id)->with('get_type')->get()->all();

            return view('sub-services.index', ['stays'=>$stay,'country' => $country, 'services' => $services, 'user' => $user]);
         }
          elseif ($categoryId == 4) {

            $services = Service::where('category_id', '=', $categoryId)->where('name', '=', $service_name)
               ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
               ->first();
               $agency_id = Service::where('name', '=', $service_name)->pluck('agency_id');
               $stay = charter::where('agency_id', $agency_id)->with('get_type')->get()->all();

            return view('sub-services.index', ['stays'=>$stay,'country' => $country, 'services' => $services, 'user' => $user]);
         }
         else {
            $services = [];
         }
      }
      // $user = User::where('id', '=', Session::get('loginid'))->first();
      // $services = service::with('service')->get();
      // $userscount = User::all()->count() - 1;

      // if (Session::get('loginid') == 1) {

      // return view('services-admin', ['user' => $user, 'total' => $servicecount, 'usercount' => $userscount, 'services' => $services]);
      // } elseif (Session::get('customer_id') == 2) {

      //    return view('services-customer', ['total' => $servicecount, 'usercount' => $userscount, 'services' => $services, 'user' => $user]);
      // } elseif (Session::get('customer_id') == 3) {
      // $agencyservice = service::where('agency_id', '=', Session::get('agency_id'))->get();
      //    $agencyservicecount = service::where('agency_id', '=', Session::get('agency_id'))->count();
      //    return view('services-agency', ['total' => $agencyservicecount, 'usercount' => $userscount, 'services' => $agencyservice, 'user' => $user]);
      // }
      // $sevice = s
      //          return view('services-admin', []);
   }


   public function edit($id)
   {
      $details = servicecategory::where('id', $id)->first();
      if ($details) {
         return response()->json(['details' => $details]);
      }
   }
   public function update(Request $request, $id)
   {
      if ($request->has('bannerimage')) {
         $file = $request->file('bannerimage');
         $extension = $file->getClientOriginalExtension();
         $filename = time() . '.' . $extension;
         $path = 'admin/services/';
         $file->move($path, $filename);
      }

      $service = servicecategory::where('id', $id)->first();
      $service->name = $request->name;
      $service->desc = $request->desc;
      $service->comissionpay = $request->comissionpay;
      $service->deductioncut = $request->deductioncut;
      $service->photo = $path . $filename;
      $service->save();
      return back();
   }


   public function delete_agency_service($id)
   {

      $service = service::where('id', $id)->first();
      if ($service) {
         $type = type::where('id', $service->types_id)->first();
         $type->delete();
         $service->delete();
         return back()->with('success', 'Agency service deleted successfully');

      }
   }

   // public function Servicefilter(Request $request)
// {
//     $country_id = $request->input('country_id');
//     $state_id = $request->input('state_id');
//     $city_id = $request->input('city_id');
//     $picking_up_date = $request->input('picking_up_date');
//     $dropping_off_date = $request->input('dropping_off_date');
//     $category_id = $request->input('category_id');


   //     $services = Service::where('category_id', $category_id)
//         ->whereHas('agency', function ($query) use ($country_id, $state_id, $city_id) {
//             $query->where('country_id', $country_id)
//                 ->where('state_id', $state_id)
//                 ->where('city_id', $city_id);
//         })
//         ->whereDate('picking_up_date', '>=', $picking_up_date)
//         ->whereDate('dropping_off_date', '<=', $dropping_off_date)
//         ->get();

   //     return response()->json($services);
// }

   public function Servicefilter(Request $request)
   {
      $services = service::where('country_id', '=', '102')
         ->where('state_id', '=', $request->state_id)
         ->where('city_id', '=', $request->city_id)
         ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'type'])
         ->get();

      $categories = [];
      foreach ($request->category_id as $category) {
         $categoryId = servicecategory::where('id', '=', $category)->pluck('id')->first();
         if ($categoryId) {
            $categories[] = $categoryId;
         }
      }

      $groupedServices = [];
      foreach ($categories as $categoryid) {
         $categoryServices = service::where('country_id', '=', '102')
            ->where('state_id', '=', $request->state_id)
            ->where('city_id', '=', $request->city_id)
            ->where('category_id', $categoryid)
            ->get();

         if ($categoryServices->count() > 0) {
            $groupedServices[] = [
               'category_id' => $categoryid, // Changed from $categoryId to $categoryid
               'category_name' => servicecategory::find($categoryid)->name, // Changed from $categoryId to $categoryid
               'services' => $categoryServices,
            ];
         } else {
            $groupedServices[] = [
               'category_id' => $categoryid, // Changed from $categoryId to $categoryid
               'category_name' => servicecategory::find($categoryid)->name, // Changed from $categoryId to $categoryid
               'services' => [],
               'message' => 'No services found',
            ];
         }
      }

      return response()->json(['services' => $groupedServices]);
   }




   public function destroy($id)
   {
      $service = servicecategory::where('id', $id)->first();
      $service->delete();
      return back();
   }
}


