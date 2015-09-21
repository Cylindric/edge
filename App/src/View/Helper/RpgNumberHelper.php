<?php
namespace App\View\Helper;

use Cake\View\Helper;

class RpgNumberHelper extends Helper
{
    public function toReadableSize($size)
    {
        switch (true) {
            case $size < 1000:
                return __dn('cake', '{0,number,integer}', '{0,number,integer}', $size, $size);
            case round($size / 1000) < 1000:
                return __d('cake', '{0,number,#,###.##}k', $size / 1000);
            case round($size / 1000 / 1000, 2) < 1000:
                return __d('cake', '{0,number,#,###.##}m', $size / 1000 / 1000);
            case round($size / 1000 / 1000 / 1000, 2) < 1000:
                return __d('cake', '{0,number,#,###.##}b', $size / 1000 / 1000 / 1000);
            default:
                return __d('cake', '{0,number,#,###.##}t', $size / 1000 / 1000 / 1000 / 1000);
        }
    }
}
