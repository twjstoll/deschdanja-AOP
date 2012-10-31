<?php
namespace deschdanja\TS\AOP\Designators;
use \deschdanja\TS\AOP\IJoinPoint;
use deschdanja\TS\AOP\Exceptions\OperationUnsupported;

/**
 * Description of ADesignatorNonRuntime
 *
 * @author Theodor
 */
abstract class ADesignatorNonRuntime implements \deschdanja\TS\AOP\IPointcutDesignator{
    protected $expression = "";

    public function __construct($expression){
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
    public function matchClassname($classname){
        throw new OperationUnsupported("Method is not implemented");
    }

    /**
     * matches aop-class against joinpoint
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
        return false;
    }

    /**
     * sets pointcutExpression
     * expression is used as regex to match joinpoint
     * @param string $expression
     */
    public function setPointcutExpression($expression){
        $this->expression = \strval($expression);
    }

    public function getPointcutExpression(){
        return $this->expression;
    }
}
?>
