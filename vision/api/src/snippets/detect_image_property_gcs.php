<?php
/**
 * Copyright 2017 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


namespace Google\Cloud\Samples\Vision;

# [START image_property_detection_gcs]
use Google\Cloud\ServiceBuilder;

// $projectId = 'YOUR_PROJECT_ID';
// $bucketName = 'your-bucket-name'
// $objectName = 'your-object-name'

$builder = new ServiceBuilder([
    'projectId' => $projectId,
]);
$vision = $builder->vision();
$storage = $builder->storage();

// fetch the storage object and annotate the image
$object = $storage->bucket($bucketName)->object($objectName);
$image = $vision->image($object, ['IMAGE_PROPERTIES']);
$result = $vision->annotate($image);

// print the response
print("Properties:\n");
foreach ($result->imageProperties()->colors() as $color) {
    $rgb = $color['color'];
    printf("red:%s\n", $rgb['red']);
    printf("green:%s\n", $rgb['green']);
    printf("blue:%s\n\n", $rgb['blue']);
}
# [END image_property_detection]
