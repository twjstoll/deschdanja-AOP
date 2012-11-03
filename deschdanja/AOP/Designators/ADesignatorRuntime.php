<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP\Designators;
use deschdanja\AOP\IJoinPoint;
use deschdanja\AOP\APointcutDesignator;
use deschdanja\AOP\Exceptions\OperationUnsupported;

/**
 * Abstract Class for a Runtime designator
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
abstract class ADesignatorRuntime extends APointcutDesignator{

    public function  __construct($expression) {
        $this->setPointcutExpression($expression);
    }

    /**
     * Runtime Designator will throw an exception upon calling this method
     *
     * @throws Operation Unsupported
     * @param string $classname fully qualified classname
     */
    final public function matchClassname($classname){
        throw new OperationUnsupported("Runtime Designators cannot match Classname");
    }

    /**
     * matches aop-class (target) against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        throw new OperationUnsupported("Method is not implemented");
    }

    /**
     * function returns, whether designator works only at runtime
     * e.g. when designator uses argument value
     * @return bool
     */
    final public function isRuntimeDesignator(){
        return true;
    }

}
?>
