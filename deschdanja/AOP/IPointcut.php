<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * Inteface for a Pointcut
 * A Pointcut is a set of IPointcutDesignators
 * This set can be matched against a class or a IJoinPoint
 * 
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IPointcut extends IAOPMatch{
    /**
     * add a new designator to the pointcut
     * @param IPointcutDesignator $designator
     */
    public function addDesignator(IPointcutDesignator $designator);

    
}
?>
