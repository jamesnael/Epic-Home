<?php

namespace Modules\ManageUser\Http\Controllers\Api\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\AgentProperty;

class VerifikasiController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'agent_property' => AgentProperty::get(),
            'provinsi' => [],
            'kota' => [],
            'kecamatan' => [],
            'kelurahan' => [],
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
