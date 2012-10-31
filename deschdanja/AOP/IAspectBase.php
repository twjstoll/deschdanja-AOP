<?php
namespace deschdanja\AOP;

/**
 * Interface for an Aspect
 * @author Theodor Stoll
 */
interface IAspectBase {
    /**
     * function may check matching with joinpoint
     * can execute behaviour (like in advice or aop target)
     * @param IJoinPoint $joinpoint
     * @param IAdviceChain $adviceChain
     */
    public function runAspect(IJoinPoint $joinpoint, IAdviceChain $adviceChain);
}
?>
