<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;


class ArticleService
{
    protected $notSpecial;
    protected $overridable;
    protected $defaulConfig;

    public function __construct()
    {
        $this->defaulConfig =  [
            'sort_by' => 'id',
            'show_category' => true,
            'show_image' => true,
            'limit' => 5
        ];

        $this->notSpecial = [
            'category' => false,
            'sort_by' => true,
            'show_category' => true,
            'show_image' => true,
            'date' => [true, 'start' => true, 'end' => true],
            'limit' => true
        ];

        $this->overridable = ['category', 'date', 'limit', 'sort_by', 'show_image'];
    }

    public function validateParams(array $params)
    {
        $validator = Validator::make($params, [
            'category' => 'array',
            'sort_by' => 'string|in:id,publish_start',
            'show_category' => 'string|in:true,false',
            'show_image' => 'string|in:true,false',
            'date' => 'date|nullable',
            'date_start' => 'date|nullable',
            'date_end' => 'date|nullable',
            'limit' => 'integer'

        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $params;
    }

    public function userHasPermission(String $param)
    {
        $role = auth()->user()->role;

        if ($role == 1) {
            return true;
        }
        if (array_key_exists($param, $this->notSpecial) && $this->notSpecial[$param] === true) {
            return true;
        }
        if (
            $param === 'date' &&
            array_key_exists('start', $this->notSpecial['date']) &&
            $this->notSpecial['date']['start'] === true &&
            array_key_exists('end', $this->notSpecial['date']) &&
            $this->notSpecial['date']['end'] === true
        ) {
            return true;
        }
        return false;
    }

    public function returnJsonParams(array $array)
    {
        $array = $this->validateParams($array);
        if ($array['date'] == '') {
            if ($array['date_start'] != '' && $array['date_end'] != '') {
                unset($array['date']);
                $array['date']['start'] = $array['date_start'];
                $array['date']['end'] = $array['date_end'];
            } else {
                unset($array['date']);
            }
        }
        unset($array['date_start']);
        unset($array['date_end']);
        unset($array['_token']);
        return response()->json($array);
    }

    public function filterAndSort($config, $query)
    {
        $config = self::getConfig($config);

        if (isset($config['category'])) {
            $query->whereIn('category_id', $config['category']);
        }

        if (isset($config['date'])) {
            $date = $config['date'];
            if (isset($date['start'])) {
                $query->whereHas('article', function ($query) use ($date) {
                    return $query->whereDate('created_at', '>=', $date['start']);
                });
            }
            if (isset($date['end'])) {
                $query->whereHas('article', function ($query) use ($date) {
                    return $query->whereDate('created_at', '<=', $date['end']);
                });
            } else {
                $query->whereHas('article', function ($query) use ($date) {
                    return $query->whereDate('created_at', '=', $date);
                });
            }
        }

        if (isset($config['sort_by'])) {

            $query->whereHas('article', function ($query) use ($config) {
                return $query->orderBy($config['sort_by']);
            });
        }

        return $query->get();
    }


    public function getConfig($config)
    {
        // If no config is passed, return default config

        if ($config == null) {
            return $this->defaulConfig;
        }
        $config = json_decode($config, true);

        // Remove all keys that are not overridable

        foreach ($config as $key => $value) {
            if (!in_array($key, $this->overridable)) {
                unset($config[$key]);
            }
        }

        // Merge default config with passed config

        $config = array_merge($this->defaulConfig, $config);
        return $config;
    }
}
