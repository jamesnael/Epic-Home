<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Faq;
use Modules\MasterData\Entities\KategoriFaq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
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
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $kategori_faq  = KategoriFaq::all()->map(function($item){ return $item->nama; });
            if ($kategori_faq->contains($request->kategori) != 1) {
                $data_kategori = KategoriFaq::create([
                    'nama' => $request->kategori
                ]);
            }

            $data = Faq::create($request->all());
            DB::commit();
            return response_json(true, null, 'Faq berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Faq $faq
     * @return Renderable
     */
    public function update(Request $request, Faq $faq)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $kategori_faq  = KategoriFaq::all()->map(function($item){ return $item->nama; });
            if ($kategori_faq->contains($request->kategori) != 1) {
                $data_kategori = KategoriFaq::create([
                    'nama' => $request->kategori
                ]);
            }
            
            $faq->update($request->all());
            DB::commit();
            return response_json(true, null, 'Faq berhasil disimpan.', $faq);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Faq $faq
     * @return Renderable
     */
    public function destroy(Faq $faq)
    {
        DB::beginTransaction();
        try {
            $faq->delete();
            DB::commit();
            return response_json(true, null, 'Faq dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param Faq $faq
     * @return Renderable
     */
    public function data(Faq $faq)
    {
        return response_json(true, null, 'Data retrieved', $faq);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'menu' => 'bail|required|string|max:190',
            'kategori' => 'bail|required|string|max:190',
            'pertanyaan' => 'bail|required|string|max:190',
            'jawaban' => 'bail|required'
        ]);
    }
}
