<?
/*
 * XML Array class - parses an XML file and inserts the parsed data into a
 * multidimensional array.
 *
 * $Id: xmlarray.php,v 1.6 2001/03/05 03:48:57 chris Exp $
 *
 * Simple Usage: $xmlfile = new xmlarray();
 *               $arr = $xmlfile->parsefile("somefile.xml");
 *
 * More detailed documentation can be found at
 * http://www.bolt.cx/xmlarray/xmlarray.html
 *
 * Copyright (c) 2001, Christopher Bolt (chris at bolt dot cx). All rights reserved.
 *
 * LICENSE
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided
 * that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this list of conditions and the
 *    following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and
 *    the following disclaimer in the documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products derived from this software
 *    without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF
 * USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
 * USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

error_reporting(E_ALL ^ E_NOTICE);

class xmlarray {
  var $parser;
  var $data = array(), $indexes = array();
  var $indexidx = -1;
  var $position;
  var $idname;
  var $combine, $combined = false;
  var $xmlerrorcode, $xmlerrorline;
  var $useincpath, $rootarray;
  var $newelement;

  function startElement($parser, $name, $attribs) {
    $this->newelement = true;
    $this->indexidx++;
    ($this->indexes[$this->indexidx]["name"] != $name) ? $this->indexes[$this->indexidx] = array("count" => 0, "name" => $name) : $this->indexes[$this->indexidx]["count"]++;
    $this->position .= "[\"$name\"][" . $this->indexes[$this->indexidx]["count"] . "]";
    if (sizeof($attribs)) {
      $atts = array();
      while (list($k, $v) = each($attribs))
        $atts[$k] = $v;
      eval("\$this->data$this->position = \$atts;");
    }
  }

  function endElement($parser, $name) {
    unset($this->indexes[$this->indexidx + 1]);
    $this->indexidx--;
    for ($i = 0; $i < 2; $i++)
      $this->position = substr($this->position, 0, strrpos($this->position, "["));
  }

  function characterData($parser, $data) {
    $pos = "\$this->data$this->position";
    if (trim($data)) {
      $code = "if (count($pos) < 1)
  $pos = \$data;
elseif (\$this->newelement == false)
  $pos .= \$data;
elseif (count($pos) == 1) {
  \$tmp = array($pos, \$data);
  $pos = \$tmp;
} else
  $pos" . "[] = \$data;";
      eval($code);
    }
    $this->newelement = false;
  }

  function walkarray(&$array) {
    if (!is_array($array)) return $array;
    reset($array);
    while (list($key, $value) = each($array)) {
      if (is_array($array[$key])) {
        if (count($array[$key]) == 1)
          $array[$key] = $array[$key][key($array[$key])];
        if (is_array($array[$key])) {
          $array[$key] = $this->walkarray($array[$key]);
          if (!empty($this->idname) && !empty($array[$key][$this->idname]) && is_int($key)) {
            if (ereg("[^0-9]", $array[$key][$this->idname]))
              $array[$array[$key][$this->idname]] = $array[$key];
            else
              $array["$this->idname" . "_" . $array[$key][$this->idname]] = $array[$key];
            unset($array[$key]);
          }
        }
      }
    }
    return $array;
  }

  function xmlarray($idname = "", $rootarray = "", $combinesinglearrays = true, $useincpath = false) {
    $this->idname = $idname;
    $this->rootarray = $rootarray;
    $this->combine = $combinesinglearrays;
    $this->useincpath = $useincpath;
  }

  function parse($data) {
    $this->data = array();
    $this->indexes = array();
    $this->indexidx = -1;
    unset($this->position);
    $this->combined = false;

    $this->parser = xml_parser_create();
    xml_set_object($this->parser, $this);
    xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
    xml_set_element_handler($this->parser, "startElement", "endElement");
    xml_set_character_data_handler($this->parser, "characterData");
    if (!xml_parse($this->parser, $data)) {
      $this->xmlerrorcode = xml_get_error_code($this->parser);
      $this->xmlerrorline = xml_get_current_line_number($this->parser);
      xml_parser_free($this->parser);
      return false;
    }

    if ($this->combine == true) {
      $this->data = $this->walkarray($this->data);
      $this->combined = true;
    }
    xml_parser_free($this->parser);

    return ($this->rootarray != "") ? $this->data[$this->rootarray] : $this->data;
  }

  function parsefile($filename) {
    $numargs = func_num_args();
    if ($numargs > 1) {
      $funcarg = func_get_arg(0);
      $temparray = $this->parsefile($funcarg);
      for ($i = 1; $i < $numargs; $i++) {
        $funcarg = func_get_arg($i);
        $temparray = array_merge_recursive($temparray, $this->parsefile($funcarg));
      }
      return $temparray;
    }
    else {
      $filename = func_get_arg(0);
      $contents = @join('', file($filename));
      return $this->parse($contents);
    }
  }
}
?>