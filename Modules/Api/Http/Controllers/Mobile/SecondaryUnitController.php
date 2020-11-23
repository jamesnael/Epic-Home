<?php

namespace Modules\Api\Http\Controllers\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Unit as SecondaryUnit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Rules\SignedPhoneNumber;

class SecondaryUnitController extends Controller
{
    public function index(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }
    
        $data = SecondaryUnit::with('tipe_bangunan')->orderBy('created_at', 'desc')->get();

        $data->transform(function($item) {
            $array_gallery_unit = json_decode($item->gallery_unit, true);
            $files_gallery_unit=[];
            foreach ($array_gallery_unit ?? [] as $key => $value) {
                array_push($files_gallery_unit, get_file_url('public', 'secondary_unit/gallery_unit/' . $value));
            }

            $item->url_gallery_unit = $files_gallery_unit;

            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    public function detail(Request $request, $id)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }
    
        $data = SecondaryUnit::with('tipe_bangunan')->where('id', $id)->orderBy('created_at', 'desc')->get();

        $data->transform(function($item) {
            $array_gallery_unit = json_decode($item->gallery_unit, true);
            $files_gallery_unit=[];
            foreach ($array_gallery_unit ?? [] as $key => $value) {
                array_push($files_gallery_unit, get_file_url('public', 'secondary_unit/gallery_unit/' . $value));
            }

            $item->url_gallery_unit = $files_gallery_unit;

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
            "paginate" => "bail|sometimes|required|numeric",
        ]);
    }
}
