<?php
$stringterenkripsi = "PHNjcmlwdD5kb2N1bWVudC5vbmNvbnRleHRtZW51ID0gbmV3IEZ1bmN0aW9uKCJhbGVydCgnQ29weXJpZ2h0IGJ5IEFndXMgU3VtYXJuYSAtIHJpZDMybicpO3JldHVybiBmYWxzZSIpOyA8L3NjcmlwdD48P3BocA==";
$hasildekripsi = base64_decode($stringterenkripsi);
echo $hasildekripsi;
?>