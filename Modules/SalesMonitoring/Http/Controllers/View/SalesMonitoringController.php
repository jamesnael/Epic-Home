<?php

namespace Modules\SalesMonitoring\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SalesMonitoring\Entities\SalesMonitoring;

class SalesMonitoringController extends Controller
{
    /**
     * SalesMonitoringController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('sales-monitoring.index'), 'text' => 'Sales Monitoring'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Tanggal Follow Up',
                "align" => 'center',
                "sortable" => false,
                "value" => 'follow_up_date',
            ],
            [
                "text" => 'Tanggal Laporan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'created_date',
            ],
            [
                "text" => 'Nama Klien',
                "align" => 'center',
                "sortable" => false,
                "value" => 'klien.nama_klien',
            ],
            [
                "text" => 'Nomor Handphone',
                "align" => 'center',
                "sortable" => false,
                "value" => 'klien.telepone',
            ],
            [
                "text" => 'Nama Sales',
                "align" => 'center',
                "sortable" => false,
                "value" => 'sales_full_name',
            ],
            [
                "text" => 'Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'status',
            ],
            [
                "text" => 'Detail',
                "align" => 'center',
                "sortable" => false,
                "value" => 'detail',
            ],
        ];
        return view('salesmonitoring::sales_monitoring.index')
             ->with('page_title', 'Sales Monitoring')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }
}
