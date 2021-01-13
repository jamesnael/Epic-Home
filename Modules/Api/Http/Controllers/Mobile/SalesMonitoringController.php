<?php

namespace Modules\Api\Http\Controllers\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Modules\SalesMonitoring\Entities\SalesMonitoring;

class SalesMonitoringController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Invalid form data', $validator->errors()->first());
        }

        $data = SalesMonitoring::with('klien', 'klien.sales')->whereDate('created_at', \Carbon\Carbon::today())->get();
        
        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $slug)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Invalid form data', $validator->errors()->first());
        }

        $data = SalesMonitoring::with('klien', 'klien.sales')->whereSlug($slug)->first();
        
        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $data = SalesMonitoring::create($request->all());

            if ($request->hasFile('file_attachment')) {
                $file_attachment = $request->file('file_attachment');
                $file_attachment_name = 'file_attachment-' . uniqid() . '.' . $file_attachment->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales_monitoring/file_attachment', $file_attachment, $file_attachment_name
                    );
                $data->file_attachment = $file_attachment_name;
            }

            $data->save();

            DB::commit();
            return response_json(true, null, 'Data Sales Monitoring berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesMonitoring $slug)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $slug->update($request->all());

            if ($request->hasFile('file_attachment')) {
                $file_attachment = $request->file('file_attachment');
                $file_attachment_name = 'file_attachment' . uniqid() . '.' . $file_attachment->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales_monitoring/file_attachment', $file_attachment, $file_attachment_name
                    );
                $slug->file_attachment = $file_attachment_name;
            }

            $slug->save();

            DB::commit();
            return response_json(true, null, 'Data Sales Monitoring berhasil disimpan.', $slug);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    public function validateDataRequest($request)
    {
        return Validator::make($request->all(), [
            'paginate' => 'bail|sometimes|required|numeric|min:10',
        ]);
    }

    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            "id_klien" => "bail|required|exists:Modules\Transaksi\Entities\Klien,id",
            "tanggal_follow_up" => "bail|required|date_format:Y-m-d",
            "status" => "bail|required|in:Contact,Interest,Visit/Prospect,Closing",
            "note" => "bail|nullable|sometimes",
            "file_attachment" => "bail|nullable|sometimes|mimes:jpg,jpeg,png",
        ]);
    }
}
