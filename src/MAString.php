<?php
namespace MawebDK\SimpleDatatypes;

/**
 * String value with limitations specified by the abstract method isValidValue().
 */
abstract class MAString
{
    /**
     * Determines is the given value is a valid value.
     * @param string $value        Value being evaluated.
     * @return bool                True if value is a valid value, false otherwise.
     * @throws MAStringException   Failed to determine if the given value is a valid value.
     */
    abstract public static function isValidValue(string $value): bool;

    /**
     * Constructor.
     * @param string $value        Value.
     * @throws MAStringException   Failed to determine if the given value is a valid value or value is invalid.
     */
    public function __construct(public string $value)
    {
        if (!static::isValidValue(value: $value)):
            throw new MAStringException(message: sprintf('Value "%s" is not valid.', $value));
        endif;
    }
}