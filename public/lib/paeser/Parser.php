<?php
namespace app\portal\controller;

class Parser
{
    public static function fix($filename, $destfilename = null)
    {
        try {
            $handle = fopen($filename, "rb");
            $oldPNG = fread($handle, filesize($filename));
            fclose($handle);

            $newPng = self::getNormalizedPNG($oldPNG);
            if (is_null($destfilename)) $destfilename = $filename;
            file_put_contents($destfilename, $newPng);
        } catch (\Exception $exc) {
            return $exc->getMessage();
        }
        return true;
    }

    private static function getNormalizedPNG($oldPNG)
    {
        $im = @imagecreatefromstring($oldPNG);
        if($im !== false) return $oldPNG;

        $pngheader = "\x89PNG\r\n\x1a\n";
        if (substr($oldPNG, 0, 8) != $pngheader) return;

        $newPNG = substr($oldPNG, 0, 8);

        $chunkPos = 8;

        $idatAcc = "";
        $breakLoop = false;

        while ($chunkPos < strlen($oldPNG)) {
            $skip = false;

            // Reading chunk
            $chunkLength = unpack("N", substr($oldPNG, $chunkPos, $chunkPos + 4));
            $chunkLength = array_shift($chunkLength);
            $chunkType = substr($oldPNG, $chunkPos + 4, 4);
            $chunkData = substr($oldPNG, $chunkPos + 8, $chunkLength);
            $chunkCRC = unpack("N", substr($oldPNG, $chunkPos + $chunkLength + 8, 4));

            $chunkCRC = array_shift($chunkCRC);
            $chunkPos += $chunkLength + 12;

            // Reading header chunk
            if ($chunkType == 'IHDR') {
                $width = unpack("N", substr($chunkData, 0, 4));
                $width = array_shift($width);
                $height = unpack("N", substr($chunkData, 4, 8));
                $height = array_shift($height);
            }

            // Parsing the image chunk
            if ($chunkType == "IDAT") {
                // Store the chunk data for later decompression
                $idatAcc .= $chunkData;
                $skip = true;
            }

            // Removing CgBI chunk
            if ($chunkType == "CgBI") {
                $skip = true;
            }

            // Add all accumulated IDATA chunks
            if ($chunkType == 'IEND') {
                try {
                    // Uncompressing the image chunk
                    $bufSize = $width * $height * 4 + $height;
                    $chunkData = zlib_decode($idatAcc, $bufSize);
                } catch (\Exception $exc) {
                    return $oldPNG; // already optimized
                }
                $chunkType = "IDAT";

                // Swapping red & blue bytes for each pixel
                $newdata = "";
                for ($y = 0; $y < $height; $y++) {
                    $i = strlen($newdata);
                    $newdata .= $chunkData[$i];
                    for ($x = 0; $x < $width; $x++) {
                        $i = strlen($newdata);
                        $newdata .= $chunkData[$i + 2];
                        $newdata .= $chunkData[$i + 1];
                        $newdata .= $chunkData[$i + 0];
                        $newdata .= $chunkData[$i + 3];
                    }
                }

                // Compressing the image chunk
                $chunkData = $newdata;
                $chunkData = zlib_encode($chunkData, ZLIB_ENCODING_DEFLATE);

                $chunkLength = strlen($chunkData);
                $chunkCRC = crc32($chunkType . $chunkData);
                // $chunkCRC = ($chunkCRC + 0x100000000) % 0x100000000;
                $breakLoop = true;
            }

            if (!$skip) {
                $newPNG .= pack("N", $chunkLength);
                $newPNG .= $chunkType;
                if ($chunkLength > 0) {
                    $newPNG .= $chunkData;
                    $newPNG .= pack("N", $chunkCRC);
                }
            }
            if ($breakLoop) break;
        }
        return $newPNG;
    }
}