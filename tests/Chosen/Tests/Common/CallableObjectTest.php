<?php
namespace Chosen\Tests\Common;

use PHPUnit_Framework_TestCase;
use Chosen\Common\CallableObject;

require 'testFunction.php';

/**
 * Class CallableObjectTest
 *
 * @package Chosen\Tests\Common
 * @author  Whizark
 *
 * @group common
 */
class CallableObjectTest extends PHPUnit_Framework_TestCase
{
    public function testGetMustReturnTheRawCallableOfTheFunction()
    {
        $callable = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithParameters');

        $this->assertSame($callable->get(), 'Chosen\\Tests\\Common\\testFunctionWithParameters');
    }

    public function testGetMustReturnTheRawCallableOfTheClosure()
    {
        $closure  = function () {
        };
        $callable = new CallableObject($closure);

        $this->assertSame($callable->get(), $closure);
    }

    public function testGetMustReturnTheRawCallableOfInstanceMethod()
    {
        $testClass = new TestClass();
        $callable  = new CallableObject([$testClass, 'instanceMethodWithParameters']);

        $this->assertSame($callable->get(), [$testClass, 'instanceMethodWithParameters']);
    }

    public function testGetMustReturnTheRawCallableOfClassMethodThatIsRepresentedAsAnArray()
    {
        $callable = new CallableObject(['Chosen\\Tests\\Common\\TestClass', 'classMethodWithParameters']);

        $this->assertSame($callable->get(), ['Chosen\\Tests\\Common\\TestClass', 'classMethodWithParameters']);
    }

    public function testGetMustReturnTheRawCallableOfClassMethodThatIsRepresentedAsAString()
    {
        $callable = new CallableObject('Chosen\\Tests\\Common\\TestClass::classMethodWithParameters');

        $this->assertSame($callable->get(), ['Chosen\\Tests\\Common\\TestClass', 'classMethodWithParameters']);
    }

    public function testIsFunctionMustReturnTrueForFunction()
    {
        $callable = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithParameters');

        $this->assertTrue($callable->isFunction());
        $this->assertFalse($callable->isClosure());
        $this->assertFalse($callable->isInstanceMethod());
        $this->assertFalse($callable->isClassMethod());
    }

    public function testIsClosureMustReturnTrueForClosure()
    {
        $callable = new CallableObject(
            function ($parameter1, $parameter2) {
            }
        );

        $this->assertFalse($callable->isFunction());
        $this->assertTrue($callable->isClosure());
        $this->assertFalse($callable->isInstanceMethod());
        $this->assertFalse($callable->isClassMethod());
    }

    public function testIsInstanceMethodMustReturnTrueForInstanceMethod()
    {
        $testClass = new TestClass();
        $callable  = new CallableObject([$testClass, 'instanceMethodWithParameters']);

        $this->assertFalse($callable->isFunction());
        $this->assertFalse($callable->isClosure());
        $this->assertTrue($callable->isInstanceMethod());
        $this->assertFalse($callable->isClassMethod());
    }

    public function testIsClassMethodMustReturnTrueForClassMethodThatIsRepresentedAsAnArray()
    {
        $callable = new CallableObject(['Chosen\\Tests\\Common\\TestClass', 'classMethodWithParameters']);

        $this->assertFalse($callable->isFunction());
        $this->assertFalse($callable->isClosure());
        $this->assertFalse($callable->isInstanceMethod());
        $this->assertTrue($callable->isClassMethod());
    }

    public function testIsClassMethodMustReturnTrueForClassMethodThatIsRepresentedAsAString()
    {
        $callable = new CallableObject('Chosen\\Tests\\Common\\TestClass::classMethodWithParameters');

        $this->assertFalse($callable->isFunction());
        $this->assertFalse($callable->isClosure());
        $this->assertFalse($callable->isInstanceMethod());
        $this->assertTrue($callable->isClassMethod());
    }

    public function testFunctionMustBeCallable()
    {
        $callableWithParameters    = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithParameters');
        $callableWithoutParameters = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithoutParameters');

        $this->assertSame($callableWithParameters(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters(), null);
    }

    public function testClosureMustBeCallable()
    {
        $callableWithParameters    = new CallableObject(
            function ($parameter1, $parameter2) {
                return [$parameter1, $parameter2];
            }
        );
        $callableWithoutParameters = new CallableObject(
            function () {
            }
        );

        $this->assertSame($callableWithParameters(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters(), null);
    }

    public function testInstanceMethodMustBeCallable()
    {
        $testClass                 = new TestClass();
        $callableWithParameters    = new CallableObject([$testClass, 'instanceMethodWithParameters']);
        $callableWithoutParameters = new CallableObject([$testClass, 'instanceMethodWithoutParameters']);

        $this->assertSame($callableWithParameters(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters(), null);
    }

    public function testClassMethodThatIsRepresentedAsAnArrayMustBeCallable()
    {
        $callableWithParameters    = new CallableObject(
            [
                'Chosen\\Tests\\Common\\TestClass',
                'classMethodWithParameters'
            ]
        );
        $callableWithoutParameters = new CallableObject(
            [
                'Chosen\\Tests\\Common\\TestClass',
                'classMethodWithoutParameters'
            ]
        );

        $this->assertSame($callableWithParameters(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters(), null);
    }

    public function testClassMethodThatIsRepresentedAsAStringMustBeCallable()
    {
        $callableWithParameters    = new CallableObject(
            'Chosen\\Tests\\Common\\TestClass::classMethodWithParameters'
        );
        $callableWithoutParameters = new CallableObject(
            'Chosen\\Tests\\Common\\TestClass::classMethodWithoutParameters'
        );

        $this->assertSame($callableWithParameters(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters(), null);
    }

    public function testFunctionMustBeCallableWithInvoke()
    {
        $callableWithParameters    = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithParameters');
        $callableWithoutParameters = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithoutParameters');

        $this->assertSame($callableWithParameters->invoke(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters->invoke(), null);
    }

    public function testClosureMustBeCallableWithInvoke()
    {
        $callableWithParameters    = new CallableObject(
            function ($parameter1, $parameter2) {
                return [$parameter1, $parameter2];
            }
        );
        $callableWithoutParameters = new CallableObject(
            function () {
            }
        );

        $this->assertSame($callableWithParameters->invoke(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters->invoke(), null);
    }

    public function testInstanceMethodMustBeCallableWithInvoke()
    {
        $testClass                 = new TestClass();
        $callableWithParameters    = new CallableObject([$testClass, 'instanceMethodWithParameters']);
        $callableWithoutParameters = new CallableObject([$testClass, 'instanceMethodWithoutParameters']);

        $this->assertSame($callableWithParameters->invoke(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters->invoke(), null);
    }

    public function testClassMethodThatIsRepresentedAsAnArrayMustBeCallableWithInvoke()
    {
        $callableWithParameters    = new CallableObject(
            [
                'Chosen\\Tests\\Common\\TestClass',
                'classMethodWithParameters'
            ]
        );
        $callableWithoutParameters = new CallableObject(
            [
                'Chosen\\Tests\\Common\\TestClass',
                'classMethodWithoutParameters'
            ]
        );

        $this->assertSame($callableWithParameters->invoke(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters->invoke(), null);
    }

    public function testClassMethodThatIsRepresentedAsAStringMustBeCallableWithInvoke()
    {
        $callableWithParameters    = new CallableObject(
            'Chosen\\Tests\\Common\\TestClass::classMethodWithParameters'
        );
        $callableWithoutParameters = new CallableObject(
            'Chosen\\Tests\\Common\\TestClass::classMethodWithoutParameters'
        );

        $this->assertSame($callableWithParameters->invoke(1, 2), [1, 2]);
        $this->assertSame($callableWithoutParameters->invoke(), null);
    }

    public function testFunctionMustBeCallableWithInvokeArgs()
    {
        $callableWithParameters    = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithParameters');
        $callableWithoutParameters = new CallableObject('Chosen\\Tests\\Common\\testFunctionWithoutParameters');

        $this->assertSame($callableWithParameters->invokeArgs([1, 2]), [1, 2]);
        $this->assertSame($callableWithoutParameters->invokeArgs(), null);
    }

    public function testClosureMustBeCallableWithInvokeArgs()
    {
        $callableWithParameters    = new CallableObject(
            function ($parameter1, $parameter2) {
                return [$parameter1, $parameter2];
            }
        );
        $callableWithoutParameters = new CallableObject(
            function () {
            }
        );

        $this->assertSame($callableWithParameters->invokeArgs([1, 2]), [1, 2]);
        $this->assertSame($callableWithoutParameters->invokeArgs(), null);
    }

    public function testInstanceMethodMustBeCallableWithInvokeArgs()
    {
        $testClass                 = new TestClass();
        $callableWithParameters    = new CallableObject([$testClass, 'instanceMethodWithParameters']);
        $callableWithoutParameters = new CallableObject([$testClass, 'instanceMethodWithoutParameters']);

        $this->assertSame($callableWithParameters->invokeArgs([1, 2]), [1, 2]);
        $this->assertSame($callableWithoutParameters->invokeArgs(), null);
    }

    public function testClassMethodThatIsRepresentedAsAnArrayMustBeCallableWithInvokeArgs()
    {
        $callableWithParameters    = new CallableObject(
            [
                'Chosen\\Tests\\Common\\TestClass',
                'classMethodWithParameters'
            ]
        );
        $callableWithoutParameters = new CallableObject(
            [
                'Chosen\\Tests\\Common\\TestClass',
                'classMethodWithoutParameters'
            ]
        );

        $this->assertSame($callableWithParameters->invokeArgs([1, 2]), [1, 2]);
        $this->assertSame($callableWithoutParameters->invokeArgs(), null);
    }

    public function testClassMethodThatIsRepresentedAsAStringMustBeCallableWithInvokeArgs()
    {
        $callableWithParameters    = new CallableObject(
            'Chosen\\Tests\\Common\\TestClass::classMethodWithParameters'
        );
        $callableWithoutParameters = new CallableObject(
            'Chosen\\Tests\\Common\\TestClass::classMethodWithoutParameters'
        );

        $this->assertSame($callableWithParameters->invokeArgs([1, 2]), [1, 2]);
        $this->assertSame($callableWithoutParameters->invokeArgs(), null);
    }
}
