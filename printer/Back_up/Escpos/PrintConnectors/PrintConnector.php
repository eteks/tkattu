<?php
/**
 * This file is part of escpos-php: PHP receipt printer library for use with
 * ESC/POS-compatible thermal and impact printers.
 *
 * Copyright (c) 2014-16 Michael Billington < michael.billington@gmail.com >,
 * incorporating modifications by others. See CONTRIBUTORS.md for a full list.
 *
 * This software is distributed under the terms of the MIT license. See LICENSE.md
 * for details.
 */

namespace printer\Escpos\PrintConnectors;

/**
 * Interface passed to Escpos class for receiving print data. Print connectors
 * are responsible for transporting this to the actual printer.
 */
interface PrintConnector
{
    /**
     * Print connectors should cause a NOTICE if they are deconstructed
     * when they have not been finalized.
     */
    public function __destruct();

    /**
     * Finish using this print connector (close file, socket, send
     * accumulated output, etc).
     */
    public function finalize();

    /**
     * @param string $data
     * @return Data read from the printer, or false where reading is not possible.
     */
    public function read($len);
    
    /**
     * @param string $data
     */
    public function write($data);
}
