<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP;

/**
 * Interface for full aspect.
 * Combines IAspectBase (running an aspcet)
 * with IAdvice (adding pointcuts and defining type)
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
interface IAspect extends IAspectBase, IAdvice{
    //put your code here
}
?>
