<?php
namespace MawebDK\SimpleDatatypes\Test;

use MawebDK\SimpleDatatypes\MAInteger;
use MawebDK\SimpleDatatypes\MAIntegerException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MAIntegerTest extends TestCase
{
    /**
     * @throws MAIntegerException
     */
    #[DataProvider('dataProviderIsValidValue')]
    public function testIsValidValue(int $value, bool $expectedIsValid)
    {
        $this->assertSame(
            expected: $expectedIsValid,
            actual: MAIntegerTest_MAInteger_Sample::isValidValue(value: $value)
        );
    }

    public static function dataProviderIsValidValue(): array
    {
        return [
            'PHP_INT_MIN' => ['value' => PHP_INT_MIN, 'expectedIsValid' => false],
            '-1'          => ['value' => -1,          'expectedIsValid' => false],
            '0'           => ['value' => 0,           'expectedIsValid' => false],
            '1'           => ['value' => 1,           'expectedIsValid' => true],
            '100'         => ['value' => 100,         'expectedIsValid' => true],
            '101'         => ['value' => 101,         'expectedIsValid' => false],
            'PHP_INT_MAX' => ['value' => PHP_INT_MAX, 'expectedIsValid' => false],
        ];
    }

    /**
     * @throws MAIntegerException
     */
    #[DataProvider('dataProvider__construct')]
    public function test__construct(int $value)
    {
        $maInteger = new MAIntegerTest_MAInteger_Sample(value: $value);

        $this->assertSame(expected: $maInteger->value, actual: $value);
    }

    public static function dataProvider__construct(): array
    {
        return [
            '1'   => ['value' => 1],
            '100' => ['value' => 100],
        ];
    }

    #[DataProvider('dataProvider__construct_MAIntegerException')]
    public function test__construct_MAIntegerException(int $value, string $expectedExceptionMessage)
    {
        $this->expectException(exception: MAIntegerException::class);
        $this->expectExceptionMessage(message: $expectedExceptionMessage);

        new MAIntegerTest_MAInteger_Sample(value: $value);
    }

    public static function dataProvider__construct_MAIntegerException(): array
    {
        return [
            'PHP_INT_MIN' => ['value' => PHP_INT_MIN, 'expectedExceptionMessage' => 'Value -9223372036854775808 is not valid.'],
            '-1'          => ['value' => -1,          'expectedExceptionMessage' => 'Value -1 is not valid.'],
            '0'           => ['value' => 0,           'expectedExceptionMessage' => 'Value 0 is not valid.'],
            '101'         => ['value' => 101,         'expectedExceptionMessage' => 'Value 101 is not valid.'],
            'PHP_INT_MAX' => ['value' => PHP_INT_MAX, 'expectedExceptionMessage' => 'Value 9223372036854775807 is not valid.'],
        ];
    }
}

class MAIntegerTest_MAInteger_Sample extends MAInteger
{
    public static function isValidValue(int $value): bool
    {
        return (($value >= 1) && ($value <= 100));
    }
}