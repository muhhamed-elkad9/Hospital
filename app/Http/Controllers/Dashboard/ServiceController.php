<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSingleServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return view('Dashboard.Service.SingleServices.index', compact('services'));
    }

    public function store(StoreSingleServiceRequest $request)
    {
        DB::beginTransaction();

        try {

            $services = new Service();
            $services->price = $request->price;
            $services->description = $request->description;
            $services->status = 1;
            $services->save();
            // // store trans
            $services->name = $request->name;
            $services->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Service.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(StoreSingleServiceRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $services = Service::find($id);
            $services->price = $request->price;
            $services->description = $request->description;
            $services->status = $request->status;
            $services->save();
            // // store trans
            $services->name = $request->name;
            $services->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Service.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        Service::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('Service.index');
    }
}
