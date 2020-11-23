<?php

namespace Modules\Api\Http\Controllers\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\ProyekPrimary;
use Modules\MasterData\Entities\ProyekPrimaryDetail;
use Modules\MasterData\Entities\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Modules\Core\Rules\SignedPhoneNumber;

class ProyekPrimaryController extends Controller
{
    public function index(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }
    
        $data = Unit::with('tipe_unit', 'tipe_bangunan', 'proyek_primary')->whereNotNull('id_proyek_primari')->orderBy('created_at', 'desc')->get();

        $data->transform(function($item) {
            $item->proyek_primary->url_banner_proyek = get_file_url('public', 'proyek_primary/banner_proyek/' . $item->proyek_primary->banner_proyek);
        
            $item->proyek_primary->url_product_knowledge = get_file_url('public', 'proyek_primary/product_knowledge/' . $item->proyek_primary->product_knowledge);

            $array_google_map_gallery = json_decode($item->proyek_primary->google_map_gallery, true);
            $google_map_galleries=[];
            foreach ($array_google_map_gallery ?? [] as $key => $value) {
                array_push($google_map_galleries, get_file_url('public', 'proyek_primary/google_map_gallery/' . $value));
            }

            $item->proyek_primary->url_google_map_gallery = $google_map_galleries;

            $array_progress_update = json_decode($item->proyek_primary->progress_update, true);
            $files_progress_update=[];
            foreach ($array_progress_update ?? [] as $key => $value) {
                array_push($files_progress_update, get_file_url('public', 'proyek_primary/progress_update/' . $value));
            }

            $item->proyek_primary->url_progress_update = $files_progress_update;
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
    
        $data = Unit::with('tipe_unit', 'tipe_bangunan', 'proyek_primary')->whereNotNull('id_proyek_primari')->where('id', $id)->orderBy('created_at', 'desc')->get();

        $data->transform(function($item) {
            $item->proyek_primary->url_banner_proyek = get_file_url('public', 'proyek_primary/banner_proyek/' . $item->proyek_primary->banner_proyek);
        
            $item->proyek_primary->url_product_knowledge = get_file_url('public', 'proyek_primary/product_knowledge/' . $item->proyek_primary->product_knowledge);

            $array_google_map_gallery = json_decode($item->proyek_primary->google_map_gallery, true);
            $google_map_galleries=[];
            foreach ($array_google_map_gallery ?? [] as $key => $value) {
                array_push($google_map_galleries, get_file_url('public', 'proyek_primary/google_map_gallery/' . $value));
            }

            $item->proyek_primary->url_google_map_gallery = $google_map_galleries;

            $array_progress_update = json_decode($item->proyek_primary->progress_update, true);
            $files_progress_update=[];
            foreach ($array_progress_update ?? [] as $key => $value) {
                array_push($files_progress_update, get_file_url('public', 'proyek_primary/progress_update/' . $value));
            }

            $item->proyek_primary->url_progress_update = $files_progress_update;
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
