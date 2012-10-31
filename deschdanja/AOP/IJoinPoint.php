<?php
namespace deschdanja\AOP;

/**
 * contract for a joinpoint
 * provides access to target, to be called method and its arguments
 * it extends IAspectBase and can therefore be used in a IAspectChain
 *
 * @author Theodor
 */
interface IJoinPoint extends IApectBase{
    /**
     * will throw exception, if joinpoint already has exception!
     *
     * function executes method of the target
     * saves return value, be it normal return value or exception
     *
     */
    public function executeTarget();

    /**
     * returns fully qualified classname of target
     */
    public function getClassName();

    /**
     * returns set exception
     * will throw exception if none is set
     */
    public function getException();

    /**
     * returns array with interfaces of target
     * @return array
     */
    public function getInterfaces();

    /**
     * returns argument with given name
     * will throw exception if none given
     * @param string $name
     * @return mixed
     */
    public function getMethodArgument($name);

    /**
     * returns array with all arguments
     * @return array
     */
    public function getMethodArguments();

    /**
     * returns name of the target method
     * @return string
     */
    public function getMethodName();

    /**
     * returns the return Value
     */
    public function getReturnValue();

    /**
     * will return a reference to the target instance
     * @return object
     */
    public function getTargetInstance();

    /**
     * returns, whether there is an exception set
     * @return bool
     */
    public function hasException();

    /**
     * returns whether argument with given name exists
     * @param string $name
     * @return bool
     */
    public function isMethodArgument($name);

    /**
     * returns the result of the Joinpoint
     * can be normal return or, if set, throw of an exception
     */
    public function returnReturnValue();

    /**
     * set value of a target method argument
     * will throw exception if argument with given name does not exist
     * @param string $name
     * @param mixed $value
     */
    public function setArgumentValue($name, $value);

    /**
     * set an exception to be thrown
     * @param \Exception $exception
     */
    public function setException(\Exception $exception);

    /**
     * set Value to be returned
     * @param mixed $value
     */
    public function setReturnValue($value);
}
?>
