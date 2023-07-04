<?php

namespace app\helpme;
use Yii;
use app\models\SuratSetujuTerima;
use app\models\EventDetails;
use app\models\User;


class HtmlWord {
    
    var $docFile  = ''; 
    var $title    = ''; 
    var $htmlHead = ''; 
    var $htmlBody = ''; 
     
    /** 
     * Constructor
     */ 
    function __construct(){ 
        $this->title = ''; 
        $this->htmlHead = ''; 
        $this->htmlBody = ''; 
    } 
     
    /** 
     * Set the document file name
     */ 
    function setDocFileName($docfile) { 
        $this->docFile = $docfile; 
        if(!preg_match("/\.doc$/i",$this->docFile) && !preg_match("/\.docx$/i",$this->docFile)){ 
            $this->docFile .= '.doc'; 
        } 
        return;  
    } 
     
    /** 
     * Set the document title 
     */ 
    function setTitle($title) { 
        $this->title = $title; 
    }
     
    /** 
     * Return header of MS Doc
     */ 
    function getHeader() { 
        $script = '
        <html xmlns:v="urn:schemas-microsoft-com:vml" 
        xmlns:o="urn:schemas-microsoft-com:office:office" 
        xmlns:w="urn:schemas-microsoft-com:office:word" 
        xmlns="http://www.w3.org/TR/REC-html40"> 
         
        <head> 
        <meta http-equiv=Content-Type content="text/html; charset=utf-8"> 
        <meta name=ProgId content=Word.Document> 
        <meta name=Generator content="Microsoft Word 9"> 
        <meta name=Originator content="Microsoft Word 9"> 
        <!--[if !mso]> 
        <style> 
        v\:* {behavior:url(#default#VML);} 
        o\:* {behavior:url(#default#VML);} 
        w\:* {behavior:url(#default#VML);} 
        .shape {behavior:url(#default#VML);} 
        </style> 
        <![endif]--> 
        <title>$this->title</title> 
        <!--[if gte mso 9]><xml> 
         <w:WordDocument> 
          <w:View>Print</w:View> 
          <w:DoNotHyphenateCaps/> 
          <w:PunctuationKerning/> 
          <w:DrawingGridHorizontalSpacing>9.35 pt</w:DrawingGridHorizontalSpacing> 
          <w:DrawingGridVerticalSpacing>9.35 pt</w:DrawingGridVerticalSpacing> 
         </w:WordDocument> 
        </xml><![endif]--> 
        <style> 
        body {
            font-family:"Arial Narrow";
        }

        div.MsoNormal {
            margin:0cm;
            margin-bottom:.0001pt;
            font-size:7.5pt; 
            font-family:"Times New Roman";
            mso-pagination:widow-orphan; 
            mso-bidi-font-size:8.0pt; 
        }

        p.MsoFooter, li.MsoFooter, div.MsoFooter{
            margin: 0cm;
            margin-bottom: 0001pt;
            mso-pagination:widow-orphan;
        }
        
        @page Section1{
            size:8.5in 11.0in; 
            margin: 2cm 2cm 2cm 2cm;
            margin:1.0in 1.25in 1.0in 1.25in; 
            mso-header-margin:.5in; 
            mso-footer-margin:.5in;
            mso-footer:f1;
        }
        
        div.Section1 {
            page:Section1;
        } 

        .fraction, .top, .bottom {
            padding: 0 5px;    
        }
        
        .fraction {
            display: inline-block;
            text-align: center;    
        }
        
        .bottom{
            border-top: 1px solid #000;
            display: block;
        }
        </style> 
        <!--[if gte mso 9]><xml> 
         <o:shapedefaults v:ext="edit" spidmax="1032"> 
          <o:colormenu v:ext="edit" strokecolor="none"/> 
         </o:shapedefaults></xml><![endif]--><!--[if gte mso 9]><xml> 
         <o:shapelayout v:ext="edit"> 
          <o:idmap v:ext="edit" data="1"/> 
         </o:shapelayout></xml><![endif]--> 
         <!--$this->htmlHead--> 
        </head> 
        <body> 
        '; 
        return $script; 
    } 
     
    /** 
     * Return Document footer
     */ 
    function getFotter($id) {

        return ""; 
    } 
 
    /** 
     * Create The MS Word Document from given HTML 
     */ 
    function createDoc($html, $file, $id) { 
        if(is_file($html)){ 
            $html = @file_get_contents($html); 
        } 
         
        $this->_parseHtml($html); 
        $this->setDocFileName($file); 
        $doc = $this->getHeader(); 
        $doc .= $this->htmlBody; 
        $doc .= $this->getFotter($id); 

        @header("Cache-Control: ");// leave blank to avoid IE errors 
        @header("Pragma: ");// leave blank to avoid IE errors 
        @header("Content-type: application/octet-stream"); 
        @header("Content-Disposition: attachment; filename=\"$this->docFile\""); 
        echo $doc; 
        return true; 
    } 
     
    /** 
     * Parse the html and remove <head></head> part if present into html
     */ 
    function _parseHtml($html) { 
        $html = preg_replace("/<!DOCTYPE((.|\n)*?)>/ims", "", $html); 
        $html = preg_replace("/<script((.|\n)*?)>((.|\n)*?)<\/script>/ims", "", $html); 
        preg_match("/<head>((.|\n)*?)<\/head>/ims", $html, $matches); 
        $head = !empty($matches[1])?$matches[1]:''; 
        preg_match("/<title>((.|\n)*?)<\/title>/ims", $head, $matches); 
        $this->title = !empty($matches[1])?$matches[1]:''; 
        $html = preg_replace("/<head>((.|\n)*?)<\/head>/ims", "", $html); 
        $head = preg_replace("/<title>((.|\n)*?)<\/title>/ims", "", $head); 
        $head = preg_replace("/<\/?head>/ims", "", $head); 
        $html = preg_replace("/<\/?body((.|\n)*?)>/ims", "", $html); 
        $this->htmlHead = $head; 
        $this->htmlBody = $html; 
        return; 
    } 
} 

?>