<?php

namespace NFePHP\NFSe\Models\Base;

/**
 * Classe base para a renderização dos RPS em XML
 *
 * @category  NFePHP
 * @package   NFePHP\NFSe\Base\RenderBase
 * @copyright NFePHP Copyright (c) 2016
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse for the canonical source repository
 */

use NFePHP\Common\Dom\Dom;

class RenderBase
{
    protected $dom;
    
    public function __construct()
    {
        $this->dom = new Dom();
    }
}
