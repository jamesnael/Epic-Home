<?php

namespace Modules\MasterData\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\ProyekPrimary;
use Modules\MasterData\Entities\Cluster;
use Modules\MasterData\Entities\TipeUnit;

class UnitHelper extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper($proyek_primary = null)
    {
        return [
            'proyek_primari' => ProyekPrimary::select('id AS value', 'nama_proyek AS text')->where('id', $proyek_primary->id)->get(),
            'cluster' => Cluster::select('id AS value', 'nama_cluster AS text')->get(),
            'tipe_unit' => TipeUnit::select('id AS value', 'nama_tipe_unit AS text')->where('id_proyek_primary', $proyek_primary->id)->get(),
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
