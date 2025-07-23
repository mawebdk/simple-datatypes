<?php
namespace MawebDK\SimpleDatatypes\Test;

use MawebDK\SimpleDatatypes\MAString;
use MawebDK\SimpleDatatypes\MAStringException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MAStringTest extends TestCase
{
    /**
     * @throws MAStringException
     */
    #[DataProvider('dataProviderIsValidValue')]
    public function testIsValidValue(string $value, bool $expectedIsValid)
    {
        $this->assertSame(
            expected: $expectedIsValid,
            actual: MAStringTest_MAString_Sample::isValidValue(value: $value)
        );
    }

    public static function dataProviderIsValidValue(): array
    {
        return [
            ''     => ['value' => '',     'expectedIsValid' => false],
            'a'    => ['value' => 'a',    'expectedIsValid' => true],
            'A'    => ['value' => 'A',    'expectedIsValid' => true],
            'abc'  => ['value' => 'abc',  'expectedIsValid' => true],
            'ABC'  => ['value' => 'ABC',  'expectedIsValid' => true],
            'abcd' => ['value' => 'abcd', 'expectedIsValid' => false],
            'ABCD' => ['value' => 'ABCD', 'expectedIsValid' => false],
        ];
    }

    /**
     * @throws MAStringException
     */
    #[DataProvider('dataProvider__construct')]
    public function test__construct(string $value)
    {
        $maString = new MAStringTest_MAString_Sample(value: $value);

        $this->assertSame(expected: $value, actual: $maString->value);
    }

    public static function dataProvider__construct(): array
    {
        return [
            ['value' => 'a'],
            ['value' => 'A'],
            ['value' => 'abc'],
            ['value' => 'ABC'],
        ];
    }

    #[DataProvider('dataProvider__construct_MAStringException')]
    public function test__construct_MAStringException(string $value, string $expectedExceptionMessage)
    {
        $this->expectException(exception: MAStringException::class);
        $this->expectExceptionMessage(message: $expectedExceptionMessage);

        new MAStringTest_MAString_Sample(value: $value);
    }

    public static function dataProvider__construct_MAStringException(): array
    {
        return [
            '' => [
                'value'                    => '',
                'expectedExceptionMessage' => 'Value "" is not valid.'
            ],
            'abcd' => [
                'value'                    => 'abcd',
                'expectedExceptionMessage' => 'Value "abcd" is not valid.'
            ],
            'ABCD' => [
                'value'                    => 'ABCD',
                'expectedExceptionMessage' => 'Value "ABCD" is not valid.'
            ],
        ];
    }

    /**
     * @throws MAStringException
     */
    #[DataProvider('dataProviderCreateFromValue')]
    public function testCreateFromValue(?string $value)
    {
        $maString = MAStringTest_MAString_Sample::createFromValue(value: $value);

        $this->assertSame(expected: $value, actual: $maString?->value);
    }

    public static function dataProviderCreateFromValue(): array
    {
        return [
            'null' => ['value' => null],
            'a'    => ['value' => 'a'],
            'A'    => ['value' => 'A'],
            'abc'  => ['value' => 'abc'],
            'ABC'  => ['value' => 'ABC'],
        ];
    }

    #[DataProvider('dataProviderCreateFromValue_MAStringException')]
    public function testCreateFromValue_MAStringException(string $value, string $expectedExceptionMessage)
    {
        $this->expectException(exception: MAStringException::class);
        $this->expectExceptionMessage(message: $expectedExceptionMessage);

        MAStringTest_MAString_Sample::createFromValue(value: $value);
    }

    public static function dataProviderCreateFromValue_MAStringException(): array
    {
        return [
            '' => [
                'value'                    => '',
                'expectedExceptionMessage' => 'Value "" is not valid.'
            ],
            'abcd' => [
                'value'                    => 'abcd',
                'expectedExceptionMessage' => 'Value "abcd" is not valid.'
            ],
            'ABCD' => [
                'value'                    => 'ABCD',
                'expectedExceptionMessage' => 'Value "ABCD" is not valid.'
            ],
        ];
    }
}

class MAStringTest_MAString_Sample extends MAString
{
    public static function isValidValue(string $value): bool
    {
        return (strlen($value) >= 1) && (strlen($value) <= 3);
    }
}
