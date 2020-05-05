<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

trait ToArray
{
    public function toArray()
    {
        $data = [];
        $r = new \ReflectionClass($this);
        $properties = $r->getProperties();

        foreach ($properties as $property)
        {
            $name = str_replace('_', '-', $property->getName());

            $property->setAccessible(true);
            $value = $property->getValue($this);

            if ($value instanceof Schema) {
                $data[$name] = $value->schema();
            } elseif(is_object($value)) {
                if ($value instanceof Arrayable) {
                    $value = $value->toArray();
                    $data[$name] = $value;
                }
            }
            elseif (is_array($value)) {
                foreach ($value as $key => $v) {
                    if ($v instanceof Schema) {
                        $data[$name][$key] = $v->schema();
                    } elseif(is_object($v)) {
                        if ($v instanceof Arrayable) {
                            $v = $v->toArray();
                            $data[$name][$key] = $v;
                        }
                    } elseif (!is_array($v)) {
                        $data[$name][$key] = $v;
                    }
                }
            }
            elseif (!is_null($value)) {
                $data[$name] = $value;
            }
        }

        return $data;
    }
}