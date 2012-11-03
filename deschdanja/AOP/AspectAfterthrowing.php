<?php

/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;

/**
 * An AfterthrowingAspect will be run directly after the target
 * but only if an exception has been set in the joinpoint (by prior
 * aspects or the target itself)
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class AspectAfterthrowing extends AspectNonAround{
    
    /**
     * Type of Aspect
     * @var string
     */
    protected $type = "afterthrowing";
    
    /**
     * @inherit
     * 
     * returns false if jointpoint has no exception set
     * 
     * @param \deschdanja\AOP\IJoinPoint $joinpoint
     * @return boolean
     */
    public function matchJoinPoint(IJoinPoint $joinpoint) {
        if(!$joinpoint->hasException()){
            return false;
        }
        return parent::matchJoinPoint($joinpoint);
    }
    
    /**
     * type can only be "afterthrowing"
     * will throw exception if other string given
     * 
     * @param string $type
     * @throws InvalidArgument
     */
    public function setType($type) {
        if($type != "afterthrowing"){
            throw new InvalidArgument("Only type 'afterthrowing' allowed in afterthrowing aspect");
        }
        parent::setType($type);
    }
}

?>
