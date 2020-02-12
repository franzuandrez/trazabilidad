<?php


namespace App\Http\tools;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class Reportes
{

    private $except = [];
    private $title = "";
    private $subtitle = "";
    private $created_at = null;
    private $header = [];
    private $replaced = [
        '/\bID\b/', '/\bid\b/'
    ];

    private function get_headers_from_model(Model $model = null)
    {
        $headers = collect([]);
        if ($model) {
            $headers = $this->get_headers_from_table($model->getTable());
        }
        return $headers;
    }


    private function get_headers_from_table($table_name)
    {
        $headers = collect(Schema::getColumnListing($table_name));
        $headers_poocesed = $headers->map(function ($item, $key) {
            return collect(explode('_', $item))
                ->reduce(function ($carry, $item) {
                    return strtoupper($carry) . " " . strtoupper($item);
                });
        });
        $collections_headers_result = $headers->combine($headers_poocesed);


        return $collections_headers_result;
    }


    public function maped(Model $model = null)
    {


        $headers = $this->except($model);
        $attributes = collect($model == null ? [] : $model->getAttributes());

        $attributes->each(function ($item, $key) use ($headers) {
            if (!Arr::exists($headers, $key) && !in_array($key, $this->except)) {
                $headers->put($key, $key);
            }
        });

        $maped = $headers->map(function ($item, $key) use ($attributes) {
            if (Arr::exists($attributes, $key)) {
                return (object)[
                    "field" => preg_replace($this->replaced, '', $item),
                    "value" => $attributes[$key]
                ];
            }

        });


        return $maped;
    }

    public function setExcept($except = [])
    {

        $this->except = $except;
        return $this;
    }

    public function setTitle($title)
    {

        $this->title = strtoupper($title);
        return $this;

    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function setHeader($header)
    {

        $this->header = $header;
        return $this;
    }

    public function getHeader()
    {

        return $this->header;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getSubtitle()
    {

        return $this->subtitle;
    }

    public function getTitle()
    {

        return $this->title;
    }

    private function except($model)
    {
        return $this->get_headers_from_model($model)->except($this->except);

    }


    public function map_detail(Collection $collection)
    {


        $headers = $this->maped($collection->first())
            ->filter(function ($item) {
                return $item != null;
            })
            ->map(function ($item) {
                return $item->field;
            })
            ->except($this->except);


        $detail = $collection->map(function ($item) {

            return $this->maped($item)
                ->filter(function ($item) {
                    return $item != null;
                })
                ->map(function ($item) {
                    return $item->value;
                })
                ->except($this->except)
                ->toArray();
        });


        return [
            'headers' => $headers,
            'detail' => $detail
        ];


    }


    public function mapers($mapers = [])
    {

        if (count($mapers) > 0) {
            return (collect($mapers)->map(function ($item, $key) {
                if ($key == "headers") {
                    return collect($item)->map(function ($item) {

                        return $this->maped($item);
                    });
                } else {

                    return collect($item)->map(function ($item) {

                        return $this->map_detail($item);
                    });
                }

            }));
        } else {
            return $mapers;
        }


    }


}
