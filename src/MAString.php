<?php
namespace MawebDK\SimpleDatatypes;

/**
 * String value with limitations specified by the abstract method isValidValue().
 */
abstract class MAString
{
    /**
     * Static constructor.
     * @param string|null $value   Value.
     * @return self|null           New instance of the implementing class, null if the supplied value is null.
     * @throws MAStringException   Failed to determine if the given value is a valid value or value is invalid.
     */
    public static function createFromValue(?string $value): ?self
    {
        if (is_null($value)):
            return null;
        else:
            return new static(value: $value);
        endif;
    }

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