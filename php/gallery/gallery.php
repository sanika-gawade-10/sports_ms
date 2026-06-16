<?php
$dir = "gallery";  // your image folder
$images = glob($dir . "/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>

    <style>
        /* GALLERY TITLE */
        .gallery-title {
            text-align: center;
            font-size: 6rem;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            font-family: Arial, sans-serif;
            letter-spacing: 1px;
        }

        /* GRID LAYOUT */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        /* SAME SIZE IMAGES */
        .gallery-item img {
            width: 100%;
            height: 200px;       
            object-fit: cover;   
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .gallery-item img:hover {
            transform: scale(1.03);
        }

        /* LIGHTBOX POPUP */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            justify-content: center;
            align-items: center;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .lightbox:target {
            display: flex;
        }
    </style>
</head>

<body style="background-color: #CDEAFE;">

<!-- TITLE -->
<div class="gallery-title">Gallery</div>

<div class="gallery-container">
    <?php foreach ($images as $index => $path): ?>
        <?php $filename = basename($path); ?>

        <div class="gallery-item">
            <a href="#img<?php echo $index; ?>">
                <img src="<?php echo $dir . '/' . $filename; ?>">
            </a>
        </div>

        <!-- LIGHTBOX POPUP -->
        <div class="lightbox" id="img<?php echo $index; ?>">
            <a href="#">
                <img src="<?php echo $dir . '/' . $filename; ?>">
            </a>
        </div>

    <?php endforeach; ?>
</div>

</body>
</html>
