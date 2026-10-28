<?php 
    $siteSettings = public_settings();
    $siteName = $siteSettings['company_name'];
    $siteTagline = $siteSettings['tagline'];
    $pageTitle = (isset($title) && $title !== '') ? $title.' - '.$siteName : $siteName;
    $pageDescription = (isset($description) && $description !== '') ? $description : $siteName.', '.$siteTagline.'.';
    $configuredUrl = rtrim((string) env('APP_URL', ''), '/');
    $pageUrl = $configuredUrl !== '' ? $configuredUrl.parse_url(\System\URL::current(), PHP_URL_PATH) : \System\URL::current();
    $ogType = isset($og_type) ? $og_type : 'website';
    $ogImage = isset($og_image) && $og_image !== '' ? $og_image : (! empty($siteSettings['logo_path']) ? asset($siteSettings['logo_path']) : '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($pageDescription) ?>">
    <link rel="canonical" href="<?php echo e($pageUrl) ?>">
    <meta property="og:type" content="<?php echo e($ogType) ?>">
    <meta property="og:site_name" content="<?php echo e($siteName) ?>">
    <meta property="og:title" content="<?php echo e($pageTitle) ?>">
    <meta property="og:description" content="<?php echo e($pageDescription) ?>">
    <meta property="og:url" content="<?php echo e($pageUrl) ?>">
    <meta property="og:locale" content="id_ID">
    <?php if ($ogImage !== ''): ?>
        <meta property="og:image" content="<?php echo e($ogImage) ?>">
        <meta name="twitter:image" content="<?php echo e($ogImage) ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo e($pageTitle) ?>">
    <meta name="twitter:description" content="<?php echo e($pageDescription) ?>">
    <link rel="icon" type="image/png" href="<?php echo e($ogImage !== '' ? $ogImage : 'data:;base64,iVBORw0KGgo=') ?>">
    <title><?php echo e($pageTitle) ?></title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo yield_content('head') ?>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    <?php echo view('partials.navbar')->with(get_defined_vars())->render() ?>

    <main>
        <?php echo yield_content('content') ?>
    </main>

    <?php echo view('partials.footer')->with(get_defined_vars())->render() ?>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof AOS === 'undefined') {
                return;
            }

            AOS.init({
                duration: 700,
                easing: 'ease-out-cubic',
                once: true,
                offset: 80,
                disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches
            });
        });
    </script>
</body>
</html>
