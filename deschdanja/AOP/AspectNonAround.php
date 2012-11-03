<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;

/**
 * AspectNonAround can be of type before, afterthrowing or after
 * it is able to do all kinds of stuff,
 * but is not able to prevent further proceeding af the advicechain
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class AspectNonAround extends AAspect{
    /**
     * additional behaviour, executed when a pointcut matches
     * @param IJoinPoint $joinpoint
     */
    protected function advice(IJoinPoint $joinpoint){

    }

    /**
     * function checks whether advice has any matching pointcuts
     * if so, runs function advice
     * proceeds execution of chain
     *
     * @param IJoinPoint $joinpoint
     * @param IAdviceChain $aspectChain
     */
    final public function runAspect(IJoinPoint $joinpoint, IAspectChain $aspectChain){
        if($this->matchJoinPoint($joinpoint)){
            $this->advice($joinpoint);
        }
        $aspectChain->proceed();
    }
    
    public function setType($type){
        if($type == "around"){
            throw new InvalidArgument("type 'around' is not allowed in NonAroundAdvice");
        }
        parent::setType($type);
    }
}
?>
