<?php

namespace Modules\ManageUser\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\AgentProperty;

class SalesHelper extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'tipe_agent' => json_decode(option('manageuser.tipe_agent', json_encode([]))),
            'kantor_agent' => AgentProperty::get(),
            'jenis_kelamin' => json_decode(option('manageuser.jenis_kelamin', json_encode([]))),
            'provinsi' => [],
            'kota' => [],
            'kecamatan' => [],
            'kelurahan' => [],
            'status_sales' => json_decode(option('manageuser.status_sales', json_encode([]))),
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
