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
            '-101'        => ['value' => -101,        'expectedIsValid' => false],
            '-100'        => ['value' => -100,        'expectedIsValid' => true],
            '0'           => ['value' => 0,           'expectedIsValid' => true],
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

        $this->assertSame(expected: $value, actual: $maInteger->value);
    }

    public static function dataProvider__construct(): array
    {
        return [
            '-100' => ['value' => -100],
            '0'    => ['value' => 0],
            '100'  => ['value' => 100],
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
            '-101'        => ['value' => -101,        'expectedExceptionMessage' => 'Value -101 is not valid.'],
            '101'         => ['value' => 101,         'expectedExceptionMessage' => 'Value 101 is not valid.'],
            'PHP_INT_MAX' => ['value' => PHP_INT_MAX, 'expectedExceptionMessage' => 'Value 9223372036854775807 is not valid.'],
        ];
    }

    /**
     * @throws MAIntegerException
     */
    #[DataProvider('dataProviderCreateFromValue')]
    public function testCreateFromValue(?int $value)
    {
        $maInteger = MAIntegerTest_MAInteger_Sample::createFromValue(value: $value);

        $this->assertSame(expected: $value, actual: $maInteger?->value);
    }

    public static function dataProviderCreateFromValue(): array
    {
        return [
            'null' => ['value' => null],
            '-100' => ['value' => -100],
            '0'    => ['value' => 0],
            '100'  => ['value' => 100],
        ];
    }

    #[DataProvider('dataProviderCreateFromValue_MAIntegerException')]
    public function testCreateFromValue_MAIntegerException(int $value, string $expectedExceptionMessage)
    {
        $this->expectException(exception: MAIntegerException::class);
        $this->expectExceptionMessage(message: $expectedExceptionMessage);

        MAIntegerTest_MAInteger_Sample::createFromValue(value: $value);
    }

    public static function dataProviderCreateFromValue_MAIntegerException(): array
    {
        return [
            'PHP_INT_MIN' => ['value' => PHP_INT_MIN, 'expectedExceptionMessage' => 'Value -9223372036854775808 is not valid.'],
            '-101'        => ['value' => -101,        'expectedExceptionMessage' => 'Value -101 is not valid.'],
            '101'         => ['value' => 101,         'expectedExceptionMessage' => 'Value 101 is not valid.'],
            'PHP_INT_MAX' => ['value' => PHP_INT_MAX, 'expectedExceptionMessage' => 'Value 9223372036854775807 is not valid.'],
        ];
    }

    /**
     * @throws MAIntegerException
     */
    public function test__toString()
    {
        $maInteger = new MAIntegerTest_MAInteger_Sample(value: 99);

        $this->assertSame(
            expected: 'MawebDK\SimpleDatatypes\Test\MAIntegerTest_MAInteger_Sample{"value": 99}',
            actual: $maInteger->__toString()
        );
    }
}

class MAIntegerTest_MAInteger_Sample extends MAInteger
{
    public static function isValidValue(int $value): bool
    {
        return (($value >= -100) && ($value <= 100));
    }
}