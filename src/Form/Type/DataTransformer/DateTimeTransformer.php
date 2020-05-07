<?php

namespace App\Form\Type\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateTimeTransformer implements DataTransformerInterface
{
    /**
     * Transforms an object (DateTime) to a string.
     *
     * @param  DateTime|null $datetime
     * @return string
     */
    public function transform($datetime)
    {
        if (null === $datetime) {
            return '';
        }

        return $datetime->format('d/m/Y H:i');
    }

    /**
     * Transforms a string to an object (DateTime).
     *
     * @param  string $datetime
     * @return DateTime|null
     */
    public function reverseTransform($datetime)
    {
        // datetime optional
        if (!$datetime) {
            return;
        }

        return new \DateTime($datetime);
    }
}