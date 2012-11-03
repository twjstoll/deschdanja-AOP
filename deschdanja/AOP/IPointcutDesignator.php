<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * Interface for a PointcutDesignator
 * PointcutDesignator represents one criteria that is part of a pointcut
 * e.g.:
 * target class has to be in my\personal\namespace
 * target class has to implement my\personal\interface
 * method name called has to start with 'get'
 * value of parameter has to be true
 *  
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IPointcutDesignator extends IAOPMatch{
    /**
     * function returns, whether designator works only at runtime
     * e.g. when designator uses argument value
     * @return bool
     */
    public function isRuntimeDesignator();

    /**
     * sets pointcutExpression
     * expression is used to match joinpoint or class
     * depending on the designator this may be:
     * a simple value
     * regex
     * ...
     * 
     * @param mixed $expression
     */
    public function setPointcutExpression($expression);
    

}
?>