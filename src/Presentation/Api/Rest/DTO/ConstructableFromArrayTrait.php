<?php

namespace App\Presentation\Api\Rest\DTO;

trait ConstructableFromArrayTrait
{
    public static function fromArray(array $data): static
    {
        # Construct a reflection method from the constructor and then get all its parameters
        $reflectionMethod = new \ReflectionMethod(static::class, '__construct');
        $reflectionParameters = $reflectionMethod->getParameters();

        $parameters = [];
        # Iterate all the parameters in the constructor and match them with the array keys
        foreach ($reflectionParameters as $reflectionParameter) {
            $parameterName = $reflectionParameter->getName();
            # In case an array key is not found in the constructor, throw an exception
            if (!\array_key_exists($parameterName, $data) && !$reflectionParameter->isOptional()) {
                # In a real project, create your own custom exception class
                throw new \LogicException(
                    'Unable to instantiate \'' . static::class . '\' from an array, argument '
                    . $parameterName .' is missing.
                     Only the following arguments are available: ' . implode(', ', \array_keys($data)));
            }

            $parameter = $data[$parameterName] ?? $reflectionParameter->getDefaultValue();
            if (\is_array($parameter) && $reflectionParameter->isVariadic()) {
                $parameters = \array_merge($parameters, $parameter);
                continue;
            }

            $parameters[] = $parameter;
        }
        # Create new class with the parameters from the array
        return new static(...$parameters);
    }
}