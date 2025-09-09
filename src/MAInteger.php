<?php
namespace MawebDK\SimpleDatatypes;

use MawebDK\ToStringBuilder\ToStringBuilder;
use Stringable;

/**
 * Integer value with limitations specified by the abstract method isValidValue().
 */
abstract class MAInteger implements Stringable
{
    /**
     * Static constructor.
     * @param int|null $value       Value.
     * @return self|null            New instance of the implementing class, null if the supplied value is null.
     * @throws MAIntegerException   Failed to determine if the given value is a valid value or value is invalid.
     */
    public static function createFromValue(?int $value): ?self
    {
        if (is_null($value)):
            return null;
        else:
            return new static(value: $value);
        endif;
    }

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

    /**
     * Returns the string representation of the object.
     * @return string   String representation of the object.
     */
    public function __toString(): string
    {
        $toStringBuilder = new ToStringBuilder(object: $this);

        return $toStringBuilder
            ->add(name: 'value', value: $this->value)
            ->build();
    }
}