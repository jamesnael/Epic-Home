<?php 

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (! function_exists('format_money')) {
    function format_money($value=0)
    {
        return number_format($value, 0, ',', '.');
    }
}

if (! function_exists('clean_string')) {
    function clean_string($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.

        return str_replace('=', '', $string);
    }
}

if (! function_exists('trim_string')) {
    function trim_string($string, $length = 30, $suffix = '...')
    {
        if (strlen($string) > $length) {

            // truncate string
            $stringCut = substr($string, 0, $length);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
            $string .= $suffix;
        }
        return $string;
    }
}

if (! function_exists('response_json')) {
    function response_json($success = false, $error = null, $message = '', $data = null, $filter = null)
    {
        $response = [
            'success' => $success,
            'error' => $error,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }
        
        if ($filter) {
            $response['filter'] = $filter;
        }

        return response()->json($response);
    }
}

if (! function_exists('uniqid_real')) {
    function uniqid_real($length = 13) {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return strtoupper(substr(bin2hex($bytes), 0, $length));
    }
}

if (! function_exists('prepare_main_menu')) {
    function prepare_main_menu() {
        $current_route = explode('.', Route::currentRouteName());
        array_pop($current_route);

        $main_menu = config('core.main_menu');
        $collection = collect($main_menu)->transform(function($item) use ($current_route) {
            if ($item['children']) {
                $item['children'] = collect($item['children'])->transform(function($item) use ($current_route) {
                    $uri = str_replace('.index', '', $item['uri']);
                    $uri = str_replace('.show', '', $uri);
                    $uri = str_replace('.create', '', $uri);
                    $uri = str_replace('.edit', '', $uri);

                    $item['model'] = in_array($uri, $current_route);

                    return $item;
                });
            } else {
                $uri = str_replace('.index', '', $item['uri']);
                $uri = str_replace('.show', '', $uri);
                $uri = str_replace('.create', '', $uri);
                $uri = str_replace('.edit', '', $uri);

                $item['model'] = in_array($uri, $current_route);
            }

            $have_true_child = collect($item['children'])->sum(function($item) {
                return $item['model'] ? 1 : 0;
            });

            $item['model'] = $item['model'] ?: ($have_true_child > 0 ? true : false);

            return $item;
        });

        return $collection;
    }
}

if (! function_exists('get_file_url')) {
    function get_file_url($disk_name = 'public', $file_name) {
        if ($file_name) {
            return Storage::disk($disk_name)->url($file_name);
        }

        return $file_name;
    }
}

if (! function_exists('get_access_url')) {
    function get_access_url() {
        \Artisan::call('route:list --json');
        $routes = json_decode(\Artisan::output(), true);
        $collection = collect($routes);
        $filtered = $collection->transform(function($item) {
            return collect($item)->only(['method', 'uri', 'name']);
        })
        ->filter(function($item, $key) {
            $available_method = [
                "GET|HEAD", 
                "DELETE"
            ];
            $unavailable_name = [
                "underconstruction", 
                "debugbar", 
                "ignition"
            ];
            $unavailable_uri = [
                "register", 
                "logout", 
                "password/", 
                "login", 
                "fallbackPlaceholder", 
                "table", 
                "/data", 
                "helper"
            ];

            if (! Str::contains($item['name'], $unavailable_name) &&
                Str::contains($item['method'], $available_method) &&
                !Str::contains($item['uri'], $unavailable_uri) &&
                $item['name']
                ) {
                return $item;
            }
            return;
        });

        $routes = $filtered->filter()->values();

        $output = [];
        foreach ($routes as $key => $route) {
            $path = str_replace('api/', '', $route['uri']);
            $array_path = explode('/', $path);
            $main_menu = Str::title($path = str_replace('-', ' ', $array_path[0]));
            if (!isset($array_path[1]) ||  
                (isset($array_path[1]) && Str::contains($array_path[1], ['{', '}']))
            ) {
                $menu = $main_menu;
            } else {
                $menu = Str::title($path = str_replace('-', ' ', $array_path[1]));
            }
            $route['main_menu'] = $main_menu;
            $route['menu'] = $menu;
            $array_name = explode('.', $route['name']);
            if (end($array_name) == 'index') {
                $route['deskripsi'] = 'Tabel ' . Str::title(str_replace('-', ' ', $array_path[1]));
            } elseif (end($array_name) == 'create') {
                $route['deskripsi'] = 'Tambah ' . Str::title(str_replace('-', ' ', $array_path[1]));
            } elseif (end($array_name) == 'edit') {
                $route['deskripsi'] = 'Ubah ' . Str::title(str_replace('-', ' ', $array_path[1]));
            } elseif (end($array_name) == 'show') {
                $route['deskripsi'] = 'Detil ' . Str::title(str_replace('-', ' ', $array_path[1]));
            } elseif (end($array_name) == 'destroy') {
                $route['deskripsi'] = 'Hapus ' . Str::title(str_replace('-', ' ', $array_path[1]));
            } else {
                $route['deskripsi'] = '';
            }
            $output[] = $route;
        }

        $group_by_menu = collect($output)->groupBy('main_menu')->toArray();

        return collect($group_by_menu)->transform(function($item) {
            return collect($item)->groupBy('menu');
        })->toArray();
    }
}
