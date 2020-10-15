<?php

namespace Modules\ManageUser\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
            'jenis_kelamin' => json_decode(option('jenis_kelamin', json_encode([]))),
            'tipe_agent' => json_decode(option('tipe_agent', json_encode([]))),
            'status_sales' => json_decode(option('status_sales', json_encode([]))),
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
