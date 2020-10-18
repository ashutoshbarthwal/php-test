<?php

namespace App\Core\Transformers\Serializer;

use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\ArraySerializer;


class CustomDataArraySerializer extends ArraySerializer
{

    protected $resourceKey = "result";

    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return $this->resourceKey == null ? $data : [$this->resourceKey => $data];
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return $this->resourceKey == null ? $data : [$this->resourceKey => $data];
    }

    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null()
    {
        return [$this->resourceKey => []];
    }

    /**
     * Serialize the included data.
     *
     * @param ResourceInterface $resource
     * @param array $data
     *
     * @return array
     */
    public function includedData(ResourceInterface $resource, array $data)
    {
        return $data;
    }

    public function setResourceKey($resourceKey)
    {
        $this->resourceKey = $resourceKey;
    }
}
