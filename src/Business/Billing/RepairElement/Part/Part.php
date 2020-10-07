<?php

namespace SofiB\Business\Billing\RepairElement\Part;

interface Part
{
    function getGroup () :  string;
    function getName () :  string;
    function getUnitOfMeasure () :  string;
    function getUnitPrice () :  float;
    function getQuantity () : float;
}
