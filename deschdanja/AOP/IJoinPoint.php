<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * interface for a joinpoint
 * provides access to target, to be called method, its arguments and return value
 * it extends IAspectBase and can therefore be used in an IAspectChain
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IJoinPoint extends IAspectBase{
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
     * @return string
     */
    public function getClassName();

    /**
     * returns set exception
     * will throw exception if none is set
     * @return \Exception
     */
    public function getException();

    /**
     * returns array with interfaces of target
     * @return array
     */
    public function getInterfaces();

    /**
     * returns argument value with given name
     * will throw exception if method does not exist
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
     * @return mixed
     */
    public function getReturnValue();

    /**
     * will return the target instance
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
     * @return mixed
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
