<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Voucher;
use App\Http\Requests\Backend\Vouchers\CreateVouchersRequest;
use App\Http\Requests\Backend\Vouchers\UpdateVouchersRequest;

class VouchersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $vouchers = Voucher::all();

        $index = 1;

        return view('backend.vouchers.index', compact('vouchers','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateVouchersRequest $request)
    {
        $data =  $request->except('valid_from','valid_until');
        $data['valid_from']     = $request->valid_from  != '' ? $request->valid_from  :   NULL ;
        $data['valid_until']    = $request->valid_until != '' ? $request->valid_until :   NULL ;
        $voucher = Voucher::create($data);

        return redirect()->route('gjadmin.vouchers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $voucher = Voucher::findOrFail($id);

        return view('backend.vouchers.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
    
        return view('backend.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateVouchersRequest $request, $id)
    {       
        $voucher = Voucher::findOrFail($id);
        $data =  $request->except('valid_from','valid_until');
        $data['assigned_to_user'] = ( $request->assigned_to_user == '0' ? NULL : $request->assigned_to_user );
        $data['valid_from']     = $request->valid_from  != '' ? $request->valid_from  :   NULL ;
        $data['valid_until']    = $request->valid_until != '' ? $request->valid_until :   NULL ;
        $voucher->update($data);
        return redirect()->back()->with('message','The voucher "'. $voucher->code .'" was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        
        $voucher->delete();
    
        return redirect()->route('gjadmin.vouchers.index')->with('message','The voucher "' . $voucher->code . '" was successfully deleted.');
    }

}
