<?php

namespace deschdanja\AOP;

use deschdanja\AOP\Exceptions\InvalidArgument;

/**
 * Description of AOPProxy
 *
 * @author Theodor
 */
class AOPProxy implements IAOPProxy {

    protected $ClassnameJoinPoint = '\\deschdanja\\AOP\\JoinPoint';
    /**
     *
     * @var deschdanja\TS\AOP\IAdviceChain
     */
    protected $AdviceChain = '\\deschdanja\\AOP\\AdviceChain';
    /**
     *
     * @var object
     */
    protected $target;
    /**
     *
     * @var isConstructed indicates, whether class was constructed
     */
    protected $AOPProxyIsConstructed = false;

    public function __construct() {
        if (!$this->AOPProxyIsConstructed) {
            $this->AdviceChain = new $this->AdviceChain;
            $this->AOPProxyIsConstructed = true;
        }else{
            $this->__call("__construct", \func_get_args());
        }
    }

    public function __call($name, $arguments) {
        if ($this->AdviceChain->getNumberOfAspects() == 0) {
            return \call_user_func_array(array($this->target, $name), $arguments);
        }

        $joinpoint = new $this->ClassnameJoinPoint($this->target, $name, $arguments);
        $this->AdviceChain->executeChain($joinpoint);
        return $joinpoint->returnReturnValue();
    }

    public static function __callStatic($name, $arguments){
        return $this->__call("__callStatic", array($name, $arguments));
    }

    public function __get($name){
        return $this->__call("__get", array($name));
    }

    public function __isset($name){
        return $this->__call("_isset", array($name));
    }

    public function __set($name, $value){
        return $this->__call("__set", array($name, $value));
    }

    public function __unset($name){
        return $this->__call("__unset", array($name));
    }

    /**
     * add an aspect to the AdviceChain of this proxy
     * @param IAspect $aspect
     */
    public function addAOPAspectToAOPProxy(IAspect $aspect) {
        $this->AdviceChain->addAspect($aspect);
    }

    /**
     * set the target of this proxy
     * @param object $target
     */
    public function setTargetOfAOPProxy($target){
        if(!\is_object($target)){
            throw new InvalidArgument("target has to be an object");
        }
        $this->target = $target;
    }

    /**
     * method allow setting a new AdviceChain, possibly already containing aspects
     * the adviceChain set prior, maybe containing aspects, will be replaced!
     * @param IAdviceChain $AdviceChain
     */
    public function setAdviceChainOfAOPProxy(IAdviceChain $AdviceChain){
        $this->AdviceChain = $AdviceChain;
    }


    public function setJoinPointClassnameOfAOPProxy($joinpoint){
        if(\is_string($joinpoint)){
            $reflector = new \ReflectionClass($joinpoint);
            if($reflector->implementsInterface('\\deschdanja\\AOP\\IJoinPoint')){
                $this->ClassnameJoinPoint = $joinpoint;
                return;
            }
            throw new InvalidArgument("Joinpoint has to implement IJoinPoint interface");
        }
        if(\is_object($joinpoint)){
            if($joinpoint instanceof IJoinPoint){
                $this->ClassnameJoinPoint = \get_class($joinpoint);
                return;
            }
            throw new InvalidArgument("Joinpoint has to implement IJoinPoint interface");
        }
        throw new InvalidArgument("Argument has to be string or object");
    }

}

?>
