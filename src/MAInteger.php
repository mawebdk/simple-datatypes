<?php
namespace MawebDK\SimpleDatatypes;

/**
 * Integer value with limitations specified by the abstract method isValidValue().
 */
abstract class MAInteger
{
    /**
     * Determines is the given value is a valid value.
     * @param int $value            Value being evaluated.
     * @return bool                 True if value is a valid value, false otherwise.
     * @throws MAIntegerException   Failed to determine if the given value is a valid value.
     */
    abstract public static function isValidValue(int $value): bool;

    /**
     * Constructor.
     * @param int $value            Value.
     * @throws MAIntegerException   Failed to determine if the given value is a valid value or value is invalid.
     */
    public function __construct(public int $value)
    {
        if (!static::isValidValue(value: $value)):
            throw new MAIntegerException(message: sprintf('Value %d is not valid.', $value));
        endif;
    }
}