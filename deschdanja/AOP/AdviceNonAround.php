<?php
namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;

/**
 * AdviceNonAround can be either of type before or type after
 * it is able to do all kinds of stuff,
 * but is not able to prevent further proceding
 *
 * @author Theodor
 */
class AdviceNonAround extends AAdvice{
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
    public function runAspect(IJoinPoint $joinpoint, IAdviceChain$aspectChain){
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
