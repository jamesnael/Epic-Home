<?php

namespace Modules\MasterData\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeUnit;

class UnitHelper extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'proyek_primari' => [array('value' => '1', 'text' => 'proyek 1')],
            'tipe_unit' => TipeUnit::select('nama_tipe_unit AS value', 'nama_tipe_unit AS text')->get(),
            'cluster' => [array('value' => '1', 'text' => 'cluster 1')],
        ];
    }

    /**
     *
     * Handle incoming request for form helper
     *
     */
    public function formHelper()
    {
        try {
            return response_json(true, null, 'Sukses mengambil data.', $this->getHelper());
        } catch (Exception $e) {
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat mengambil data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }
}
