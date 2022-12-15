<?php

namespace App\Traits;

use App\Exceptions\InvalidTransformerInResponseException;
use App\Transformers\TransformerInterface;
use ReflectionClass;
use ReflectionException;

trait ResponseTransformsData
{
    /**
     * @return array
     * @throws InvalidTransformerInResponseException
     */
    private function transformData(): array
    {
        $transformerClass = $this->getTransformerClass();

        $exceptionMessage = sprintf(
            'Transformer class "%s" either does not exist or does not implement TransformerInterface.',
            $transformerClass
        );

        try {
            $reflection = (new ReflectionClass($transformerClass));

            if (!$reflection->implementsInterface(TransformerInterface::class)) {
                throw new InvalidTransformerInResponseException($exceptionMessage);
            }

            $method = $reflection->getMethod('transform');

            return $this->executeTransformation($method);
        } catch (ReflectionException) {
            throw new InvalidTransformerInResponseException($exceptionMessage);
        }
    }
}
