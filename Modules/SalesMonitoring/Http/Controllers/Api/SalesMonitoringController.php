<?php

namespace Modules\SalesMonitoring\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SalesMonitoring\Entities\SalesMonitoring;
use Modules\SalesMonitoring\Entities\TagBerita;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SalesMonitoringController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
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

            log_activity(
                'Tambah data sales monitoring ' . $data->judul,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Data Sales Monitoring berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param SalesMonitoring $sales_monitoring
     * @return Renderable
     */
    public function update(Request $request, SalesMonitoring $sales_monitoring)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $sales_monitoring->update($request->all());

            if ($request->hasFile('file_attachment')) {
                $file_attachment = $request->file('file_attachment');
                $file_attachment_name = 'file_attachment' . uniqid() . '.' . $file_attachment->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales_monitoring/file_attachment', $file_attachment, $file_attachment_name
                    );
                $sales_monitoring->file_attachment = $file_attachment_name;
            }

            $sales_monitoring->save();

            log_activity(
                'Ubah data sales monitoring ' . $sales_monitoring->judul,
                $sales_monitoring
            );

            DB::commit();
            return response_json(true, null, 'Data Sales Monitoring berhasil disimpan.', $sales_monitoring);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param SalesMonitoring $sales_monitoring
     * @return Renderable
     */
    public function destroy(SalesMonitoring $sales_monitoring)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus data sales monitoring ' . $sales_monitoring->judul,
                $sales_monitoring
            );
            
            $sales_monitoring->delete();
            DB::commit();
            return response_json(true, null, 'Data Sales Monitoring dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param SalesMonitoring $sales_monitoring
     * @return Renderable
     */
    public function data(SalesMonitoring $sales_monitoring)
    {
        $sales_monitoring->url_file_attachment = get_file_url('public', 'sales_monitoring/file_attachment/' . $sales_monitoring->file_attachment);

        return response_json(true, null, 'Data retrieved', $sales_monitoring);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'id_klien' => 'bail|required',
            'tanggal_follow_up' => 'bail|required',
            'status' => 'bail|required',
            'note' => 'bail|sometimes|nullable',
            'file_attachment' => 'bail|sometimes|nullable',
        ]);
    }

    /**
     *
     * Get the resources from storage.
     * @return Renderable
     *
     */
    public function table(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $query = SalesMonitoring::with('klien', 'klien.sales');

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('tanggal_follow_up', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('status', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('klien', function($subquery) use ($request){
                $subquery->where('nama_klien', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('klien.sales', function($subquery) use ($request){
                $subquery->where('nama_depan', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_belakang', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->orderBy('status', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->sales_full_name = $item->klien->sales->nama_depan . ' ' . $item->klien->sales->nama_belakang;
            $item->detail = "";
            $item->url_file_attachment = get_file_url('public', 'sales_monitoring/file_attachment/' . $item->file_attachment);
            $item->follow_up_date = \Carbon\Carbon::parse($item->tanggal_follow_up)->locale('id')->translatedFormat('d F Y');
            $item->created_date = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y');
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Validation Rules for Get Table Data
     *
     */
    public function validateTableRequest($request)
    {
        return Validator::make($request->all(), [
            "page" => "bail|sometimes|required|numeric|min:1",
            "search" => "bail|present|nullable",
            "paginate" => "bail|required|numeric|in:10,20,50,100",
        ]);
    }
}
