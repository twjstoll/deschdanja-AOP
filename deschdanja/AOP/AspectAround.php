<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;
/**
 * An AdviceAround will be called prior to
 * AdviceNonAround (before and after)
 * and is able to prevent any further advices and the target to be called!
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class AspectAround extends AAspect{
    protected $type = "around";

    /**
     * implemented advice
     * advice will decide, whether to proceed with adviceChain
     *
     * @param IJoinPoint $joinpoint
     * @param IAdviceChain $adviceChain
     * @return bool
     */
    protected function advice(IJoinPoint $joinpoint, IAspectChain $aspectChain){
        $aspectChain->proceed();
    }

    
    final public function runAspect(IJoinPoint $joinpoint, IAspectChain $aspectChain){
        if($this->matchJoinPoint($joinpoint)){
            $this->advice($joinpoint, $aspectChain);
        }else{
            $aspectChain->proceed();
        }
    }

    public function setType($type){
        if($type != "around"){
            throw new InvalidArgument("only type 'around' allowed in around advice");
        }
        parent::setType($type);
    }
}
?>
