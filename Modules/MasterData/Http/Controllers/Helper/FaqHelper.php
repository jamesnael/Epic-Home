<?php

namespace Modules\MasterData\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\KategoriFaq;

class FaqHelper extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'menu' => ['Untuk Pelanggan', 'Untuk Agen Properti', 'Untuk Pemilik Properti'],
            'kategori' => KategoriFaq::pluck('nama'),
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
