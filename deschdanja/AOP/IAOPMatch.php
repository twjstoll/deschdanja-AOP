<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * interface defines methods to match aop-object against a class by
 * classname or a joinpoint
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IAOPMatch {
    /**
     * returns whether aop-object matches a class defined by classname
     * can throw exception, depending on implementation
     * e.g. runtime-designators should throw exception because they cannot match class only
     *
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname);

    /**
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint);
}
?>
