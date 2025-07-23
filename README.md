# simple-datatypes
Simple datatypes with value restrictions.

Use these classes instead of PHP's own internal datatypes to ensure values in parameters are within defined limitations.

## Usage of MAInteger
Create a class extending MAInteger and implement method isValidValue() returning whether the given integer value is valid or not.
Throw an MAIntegerException if unable to decide if the given integer value is valid or not.

Example of an integer class with integers in the range 1-65535 as the defined limitations.
```
class MyIntegerClass extends MAInteger
{
    public static function isValidValue(int $value): bool
    {
        return (($value >= 1) && ($value <= 65535));
    }
}
```

Check if a given integer value is valid for the created class.
```
if (MyIntegerClass::isValidValue(value: $value)):
    // $value is a valid value for MyIntegerClass.
else:
    // $value is not a valid value for MyIntegerClass.
endif; 
```

Constructors and usage.
```
try {
    $myInteger1 = new MyIntegerClass(value: 123);
    $myInteger2 = MyIntegerClass::createFromValue(value: 456);
    $myInteger3 = MyIntegerClass::createFromValue(value: null);
} catch (MAIntegerException $e) {
    // Error handling.
}

echo $maInteger1->value;   // 123
echo $maInteger2->value;   // 456.
echo $maInteger3;          // null
```

MAInteger implements Stringable, so any object extending MAInteger can be used as a string parameter.

## Usage of MAString
Create a class extending MAString and implement method isValidValue() returning whether the given string value is valid or not.
Throw an MAStringException if unable to decide if the given string value is valid or not.

Example of a string class for strings with a length between 1 and 100.
```
class MyStringClass extends MAString
{
    public static function isValidValue(string $value): bool
    {
        return (strlen($value) >= 1) && (strlen($value) <= 100);
    }
}
```

Check if a given string value is valid for the created class.
```
if (MyStringClass::isValidValue(value: $value)):
    // $value is a valid value for MyStringClass.
else:
    // $value is not a valid value for MyStringClass.
endif; 
```

Constructors and usage.
```
try {
    $myString1 = new MyStringClass(value: 'Hello');
    $myString2 = MyStringClass::createFromValue(value: 'World);
    $myString3 = MyStringClass::createFromValue(value: null);
} catch (MAStringException $e) {
    // Error handling.
}

echo $maString1->value;   // 'Hello'
echo $maString2->value;   // 'World'
echo $maString3           // null
```

MAString implements Stringable, so any object extending MAString can be used as a string parameter.