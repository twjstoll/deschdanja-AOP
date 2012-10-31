<?php
namespace deschdanja\AOP\Designators;
use deschdanja\AOP\IJoinPoint;
use deschdanja\AOP\APointcutDesignator;
use deschdanja\AOP\Exceptions\OperationUnsupported;

/**
 * Abstract Class for a Runtime designator
 *
 * @author Theodor
 */
abstract class ADesignatorRuntime extends APointcutDesignator{

    public function  __construct($expression) {
        $this->setPointcutExpression($expression);
    }

    /**
     * returns wheter aop-object matches classname
     * can throw exception, depending on implementation
     * e.g. runtime-designators should throw exception because they cannot match class only
     *
     * @param string $classname fully qualified classname
     * @return bool
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

    /**
     * sets pointcutExpression
     * expression is used as regex to match joinpoint
     * @param string $expression
     */
    public function setPointcutExpression($expression){
        $this->expression = \strval($expression);
    }
}
?>
