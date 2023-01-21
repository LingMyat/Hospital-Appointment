<?php

function getStatusBadge($value){
    return $value==true? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Inactive</label>";
}
