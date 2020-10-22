<?php

namespace Modules\Transaksi\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HelperTransaksi extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'perihal_pembayaran' => json_decode(option('transaksi.perihal_pembayaran', json_encode([]))),
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
