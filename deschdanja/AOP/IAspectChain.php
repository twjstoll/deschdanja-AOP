<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * Interface for an AspectChain
 * 
 * An AspectChain can contain several Aspects
 * When executing the chain these are run in a distinct order
 * 
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IAspectChain {
    /**
     * add aspect to chain
     * @param IAspect $aspect
     */
    public function addAspect(IAspect $aspect);

    /**
     * start execuction of chain
     * 
     * all added aspects will be run in this distinct order:
     * - around aspects
     * - before aspects
     * - afterthrowing aspects
     * - after aspects
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
