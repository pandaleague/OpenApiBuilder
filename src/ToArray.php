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
            $property->setAccessible(true);
            $value = $property->getValue($this);

            if ($value instanceof Schema) {
                $data[$property->getName()] = $value->getSchema();
            } elseif(is_object($value)) {
                if ($value instanceof Arrayable) {
                    $value = $value->toArray();
                    $data[$property->getName()] = $value;
                }
            }
            elseif (is_array($value)) {
                foreach ($value as $key => $v) {
                    if ($v instanceof Schema) {
                        $data[$property->getName()][$key] = $v->getSchema();
                    } elseif(is_object($v)) {
                        if ($v instanceof Arrayable) {
                            $v = $v->toArray();
                            $data[$property->getName()][$key] = $v;
                        }
                    } elseif (!is_array($v)) {
                        $data[$property->getName()][$key] = $v;
                    }
                }
            }
            elseif (!is_null($value)) {
                $data[$property->getName()] = $value;
            }
        }

        return $data;
    }
}