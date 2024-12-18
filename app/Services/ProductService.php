<?php

namespace App\Services;

class ProductService
{
    public function getJsonAttributes(?array $data): string
    {
        if (is_null($data)) {
            return json_encode('');
        }

        $keys = [];
        $values = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($i % 2 === 0) {
                $keys[] = $data[$i];
            } else {
                $values[] = $data[$i];
            }
        }

        $output = array_combine($keys, $values);

        return json_encode($output, JSON_UNESCAPED_UNICODE);
    }
}
