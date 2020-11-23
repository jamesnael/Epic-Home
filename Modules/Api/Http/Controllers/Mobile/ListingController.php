<?php

namespace Modules\Api\Http\Controllers\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\Listing;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Modules\Core\Rules\SignedPhoneNumber;

class ListingController extends Controller
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
            $data = Listing::create($request->all());

            DB::commit();
            return response_json(true, null, 'Unit berhasil disimpan ke Listing.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request, $id = null)
    {
        return Validator::make($request->all(), [
            'id_sales' => 'bail|required|exists:Modules\ManageUser\Entities\Sales,id',
            'id_unit' => 'bail|required|exists:Modules\MasterData\Entities\Unit,id',
        ]);
    }

    public function index_primary(Request $request)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }
        
        $data = Listing::with('unit', 'sales', 'unit.proyek_primary')
                ->whereHas('unit', function($item){
                    $item->whereNotNull('id_proyek_primari');
                })
                ->orderBy('created_at', 'desc')
                ->get();

        $data->transform(function($item) {
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    public function index_secondary(Request $request)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }
        
        $data = Listing::with('unit', 'sales')
                ->whereHas('unit', function($item){
                    $item->whereNull('id_proyek_primari');
                })
                ->orderBy('created_at', 'desc')
                ->get();

        $data->transform(function($item) {
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Validation Rules for Get Data
     *
     */
    public function validateDataRequest($request)
    {
        return Validator::make($request->all(), [
            "paginate" => "bail|sometimes|required|numeric",
        ]);
    }
}
