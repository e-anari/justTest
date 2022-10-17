<?php

function sidbarOption($url, $option = 'active')
{
    return request()->is($url) ? $option : '';
}
