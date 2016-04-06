<?php

class JoshRibakoff_Note_HTMLToRTF {

   protected $colortable;

   function setColorTable($colorTable) {
      $this->colortable = $colorTable;
   }

   function newColorTable() {
      return $this->colortable;
   }

   function convert($text) {
      $text = html_entity_decode($text, ENT_COMPAT, 'UTF-8');
      $text = $this->escapeRTFTokens($text);
      $text = $this->convertSpanWithColorStyleToRTF($text);
      $text = $this->convertFontColorToRTF($text);

      $text = str_ireplace('</p><p>', "\\par\n", $text);

      $text = str_ireplace('<br>', "\\par ", $text);

      $text = preg_replace('/(\s*)<strong[^>]*>(\s*)/i', '$1\\b $2', $text);
      $text = preg_replace('#(\s*)<\/strong>(\s*)#i', '$1\\b0 $2', $text);

      $text = preg_replace('/(\s*)<b[^>]*>(\s*)/i', '$1\\b $2', $text);
      $text = preg_replace('#(\s*)<\/b>(\s*)#i', '$1\\b0 $2', $text);
      
      $text = preg_replace('/(\s*)<i[^>]*>(\s*)/i', '$1\\i $2', $text);
      $text = preg_replace('#(\s*)<\/i>(\s*)#i', '$1\\i0 $2', $text);

      $text = preg_replace('/(\s*)<em[^>]*>(\s*)/i', '$1\\i $2', $text);
      $text = preg_replace('#(\s*)<\/em>(\s*)#i', '$1\\i0 $2', $text);
   


      $text = preg_replace('/<ol[^>]*>/i', "\\par", $text);
      $text = str_ireplace('</ol>', '\\par\n', $text);

      $text = preg_replace('/<ul[^>]*>/i', "\\par", $text);
      $text = str_ireplace('</ul>', "\\par\n", $text);

      $text = preg_replace('/<li[^>]*>/i', '\\par\\bullet    ', $text);
      $text = str_ireplace('</li>', '', $text);
      
        
      $text = preg_replace('/(\s*)<u[^>]*>(\s*)/i', '$1\\ul $2', $text);
      $text = preg_replace('#(\s*)<\/u>(\s*)#i', '$1\\ulnone $2', $text);


      $text = str_ireplace('…', '...', $text);



      $toReplace = [
          '‘',
          '’',
          '“',
          '”',
          '&nbsp;',
          html_entity_decode('&nbsp;', ENT_COMPAT, 'UTF-8'),
          'À',
          'Á',
          'Â',
          'Ã',
          'Ä',
          'Å',
          'Æ',
          'Ç',
          'È',
          'É',
          'Ê',
          'Ë',
          'Ì',
          'Í',
          'Î',
          'Ï',
          'Ð',
          'Ñ',
          'Ò',
          'Ó',
          'Ô',
          'Õ',
          'Ö',
          '×',
          'Ø',
          'Ù',
          'Ú',
          'Û',
          'Ü',
          'Ý',
          'Þ',
          'ß',
          'à',
          'á',
          'â',
          'ã',
          'ä',
          'å',
          'æ',
          'ç',
          'è',
          'é',
          'ê',
          'ë',
          'ì',
          'í',
          'î',
          'ï',
          'ð',
          'ñ',
          'ò',
          'ó',
          'ô',
          'õ',
          'ö',
          '÷',
          'ø',
          'ù',
          'ú',
          'û',
          'ü',
          'ý',
          'þ',
          'ÿ',
          "»",
          "¼",
          "½",
          "¾",
          "¿",
          "·",
          "µ",
          "°",
          "±",
          "«",
          "¡",
          "¢",
          "£",
          "¤",
          "¥",
          "¦",
          "§",
          "¨",
          "ž",
          "Ÿ",
          "œ",
          "•",
          "~",
          "™",
          "š",
          "©",
          "®",
          "™",
          "&#39;",
      ];
      $toReplaceWith = [
          "'",
          "'",
          '"',
          '"',
          " ",
          " ",
          "\'c0",
          "\'c1",
          "\'c2",
          "\'c3",
          "\'c4",
          "\'c5",
          "\'c6",
          "\'c7",
          "\'c8",
          "\'c9",
          "\'ca",
          "\'cb",
          "\'cc",
          "\'cd",
          "\'ce",
          "\'cf",
          "\'d0",
          "\'d1",
          "\'d2",
          "\'d3",
          "\'d4",
          "\'d5",
          "\'d6",
          "\'d7",
          "\'d8",
          "\'d9",
          "\'da",
          "\'db",
          "\'dc",
          "\'dd",
          "\'de",
          "\'df",
          "\'e0",
          "\'e1",
          "\'e2",
          "\'e3",
          "\'e4",
          "\'e5",
          "\'e6",
          "\'e7",
          "\'e8",
          "\'e9",
          "\'ea",
          "\'eb",
          "\'ec",
          "\'ed",
          "\'ee",
          "\'ef",
          "\'f0",
          "\'f1",
          "\'f2",
          "\'f3",
          "\'f4",
          "\'f5",
          "\'f6",
          "\'f7",
          "\'f8",
          "\'f9",
          "\'fa",
          "\'fb",
          "\'fc",
          "\'fd",
          "\'fe",
          "\'ff",
          "\'bb",
          "\'bc",
          "\'bd",
          "\'be",
          "\'bf",
          "\'b7",
          "\'b5",
          "\'b0",
          "\'b1",
          "\'ab",
          "\'a1",
          "\'a2",
          "\'a3",
          "\'a4",
          "\'a5",
          "\'a6",
          "\'a7",
          "\'a8",
          "\'9e",
          "\'9f",
          "\'9c",
          "\'95",
          "\'98",
          "\'99",
          "\'9a",
          "\'a9",
          "\'ae",
          "\'99",
          "'",
      ];

      $text = str_ireplace($toReplace, $toReplaceWith, $text);



      $regex = [
          '/\\s*' . html_entity_decode('&ndash;', ENT_COMPAT, 'UTF-8') . '\\s*/i',
          '/\\s*' . html_entity_decode('&mdash;', ENT_COMPAT, 'UTF-8') . '\\s*/i',
      ];
      $replace = [
          '\\endash ',
          '\\emdash ',
      ];
      $text = preg_replace($regex, $replace, $text);
      
      $text = strip_tags($text);



      return $text;
   }

   function escapeRTFTokens($text) {
      return str_replace(
              array('\\', '}', ' {
         '), array('\\\\', '\\
      }', '\\ {
         '), $text
      );
   }

   function convertSpanWithColorStyleToRTF($text) {
      if (!preg_match_all('#<span.*?style=".*?color:\#(.+?)">#', $text, $matches)) {
         return $text;
      }
      foreach ($matches[1] as $matchedColor) {
         $cfnumber = $this->updateColorTable($matchedColor);
         $text = preg_replace('#<span.*?style=".*?color:.+?">#', '\\cf' . $cfnumber . ' ', $text, 1);
         $text = '\\cf0 ' . $text;
         $text = str_replace('</span>', ' \\cf0', $text);
      }
      return $text;
   }

   function convertFontColorToRTF($text) {
      if (!preg_match_all('#<font color="\#(.+?)">#', $text, $matches)) {
         return $text;
      }
      foreach ($matches[1] as $matchedColor) {
         $cfnumber = $this->updateColorTable($matchedColor);
         $text = preg_replace('#<font color=".+?">#', '\\cf' . $cfnumber . ' ', $text, 1);
         $text = '\\cf0 ' . $text;
         $text = str_replace('</font>', ' \\cf0', $text);
      }

      return $text;
   }

   function updateColorTable($newColor) {
      if (!count($this->colortable)) {
         $this->colortable = array(
             '000000',
             $newColor
         );
      } else {
         $this->colortable[] = $newColor;
      }
      return count($this->colortable) - 1;
   }

}