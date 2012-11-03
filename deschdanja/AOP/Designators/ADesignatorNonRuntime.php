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
 * Abstract NonRuntime Designator
 * Used for all designators able to match without any runtime variables
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
abstract class ADesignatorNonRuntime extends APointcutDesignator{

    public function __construct($expression){
        $this->setPointcutExpression($expression);
    }

    /**
     * returns wheter aop-object matches classname
     *
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname){
        throw new OperationUnsupported("Method is not implemented");
    }

    /**
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        return $this->matchClassname($joinpoint->getClassName());
    }

    /**
     * function returns, whether designator works only at runtime
     * e.g. when designator uses argument value
     * @return bool
     */
    final public function isRuntimeDesignator(){
        return false;
    }

    public function getPointcutExpression(){
        return $this->expression;
    }
}
?>
