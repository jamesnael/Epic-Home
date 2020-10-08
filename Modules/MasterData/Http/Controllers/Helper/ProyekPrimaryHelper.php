<?php

namespace Modules\MasterData\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeBangunan;
use Modules\MasterData\Entities\Developer;
use Modules\MasterData\Entities\TipeProyek;
use Modules\MasterData\Entities\Cluster;

class ProyekPrimaryHelper extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'tipe_proyek' => TipeProyek::select('id AS value', 'nama AS text')->get(),
            'tipe_bangunan' => TipeBangunan::select('id AS value', 'nama_tipe_bangunan AS text')->get(),
            'developer' => Developer::select('id AS value', 'nama_developer AS text')->get(),
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
