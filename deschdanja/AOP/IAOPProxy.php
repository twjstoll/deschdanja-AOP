<?php
namespace deschdanja\AOP;

/**
 *
 * @author Theodor
 */
interface IAOPProxy {
    /*
     * constructor must be able to differenciate between the first own __construct call
     * and a construct call to the target!!
     */
    
    /**
     * add an aspect to the AdviceChain
     * @param IAspect $aspect
     */
    public function addAOPAspectToAOPProxy(IAspect $aspect);

    /**
     * set the target of this proxy
     * @param object $target
     */
    public function setTargetOfAOPProxy($target);

    /**
     * method allow setting a new AdviceChain, possibly already containing aspects
     * the adviceChain set prior, maybe containing aspects, will be replaced!
     * @param IAdviceChain $AdviceChain
     */
    public function setAdviceChainOfAOPProxy(IAdviceChain $AdviceChain);
}
?>
