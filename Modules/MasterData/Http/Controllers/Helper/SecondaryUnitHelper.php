<?php

namespace Modules\MasterData\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeBangunan;

class SecondaryUnitHelper extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'tipe_bangunan' => TipeBangunan::select('id AS value', 'nama_tipe_bangunan AS text')->get(),
            'jenis_pembayaran' => json_decode(option('masterdata.jenis_pembayaran', json_encode([]))),
            'status_unit' => json_decode(option('masterdata.status_unit_secondary', json_encode([]))),
            'bersedia_dipasang' => json_decode(option('masterdata.bersedia_dipasang', json_encode([]))),
            'sertifikat' => json_decode(option('masterdata.sertifikat', json_encode([]))),
            'open_house' => json_decode(option('masterdata.open_house', json_encode([]))),
            'approved_status' => json_decode(option('masterdata.approved_status', json_encode([]))),
            'kondisi_bangunan' => json_decode(option('masterdata.kondisi_bangunan', json_encode([]))),
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
