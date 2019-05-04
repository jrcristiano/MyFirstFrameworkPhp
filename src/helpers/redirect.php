<?php

function redirect($toRoute)
{
    return header("location: {$toRoute}" );
}

