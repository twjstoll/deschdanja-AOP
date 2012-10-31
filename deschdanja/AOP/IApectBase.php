<?php
namespace deschdanja\AOP;

/**
 *
 * @author Theodor
 */
interface IApectBase {
    /**
     * function may check matching with joinpoint
     * can execute Behaviour (like in advice or aop target)
     * @param IJoinPoint $joinpoint
     * @param IAdviceChain $adviceChain
     */
    public function runAspect(IJoinPoint $joinpoint, IAdviceChain $adviceChain);
}
?>
