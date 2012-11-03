<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * Description of Pointcut
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class Pointcut implements IPointcut{
    protected $designators = array();

    /**
     * add a new designator to the pointcut
     * @param IPointcutDesignator $designator
     */
    public function addDesignator(IPointcutDesignator $designator){
        $this->designators[] = $designator;
    }


    /**
     * matches a class against all non-runtime designators
     * runtime designators will not be matched!
     * returns false if pointcut does not contain any designators
     * returns only true if all designators match
     *
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname){
        if(\count($this->designators) == 0){
            return false;
        }
        foreach($this->designators as $designator){
            if(!$designator->isRuntimeDesignator() && !$designator->matchClassname($classname)){
                return false;
            }
        }
        return true;
    }

    /**
     * matches all designators against a joinpoint
     * returns false if it does not contain any designators
     * returns only true, when all designators match!
     * @param IJoinPoint $joinpoint
     * @return bool
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        if(\count($this->designators) == 0){
            return false;
        }
        foreach($this->designators as $designator){
            if(!$designator->matchJoinPoint($joinpoint)){
                return false;
            }
        }
        return true;
    }
}
?>
