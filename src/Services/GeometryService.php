<?php

namespace App\Services;

use App\Entity\ShapeAbstract;

class GeometryService
{
    public static function calculateArea(ShapeAbstract $objectA, ShapeAbstract $objectB) : float
    {
        if (empty($objectA->getSurface())) {
            $surfaceA = 0;
        } else {
            $surfaceA = $objectA->getSurface();
        }
        
        if (empty($objectB->getSurface())) {
            $surfaceB = 0;
        } else {
            $surfaceB = $objectB->getSurface();
        }

        return $surfaceA + $surfaceB;
    }

    public static function calculateDiameter(ShapeAbstract $objectA, ShapeAbstract $objectB) : float
    {
        if (empty($objectA->getCircumference())) {
            $circumferenceA = 0;
        } else {
            $circumferenceA = $objectA->getCircumference();
        }
        
        if (empty($objectB->getCircumference())) {
            $circumferenceB = 0;
        } else {
            $circumferenceB = $objectB->getCircumference();
        }

        return $circumferenceA + $circumferenceB;
    }
}