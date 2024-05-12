<?php

namespace App\Http\Controllers;

use App\Services\FleetService;
use App\Http\Requests\FleetRequest;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Fleet;
class FleetController extends Controller
{
    private $_service = null;
    private $_directory = 'auth/pages/fleets';
    private $_route = 'fleets';

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct()
    {
        $this->_service = new FleetService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->_service->index();
        return view($this->_directory . '.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_directory . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FleetRequest $request)
    {

        try {
            $this->_service->store($request->validated());
            return redirect()->route($this->_route . '.index')->with('success', 'Something went wrong.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->_service->show($id);
        return view($this->_directory . '.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->_service->show($id);
        return view($this->_directory . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request Validation $validation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $this->_service->update($id, $request->all());
            return redirect()->route($this->_route . '.index')->with('success', 'Something went wrong.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->_service->destroy($id);
        return redirect()->route($this->_route . '.index');
    }

    public function gallery($id)
    {
        session(['parent_id' => $id]);
        $data = $this->_service->show($id);
        return view($this->_directory . '.gallery', compact('data'));
    }

    public function deleteImg($id)
    {
        $this->_service->imgDestroy($id);
        return redirect()->back();
    }
    // -----update gallery image

    public function ImgEdit($id)
    {
        $data = Image::findOrFail($id);
        return view($this->_directory . '.imgedit', compact('data'));

    }
    public function ImgUpdate(Request $request, $id)
    {

            $image = $request->file('image');
            $title=$request->title;
            $description=$request->description;
            $data = $this->_service->ImgUpdate($id, $image,$title,$description);
            $id = session('parent_id');
        $data = $this->_service->show(session('parent_id'));
        return view($this->_directory . '.gallery', compact('data'));

        // return redirect()->route('event-gallery', $id);
    }

    public function getTax($id)
    {
        $fleet = Fleet::findOrFail($id);
        $totalTaxAmount = 0;
    
        foreach ($fleet->taxes as $tax) {
            $totalTaxAmount += $tax->tax_amount;
        }
    
        $rate = $fleet->rate + $totalTaxAmount;
    
        return response()->json([
            'rate' => $rate,
        ]);
    }
    
}