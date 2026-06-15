<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('category')->get();
        $categories = Category::all();
        return view('services.index', compact('services', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new Service();
        $service->service_name = $request->get('service_name');
        $service->description = $request->get('description');
        $service->price = $request->get('price');
        $service->category_id = $request->get('category_id');
        $service->tipe_service = $request->get('tipe_service');
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service->service_name = $request->get('service_name');
        $service->description = $request->get('description');
        $service->price = $request->get('price');
        $service->category_id = $request->get('category_id');
        $service->tipe_service = $request->get('tipe_service');
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete-permission', Auth::user());

        try {
            $service->delete();
            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } catch (\PDOException $ex) {
            $msg = "Make sure there is no related data before deleting it. Please contact Administrator to know more about it.";
            return redirect()->route('services.index')->with('status', $msg);
        }
    }

    // AJAX: Get Edit Form Type A
    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Service::find($id);
        $categories = Category::all();
        return response()->json([
            'status' => 'oke',
            'msg' => view('services.getEditForm', compact('data', 'categories'))->render()
        ], 200);
    }

    // AJAX: Get Edit Form Type B
    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Service::find($id);
        $categories = Category::all();
        return response()->json([
            'status' => 'oke',
            'msg' => view('services.getEditFormB', compact('data', 'categories'))->render()
        ], 200);
    }

    // AJAX: Save Update Type B
    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Service::find($id);
        $data->service_name = $request->service_name;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->category_id = $request->category_id;
        $data->tipe_service = $request->tipe_service;
        $data->save();
        return response()->json(['status' => 'oke', 'msg' => 'Service data is up-to-date!'], 200);
    }

    // AJAX: Delete tanpa reload
    public function deleteData(Request $request)
    {
        $this->authorize('delete-permission', Auth::user());

        $id = $request->id;
        $data = Service::find($id);

        try {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Service <b>' . $data->service_name . '</b> berhasil dihapus!'
            ], 200);
        } catch (\PDOException $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal menghapus! Pastikan tidak ada data terkait sebelum menghapus service ini.'
            ], 200);
        }
    }
}