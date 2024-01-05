<?php // src/Form/DataTransformer/PriceTransformer.php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class PriceTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        // Transform the float to a string with the dot as the decimal separator
        return $value !== null ? number_format(($value), 2, '.', '') : '';
    }

    public function reverseTransform($value)
    {
        // Replace comma with dot and convert the string back to a float
        if ($value === null || $value === '') {
            return null;
        }

        $value = str_replace(',', '.', $value);
        return floatval($value)*100;
    }
}
