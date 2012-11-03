<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * an Advice represents added behaviour
 * 
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IAdvice extends IAOPMatch{
    /**
     * add pointcut to advice
     * @param IPointcut $pointcut
     */
    public function addPointcut(IPointcut $pointcut);

    /**
     * returns type of advice
     * @return string
     */
    public function getType();

    /**
     * set type of advice (used by adviceChain)
     * e.g. "around", "before", "afterthrowing", "after"
     * @param string $type
     */
    public function setType($type);

}
?>
