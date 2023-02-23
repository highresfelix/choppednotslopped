<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $file = $_FILES['file'];

  // Check if the file is an mp3 file
  $fileType = mime_content_type($file['tmp_name']);
  if ($fileType !== 'audio/mpeg') {
    die('File must be an mp3 file');
  }

  // Set up FFmpeg command to slow down and add reverb
  $inputFile = $file['tmp_name'];
  $outputFile = 'processed.mp3';
  $command = "ffmpeg -i $inputFile -filter_complex \"atempo=0.75,areverb=30\" -vn $outputFile";
  exec($command);

  // Provide link to download or stream the processed file
  echo '<a href="' . $outputFile . '">Download Processed File</a>';
}
?>
