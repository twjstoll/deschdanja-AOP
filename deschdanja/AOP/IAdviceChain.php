<?php
namespace deschdanja\AOP;

/**
 *
 * @author Theodor
 */
interface IAdviceChain {
    /**
     * add aspect to chain
     * @param IAspect $aspect
     */
    public function addAspect(IAspect $aspect);

    /**
     * start execuction of chain
     * @param IJoinPoint $joinpoint
     */
    public function executeChain(IJoinPoint $joinpoint);

    /**
     * returns number added Aspects
     */
    public function getNumberOfAspects();

    /**
     * proceeds to next item in chain and runs aspect
     */
    public function proceed();

    /**
     * removes all added aspects
     */
    public function reset();
}
?>
