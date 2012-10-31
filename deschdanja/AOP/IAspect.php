<?php
namespace deschdanja\AOP;

/**
 * Interface for full aspect.
 * Combines IAspectBase (running an aspcet)
 * with IAdvice (adding pointcuts and defining type)
 * @author Theodor
 */
interface IAspect extends IAspectBase, IAdvice{
    //put your code here
}
?>
