<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * Interface the behaviour of an Aspect
 * it provides a method to run added behaviour by an advice
 * 
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IAspectBase {
    /**
     * function may check matching with joinpoint
     * can execute behaviour (like in advice or aop target)
     * @param IJoinPoint $joinpoint
     * @param IAdviceChain $adviceChain
     */
    public function runAspect(IJoinPoint $joinpoint, IAspectChain $aspectChain);
}
?>
