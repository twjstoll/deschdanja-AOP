<?php

namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;
use deschdanja\AOP\Exceptions\OperationNotAllowed;
use deschdanja\AOP\Exceptions\OperationUnsupported;
/**
 * Description of JoinPoint
 *
 * @author Theodor
 */
class JoinPoint implements IJoinPoint{

    protected $target;
    protected $method;
    protected $arguments = array();
    protected $exception = NULL;
    protected $returnValue;
    protected $interfaces = NULL;

    /**
     *
     * @param object $target instance of target
     * @param string $method name of method to execute
     * @param array $arguments array of arguments for method
     */
    public function __construct($target, $method, array $arguments) {
        if (!\is_object($target)) {
            throw new InvalidArgument("target has to be object!");
        }
        $this->target = $target;
        $this->method = strval($method);

        $reflection = new \ReflectionClass($target);
        $rfParameters = $reflection->getMethod($this->method)->getParameters();
        $i = 0;
        $namedArguments = array();
        foreach ($arguments as $argument) {
            $namedArguments[$rfParameters[$i]->getName()] = $argument;
            $i++;
        }
        if (\count($arguments) < \count($rfParameters)) {
            for($i = \count($arguments); $i < \count($rfParameters); $i++){
                $namedArguments[$rfParameters[$i]->getName()] = $rfParameters[$i]->getDefaultValue();
            }
        }
        $this->arguments = $namedArguments;
    }

    /**
     * will throw exception, if joinpoint already has exception!
     *  
     * function executes method of the target
     * saves return value, be it normal return value or exception
     *
     */
    public function executeTarget() {
        if ($this->hasException()) {
            throw new OperationNotAllowed("Join Point already has exception, execution of target method not possible");
        }
        try {
            $targetmethod = array($this->getTargetInstance(), $this->getMethodName());
            $return = \call_user_func_array($targetmethod, $this->getMethodArguments());
            $this->setReturnValue($return);
        } catch (Exception $e) {
            $this->setException($e);
        }
    }

    /**
     * returns fully qualified classname of target
     */
    public function getClassName() {
        return \get_class($this->target);
    }

    /**
     * returns set exception
     * will throw exception if none is set
     */
    public function getException() {
        if (\is_null($this->exception)) {
            throw new OperationUnsupported("No Exception set, cannot return exception!");
        }
        return $this->exception;
    }

    /**
     * returns array with interfaces of target
     * @return array
     */
    public function getInterfaces() {
        if (!\is_null($this->interfaces)) {
            return $this->interfaces;
        }
        $reflection = new \ReflectionClass($this->target);
        $interfaces = $reflection->getInterfaceNames();
        $this->interfaces = $interfaces;
        return $this->interfaces;
    }

    /**
     * returns argument with given name
     * will throw exception if none given
     * @param string $name
     * @return mixed
     */
    public function getMethodArgument($name) {
        $arguments = $this->getMethodArguments();
        if(!\array_key_exists($name, $arguments)){
            throw new InvalidArgument("No Argument with name '$name' exists");
        }
        return $arguments[$name];
    }

    /**
     * returns array with all arguments
     * @return array
     */
    public function getMethodArguments() {
        return $this->arguments;
    }

    /**
     * returns name of the target method
     * @return string
     */
    public function getMethodName() {
        return $this->method;
    }

    /**
     * returns the return Value, even if exception is set
     */
    public function getReturnValue(){
        return $this->returnValue;
    }

    /**
     * will return a reference to the target instance
     * @return object
     */
    public function getTargetInstance() {
        return $this->target;
    }

    /**
     * returns, whether there is an exception set
     * @return bool
     */
    public function hasException() {
        if($this->exception instanceof \Exception){
            return true;
        }

        return false;
    }

    /**
     * returns whether argument with given name exists
     * @param string $name
     * @return bool
     */
    public function isMethodArgument($name) {
        if(\array_key_exists($name, $this->arguments)){
            return true;
        }
        return false;
    }

    /**
     * returns the result of the Joinpoint
     * can be normal return or, if set, throw of an exception
     */
    public function returnReturnValue() {
        if($this->hasException()){
            throw $this->exception;
        }
        return $this->returnValue;
    }

    /**
     * implementation of aspectBase interface
     * with this method, the joinpoint can be used in and advicechain
     * will reroute to executeTarget() method
     *
     * @param IJoinPoint $joinpoint
     * @param IAdviceChain $adviceChain
     */
    public function runAspect(IJoinPoint $joinpoint, IAdviceChain $adviceChain) {
        $this->executeTarget();
        $adviceChain->proceed();
    }

    /**
     * set value of a target method argument
     * will throw exception if argument with given name does not exist
     * @param string $name
     * @param mixed $value
     */
    public function setArgumentValue($name, $value) {
        if($this->isMethodArgument($name)){
            $this->arguments[$name] = $value;
        }else{
            throw new InvalidArgument("no argument with name '$name' exists. Cannot set value");
        }
    }

    /**
     * set an exception to be thrown
     * @param \Exception $exception
     */
    public function setException(\Exception $exception) {
        if(\is_null($this->exception)){
            $this->exception = $exception;
        }else{
            throw new OperationNotAllowed("there is already an exception set, cannot set another one");
        }
    }

    /**
     * set Value to be returned
     * @param mixed $value
     */
    public function setReturnValue($value) {
        $this->returnValue = $value;
    }

}

?>
