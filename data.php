<?php
function listFiles($dir, $extensions = []) {
  $files = array_filter(scandir($dir), function($file) use ($dir, $extensions) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    return in_array(strtolower($ext), $extensions);
  });
  return array_map(function($file) {
    return pathinfo($file, PATHINFO_FILENAME); // Remove extension
  }, array_values($files));
}

$models = listFiles('models', ['glb', 'gltf']);
$wraps = listFiles('textures', ['jpg', 'jpeg', 'png']);

echo json_encode(['models' => $models, 'wraps' => $wraps]);
?>
