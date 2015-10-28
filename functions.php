<?php
/**
 * Spotfin Starter Theme functions and definitions.
 *
 * @package Spotfin_Starter_Theme
 */

foreach ( glob( dirname( __FILE__ ) . '/inc/*.php' ) as $file )
{
	include $file;
}